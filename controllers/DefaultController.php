<?php

namespace rabint\stats\controllers;

use Yii;
use rabint\stats\models\Stats;
use rabint\stats\models\Dailies;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for Stats model.
 */
class DefaultController extends \rabint\controllers\DefaultController {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionAnalyseAll() {
        if (!\rabint\helpers\user::can('administrator')) {
            throw new \yii\web\ForbiddenHttpException(\Yii::t('rabint', 'Restricted Access'));
        }
        /* =================================================================== */
        echo \rabint\stats\stats::analiseStats();
        die('');
    }

    public function actionAnalyse() {
        $analiseHour = config('STATS_ANALYSE_HOUR', 1);
        if ($analiseHour == FALSE) {
            die('Analyse is disabled!');
        }
        $ch = date('H');
        if ($analiseHour != $ch) {
            die('invalid request!');
        }

        $status = Yii::$app->keyStorage->get('Stats.AnalyseStatus');
        if ($status == 'doing') {
            die('Analyse already started!');
        }
        $analiseDate = date('Y-m-d', strtotime('-1 day'));
        $analise = Stats::findOne(['date' => $analiseDate]);
        if ($analise != null) {
            die('Analyse for this day are ended!');
        }
        Yii::$app->keyStorage->set('Stats.AnalyseStatus', 'doing');
        \rabint\general::startObToKeepProcessing();
        echo 'analyse started.';
        \rabint\general::endObAndKeepProcessing();
        Stats::analyse($analiseDate);
        Yii::$app->keyStorage->set('Stats.AnalyseStatus', date('Y-m-d H:i:s'));
        die('end');
    }

    public function actionTodayAnalyse() {
        if (!\rabint\helpers\user::can('administrator')) {
            throw new \yii\web\ForbiddenHttpException(\Yii::t('rabint', 'Restricted Access'));
        }
        $res = Stats::analyse(date('Y-m-d'), FALSE);
        if ($res) {
            Yii::$app->session->setFlash('success', \Yii::t('rabint', 'تحلیل آمار امروز تا این لحظه به شرح ذیل است'));
            return $this->redirect(['/stats/admin/view', 'date' => date('Y-m-d')]);
        }
        Yii::$app->session->setFlash('error', \Yii::t('rabint', 'متاسفانه تحلیل تاریخ امروز با خطا همراه بود.'));
        return $this->redirect(['/stats/admin/index']);
    }

}
