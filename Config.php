<?php

namespace rabint\stats;

use Yii;

class Config extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'stats';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['date'], 'safe'],
            [['visit', 'visitor', 'download', 'comment', 'like', 'rate'], 'integer'],
            [['most_hour', 'visit_in_hour', 'request_type', 'most_visited_action', 'most_visitor_user', 'agents', 'utms'], 'string'],
            [['request_type'], 'required'],
            [['date', 'most_hour', 'visit_in_hour', 'request_type', 'most_visited_action', 'most_visitor_user', 'agents', 'utms'], 'filter', 'filter' => '\yii\helpers\HtmlPurifier::process'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => \Yii::t('rabint','شناسه'),
            'date' => \Yii::t('rabint','تاریخ'),
            'visit' => \Yii::t('rabint','تعداد بازدید'),
            'visitor' => \Yii::t('rabint','تعداد کاربر'),
            'most_hour' => \Yii::t('rabint','ساعات اوج بازدید'),
            'visit_in_hour' => \Yii::t('rabint','بازدید در هر ساعت'),
            'request_type' => \Yii::t('rabint','نوع درخواست'),
            'download' => \Yii::t('rabint','تعداد دانلود'),
            'comment' => \Yii::t('rabint','تعداد نظر'),
            'like' => \Yii::t('rabint','تعداد لایک'),
            'rate' => \Yii::t('rabint','تعداد امتیاز'),
            'most_visited_action' => \Yii::t('rabint','بیشترین اکشنهای بازدید شده'),
            'most_visitor_user' => \Yii::t('rabint','بیشترین کاربران بازدید کننده'),
            'agents' => \Yii::t('rabint','مرورگر ها'),
            'utms' => \Yii::t('rabint','utms'),
        ];
    }

    /* admin menu ======================================================== */

//    public static function adminMenu() {
//            return [
//                'label' => Yii::t('rabint', 'مدیریت آمار'),
//                'icon' => '<i class="fas fa-edit"></i>',
//                'options' => ['class' => 'treeview'],
//                'items' => [
//                    ['label' => Yii::t('rabint', 'آمار'), 'url' => ['/stats/admin'], 'icon' => '<i class="fas fa-angle-double-right"></i>'],
//                ]
//            ];
//    }
}
