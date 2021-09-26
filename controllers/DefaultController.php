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
//        if ($analiseHour != $ch) {
//            die('invalid request!');
//        }
        $file_dir = Yii::getAlias('@app/runtime').'/keyStorage.php';
        $data = [];
        if(file_exists($file_dir)){
            $data = json_decode($file_dir,true);
        }else{
            file_put_contents($file_dir,json_encode(['Stats.AnalyseStatus'=>date('Y-m-d H:i:s')]));
            chmod($file_dir, 0777);
            $data = json_decode($file_dir,true);
        }
        $data = is_array($data)?$data:[];
        $status = $data['Stats.AnalyseStatus']??"";
        if ($status == 'doing') {
            die('Analyse already started!');
        }
        $analiseDate = date('Y-m-d', strtotime('-1 day'));
        $analise = Stats::findOne(['date' => $analiseDate]);
        if ($analise != null) {
            die('Analyse for this day are ended!');
        }
        file_put_contents($file_dir,'<?php return '.var_export(array_merge(['Stats.AnalyseStatus'=>'doing'],$data)).";");
//        Yii::$app->keyStorage->set('Stats.AnalyseStatus', 'doing');
//        \rabint\helpers\process::startObToKeepProcessing();
//        echo 'analyse started.';
//        \rabint\helpers\process::endObAndKeepProcessing();
        Stats::analyse($analiseDate);
        file_put_contents($file_dir,'<?php return '.var_export(array_merge(['Stats.AnalyseStatus'=>date('Y-m-d H:i:s')],$data)).";");
//        Yii::$app->keyStorage->set('Stats.AnalyseStatus', date('Y-m-d H:i:s'));
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
