<?php

namespace rabint\stats\models;

use Yii;

/**
 * This is the model class for table "stat_dailies".
 *
 * @property string $id
 * @property string $time
 * @property string $user_id
 * @property int $maturity
 * @property int $gender
 * @property string $request
 * @property string $agent
 * @property string $ip
 * @property string $request_type
 * @property string $utm
 * @property int $group_id
 * @property int $group_category_id
 * @property string $model
 * @property string $object_id
 * @property string $referer
 */
class Dailies extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'stat_dailies';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['time'], 'safe'],
                [['user_id', 'status_code', 'gender', 'maturity','group','group_category'], 'integer'],
                [['agent', 'utm'], 'string', 'max' => 255],
                [['request'], 'string', 'max' => 255],
                [['ip'], 'string', 'max' => 45],
                [['request_type'], 'string', 'max' => 255],
                [['referer'], 'string'],
                [['time', 'referer', 'agent', 'utm', 'request', 'ip', 'request_type'], 'filter', 'filter' => '\yii\helpers\HtmlPurifier::process'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => \Yii::t('rabint', 'شناسه'),
            'time' => \Yii::t('rabint', 'تاریخ'),
            'user_id' => \Yii::t('rabint', 'شناسه کاربر'),
            'maturity' => \Yii::t('rabint', 'گروه سنی'),
            'gender' => \Yii::t('rabint', 'جنسیت'),
            'request' => \Yii::t('rabint', 'صفحه درخواستی'),
            'agent' => \Yii::t('rabint', 'مرورگر کاربر'),
            'ip' => \Yii::t('rabint', 'آی پی'),
            'request_type' => \Yii::t('rabint', 'نوع درخواست'),
            'utm' => \Yii::t('rabint', 'utm'),
            'referer' => \Yii::t('rabint', 'referer'),
            'group' => \Yii::t('rabint', 'گروه'),
            'group_category' => \Yii::t('rabint', 'زیر گروه'),
            'status_code' => \Yii::t('rabint', 'status_code'),
        ];
    }

    public static function statTodayVisit() {
        return self::find()->where('time >' . strtotime('-1 day'))->count();
    }

    public static function statTodayVisitor() {
        return self::find()
                        ->where('time>' . strtotime('-1 day'))
                        ->groupBy('agent')
                        ->count();
    }

    public static function statYesterdayVisit() {
        return self::find()
                        ->where('time <=' . strtotime('-1 day'))
                        ->andWhere('time >' . strtotime('-2 day'))
                        ->count();
    }

    public static function statYesterdayVisitor() {
        return self::find()
                        ->where('time <=' . strtotime('-1 day'))
                        ->andWhere('time >' . strtotime('-2 day'))
                        ->groupBy('agent')
                        ->count();
    }

    public static function statMonthVisit() {
        return self::find()
                        ->andWhere('time >' . strtotime('-1 month'))
                        ->groupBy('agent')
                        ->count();
    }

    public static function statPastMonthVisit() {
        return self::find()
                        ->where('time <=' . strtotime('-1 month'))
                        ->andWhere('time >' . strtotime('-2 month'))
                        ->count();
    }

    public static function statAllVisit() {
        return self::find()->count();
    }

    public static function statOnline() {
        return self::find()
                        ->where('time>' . strtotime('-10 minute'))
                        ->groupBy('agent')
                        ->count();
    }

}
