<?php

/**
 * cars widget
 * @author Mojtaba Akbarzadeh <ingenious@chmail.com>
 * @copyright (c) rabint, sahife data producers
 */

namespace rabint\stats\widget;

use yii\base\InvalidConfigException;
use yii\helpers\Html;
use rabint\stats\models\Dailies;

/**
 * Class Cars
 * @package common\components\widgets
 * @property str $key
 * @property str $cssClass
 */
class ShowStatsWidget extends \yii\bootstrap\Widget {

    var $key = '';
    var $cssClass = '';
    var $title = '';
    var $style = 'default';
    var $items = [];

    /**
     * @throws InvalidConfigException
     */
    public function init() {
        if (empty($this->key)) {
            $this->key = md5($this->title . $this->style);
        }
        $cacheKey = [
            self::className(),
            $this->key
        ];
        $item = \Yii::$app->cache->get($cacheKey);
        if ($item === false) {
            $item = [];

            $item['todayVisit'] = Dailies::statTodayVisit();
            $item['todayVisitor'] = Dailies::statTodayVisitor();
            $item['yesterdayVisit'] = Dailies::statYesterdayVisit();
            $item['yesterdayVisitor'] = Dailies::statYesterdayVisitor();
            $item['thisMonthVisit'] = Dailies::statMonthVisit();
            $item['pastMonthVisit'] = Dailies::statPastMonthVisit();
            $item['allVisit'] = Dailies::statAllVisit();
            $item['online'] = Dailies::statOnline();
            $this->items = $item;
        }
        parent::init();
    }

    public function run() {
        return $this->render('ShowStatsWidget/' . $this->style, [
                    'items' => $this->items,
                    'cssClass' => $this->cssClass,
                    'title' => $this->title,
        ]);
    }

}
