<?php

namespace rabint\stats\controllers;

use Yii;
use rabint\stats\models\Stats;
use rabint\stats\models\StatsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminController implements the CRUD actions for Stats model.
 */
class AdminController extends \rabint\controllers\AdminController {

    /**
     * Lists all Stats models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new StatsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Lists all Stats models.
     * @return mixed
     */
    public function actionContent() {

        return $this->render('content');
    }

    public function actionReview() {
        return $this->render('review');
    }

    /**
     * Displays a single Stats model.
     * @param string $id
     * @return mixed
     */
    public function actionView($date) {
        return $this->render('view', [
                    'model' => $this->findModel(['date' => $date]),
        ]);
    }

    /**
     * Finds the Stats model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Stats the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Stats::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
