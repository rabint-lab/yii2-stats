<?php

namespace rabint\stats\models;

use Yii;

/**
 * This is the model class for table "stats".
 *
 * @property integer $id
 * @property string $date
 * @property integer $visit
 * @property integer $visitor
 * @property integer $member_visit
 * @property integer $member_visitor
 * @property string $most_hour
 * @property string $visit_in_hour
 * @property string $interface
 * @property string $maturities
 * @property string $genders
 * @property integer $post
 * @property integer $user
 * @property integer $download
 * @property integer $comment
 * @property integer $like
 * @property integer $rate
 * @property string $countries
 * @property string $most_error_action
 * @property string $most_visited_action
 * @property string $most_visitor_user
 * @property string $agents
 * @property string $referer
 * @property integer $error
 * @property integer $restricted
 * @property string $restricted_ip
 * @property string $utms
 */
class Stats extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stats';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'visit', 'visitor', 'member_visit', 'member_visitor', 'post', 'user', 'download', 'comment', 'like', 'rate', 'error', 'restricted'], 'integer'],
            [['date'], 'safe'],
            [['genders', 'maturities', 'most_hour', 'visit_in_hour', 'interface', 'countries', 'most_error_action', 'most_visited_action', 'most_visitor_user', 'agents', 'referer', 'restricted_ip', 'utms'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rabint', 'شناسه'),
            'date' => Yii::t('rabint', 'تاریخ'),
            'visit' => Yii::t('rabint', 'تعداد بازدید'),
            'visitor' => Yii::t('rabint', 'تعداد کاربر'),
            'member_visit' => Yii::t('rabint', 'تعداد بازدید اعضاء'),
            'member_visitor' => Yii::t('rabint', 'تعداد اعضای بازدیدکننده'),
            'most_hour' => Yii::t('rabint', 'ساعات اوج بازدید'),
            'visit_in_hour' => Yii::t('rabint', 'بازدید در هر ساعت'),
            'interface' => Yii::t('rabint', 'واسط کاربر'),
            'maturities' => Yii::t('rabint', 'گروه هاس سنی'),
            'genders' => Yii::t('rabint', 'جنسیت'),
            'post' => Yii::t('rabint', 'تعداد پست جدید'),
            'user' => Yii::t('rabint', 'تعداد کاربر جدید'),
            'download' => Yii::t('rabint', 'تعداد دانلود'),
            'comment' => Yii::t('rabint', 'تعداد نظر'),
            'like' => Yii::t('rabint', 'تعداد لایک'),
            'rate' => Yii::t('rabint', 'تعداد امتیاز'),
            'countries' => Yii::t('rabint', 'کشورهای بازدیدکننده'),
            'most_error_action' => Yii::t('rabint', 'بیشترین اکشنهای دارای خطا'),
            'most_visited_action' => Yii::t('rabint', 'بیشترین اکشنهای بازدید شده'),
            'most_visitor_user' => Yii::t('rabint', 'بیشترین کاربران بازدید کننده'),
            'agents' => Yii::t('rabint', 'مرورگر ها'),
            'referer' => Yii::t('rabint', 'ریفرر'),
            'error' => Yii::t('rabint', 'تعداد صفحه خطا'),
            'restricted' => Yii::t('rabint', 'تعداد جلوگیری شده'),
            'restricted_ip' => Yii::t('rabint', 'Ip های متخلف'),
            'utms' => Yii::t('rabint', 'utms'),
        ];
    }

    static function analyse($date, $remove_dailies = true)
    {
        try {

            /**
             * remove today analised record(if exist)
             */
            $oldAnalise = Stats::findOne(['date' => $date]);

            $tsFrom = strtotime($date . ' 00:00:00');
            $tsTo = $tsFrom + 86400;
            $analise = new Stats();
            $analise->date = $date;
            /* ------------------------------------------------------ */
            $analise->visit = Dailies::find()
                ->andwhere(['>=', 'time', $tsFrom])
                ->andwhere(['<', 'time', $tsTo])
                ->count();

            /* =================================================================== */
            /* =================================================================== */
            /* =================================================================== */

            if ($analise->visit <= 0) {
                return FALSE;
            }

            /* =================================================================== */
            /* =================================================================== */
            /* =================================================================== */
            /* ------------------------------------------------------ */
            $analise->visitor = Dailies::find()
                ->select(['agent'])
                ->andwhere(['>=', 'time', $tsFrom])
                ->andwhere(['<', 'time', $tsTo])
                ->groupBy('agent')
                ->count();
            /* ------------------------------------------------------ */
            $analise->member_visit = Dailies::find()
                ->andwhere(['>=', 'time', $tsFrom])
                ->andwhere(['<', 'time', $tsTo])
                ->andwhere(['>', 'user_id', 0])
                ->count();
            /* ------------------------------------------------------ */
            $analise->member_visitor = Dailies::find()
                ->select('agent')
                ->andwhere(['>=', 'time', $tsFrom])
                ->andwhere(['<', 'time', $tsTo])
                ->andwhere(['>', 'user_id', 0])
                ->groupBy('agent')
                ->count();
            /* ------------------------------------------------------ */
//            $analise->post = \app\modules\post\models\Post::find()
//                ->andwhere(['>=', 'created_at', $tsFrom])
//                ->andwhere(['<', 'created_at', $tsTo])
//                ->count();
            /* ------------------------------------------------------ */
            $analise->user = \rabint\user\models\User::find()
                ->andwhere(['>=', 'created_at', $tsFrom])
                ->andwhere(['<', 'created_at', $tsTo])
                ->count();
            /* ------------------------------------------------------ */
            $analise->comment = \app\modules\post\models\Comment::find()
                ->andwhere(['>=', 'created_at', $tsFrom])
                ->andwhere(['<', 'created_at', $tsTo])
                ->count();
            /* ------------------------------------------------------ */
            $analise->rate = \app\modules\post\models\Rate::find()
                ->andwhere(['>=', 'created_at', $tsFrom])
                ->andwhere(['<', 'created_at', $tsTo])
                ->count();
            /* ------------------------------------------------------ */
//            $analise->like = \globals\direct\UserFavorite::find()
//                ->andwhere(['>=', 'created_at', $tsFrom])
//                ->andwhere(['<', 'created_at', $tsTo])
//                ->count();
            /* ------------------------------------------------------ */
            $analise->download = Dailies::find()
                ->andwhere(['>=', 'time', $tsFrom])
                ->andwhere(['<', 'time', $tsTo])
                ->andwhere(['like', 'request', '/post/default/download?'])
                ->count();
            /* ------------------------------------------------------ */
            $analise->error = Dailies::find()
                ->andwhere(['>=', 'time', $tsFrom])
                ->andwhere(['<', 'time', $tsTo])
                ->andwhere(['>', 'status_code', 399])
                ->count();
            /* ------------------------------------------------------ */
            $analise->most_visitor_user = Dailies::find()
                ->andwhere(['>=', 'time', $tsFrom])
                ->andwhere(['<', 'time', $tsTo])
                ->andwhere(['>', 'user_id', 0])
                ->groupBy('user_id')
                ->select('user_id')
                ->orderBy('count(user_id) desc')
                ->limit('20')
                ->column();
            $analise->most_visitor_user = implode(', ', $analise->most_visitor_user);
            /* ------------------------------------------------------ */
            $hour_visit = Dailies::find()
                ->andwhere(['>=', 'time', $tsFrom])
                ->andwhere(['<', 'time', $tsTo])
                ->groupBy('hour')
                ->select('count(id) as cnt ,HOUR(FROM_UNIXTIME(`time`)) as `hour`')
                ->orderBy('count(id) desc')
                ->asArray()->all();
            $analise->most_hour = $hour_visit[0]['hour'];
            $analise->visit_in_hour = \yii\helpers\ArrayHelper::map($hour_visit, 'hour', 'cnt');
            $analise->visit_in_hour = var_export($analise->visit_in_hour, TRUE);
            /* ------------------------------------------------------ */
            $maturity = Dailies::find()
                ->andwhere(['>=', 'time', $tsFrom])
                ->andwhere(['<', 'time', $tsTo])
                ->groupBy('maturity')
                ->select('count(id) as cnt ,maturity')
                ->orderBy('count(id) desc')
                ->asArray()->all();
//            $stdMtr = \globals\direct\User::maturites();
//            foreach ($maturity as &$value) {
//                if (isset($stdMtr[$value['maturity']])) {
//                    $value['maturity'] = $stdMtr[$value['maturity']]['shortTitle'];
//                }
//            }
            $analise->maturities = \yii\helpers\ArrayHelper::map($maturity, 'maturity', 'cnt');
            $analise->maturities = var_export($analise->maturities, TRUE);
            /* ------------------------------------------------------ */
            $gender = Dailies::find()
                ->andwhere(['>=', 'time', $tsFrom])
                ->andwhere(['<', 'time', $tsTo])
                ->groupBy('gender')
                ->select('count(id) as cnt ,gender')
                ->orderBy('count(id) desc')
                ->asArray()->all();
//            $stdGnt = \globals\direct\UserProfile::genders();
//            foreach ($gender as &$value) {
//                if (isset($stdGnt[$value['gender']])) {
//                    $value['gender'] = $stdGnt[$value['gender']]['title'];
//                } else {
//                    $value['gender'] = \Yii::t('rabint', 'نامشخص');
//                }
//            }
            $analise->genders = \yii\helpers\ArrayHelper::map($gender, 'gender', 'cnt');
            $analise->genders = var_export($analise->genders, TRUE);
            /* ------------------------------------------------------ */
            /* ------------------------------------------------------ */
            $details = Dailies::find()
                ->andwhere(['>=', 'time', $tsFrom])
                ->andwhere(['<', 'time', $tsTo])
                ->asArray()->all();
            $platforms = $agents = $referers = $actions = $err_actions = [];
            foreach ($details as $row) {
                $ag = \rabint\stats\stats::parse_user_agent($row['agent']);
//            return array('platform' => $platform ?: null, 'browser' => $browser ?: null, 'version' => $version ?: null);
                if (!empty($ag['platform'])) {
                    $platforms[$ag['platform']] = (isset($platforms[$ag['platform']])) ? $platforms[$ag['platform']] + 1 : 1;
                }
                if (!empty($ag['browser'])) {
                    if ($ag['browser'] == 'MSIE') {
                        $ver = intval($ag['version']);
                        $ag['browser'] = $ag['browser'] . '_' . $ver;
                    }
                    $agents[$ag['browser']] = (isset($agents[$ag['browser']])) ? $agents[$ag['browser']] + 1 : 1;
                }
                $ag['agent'] = $row['agent'];
                /* ------------------------------------------------------ */
                if (!empty($row['referer'])) {
                    $res = parse_url($row['referer']);
                    $referers[$res['host']] = (isset($referers[$res['host']])) ? $referers[$res['host']] + 1 : 1;
                }

                $trimAction = $row['request'];
                if (strpos($trimAction, '?')) {
                    $trimAction = substr($trimAction, 0, strpos($trimAction, '?'));
                }
                $rex = '((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.)[A-Za-z0-9.-]+)((?:\/[A-Za-z0-9.-\/_]*)?)?)';
                preg_match($rex, $trimAction, $arr);
                $trimAction = $arr[0];
                $actions[$trimAction] = (isset($actions[$trimAction])) ? $actions[$trimAction] + 1 : 1;
                if ($row['status_code'] > 399) {
                    $err_actions[$trimAction] = $row['status_code'];
                }
            }

            arsort($platforms);
            arsort($agents);
            arsort($referers);
            arsort($actions);
            arsort($err_actions);

            $analise->interface = var_export($platforms, true);
            $analise->agents = var_export($agents, true);
            $analise->referer = var_export($referers, true);
            $analise->most_visited_action = var_export($actions, true);
            $analise->most_error_action = var_export($err_actions, true);

            /* ------------------------------------------------------ */
//        $analise->countries;
//        $analise->restricted;
//        $analise->restricted_ip;
//        $analise->utms;

//            if ($oldAnalise->visit >= $analise->visit) {
//                return FALSE;
//            } else {
//                Stats::deleteAll(['date' => $date]);
//            }
            if ($analise->save()) {
                if ($remove_dailies) {
                    static::DailiesToLog($date);
                }
                return TRUE;
            }
            return FALSE;
        } catch (\Exception $e) {
            var_dump($e);exit();
            //todo loging
        }
    }

    static function DailiesToLog($date)
    {
        $logTarget = \Yii::getAlias('@app/runtime/logs/visits') . '/' . date('Y');
        if (!file_exists($logTarget)) {
            mkdir($logTarget, 0777, TRUE);
        }
        $fileName = date('W') . '.sql';

        if (file_exists($logTarget . '/' . $fileName)) {
            unlink($logTarget . '/' . $fileName);
        }
        /* ------------------------------------------------------ */
        $tsFrom = strtotime($date . ' 00:00:00');
        $tsTo = $tsFrom + 86400;
        $dailies = Dailies::find()
            ->andwhere(['>=', 'time', $tsFrom])
            ->andwhere(['<', 'time', $tsTo])
            ->asArray()->all();
        foreach ($dailies as $row) {
            $output = "INSERT INTO `stat_dailies`(`id`, `time`, `user_id`, `maturity`, `gender`, `request`, `status_code`, `agent`, `ip`, `request_type`, `request_params`, `utm`, `referer`)
            VALUES ('".$row['id']."','".$row['time']."','".$row['user_id']."','".$row['maturity']."','".$row['gender']."','".$row['request']."','".$row['status_code']."','".$row['agent']."','".$row['ip']."','".$row['request_type']."','".$row['request_params']."','".$row['utm']."','".$row['referer']."');". PHP_EOL;
            file_put_contents($logTarget . '/' . $fileName, $output, FILE_APPEND);
        }
        return Dailies::deleteAll(['and', ['>=', 'time', $tsFrom], ['<', 'time', $tsTo]]);
    }

}
