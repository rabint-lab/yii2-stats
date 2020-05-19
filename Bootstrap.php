<?php

namespace rabint\stats;

use yii\base\Application;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface {

    /**
     * Bootstrap method to be called during application bootstrap stage.
     *
     * @param Application $app the application currently running
     */
    public function bootstrap($app) {
        static $statsDown = false;
        if (!$statsDown) {
            $statsDown = TRUE;
//        \Yii::$app->on('afterAction', function ($event) {
//            \rabint\stats\stats::stat();
//        });
//        \yii\base\Event::on(\yii\web\Controller::className(), \yii\web\Controller::EVENT_AFTER_ACTION, function ($event) {
//            \rabint\stats\stats::stat();
//        });
            \yii\base\Event::on(\yii\web\Response::className(), \yii\web\Response::EVENT_AFTER_SEND, function ($event) {
                \rabint\stats\stats::stat();
            });
//        \Yii::$app->view->on(\yii\web\View::EVENT_END_PAGE, function () {
//            \rabint\stats\stats::stat();
//        });
        }
    }

}
