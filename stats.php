<?php

namespace rabint\stats;

use Yii;
use yii\db\Exception;

class stats extends \yii\base\Module {

    public $controllerNamespace = 'rabint\stats\controllers';

    public function init() {
        parent::init();
    }

    public static function keyStorageGet($key){
        $file_dir = Yii::getAlias('@app/runtime').'/keyStorage.json';
        if(!file_exists($file_dir))
            file_put_contents($file_dir,'{}');
        $data = json_decode($file_dir,true) ;
        return isset($data[$key])?:'';
    }
    public static function keyStorageSet($key,$vlaue){
        $file_dir = Yii::getAlias('@app/runtime').'/keyStorage.json';
        if(!file_exists($file_dir))
            file_put_contents($file_dir,'{}');
        $data = json_decode($file_dir,true);
        $data[$key]=$vlaue;
        file_put_contents($file_dir,json_encode($data));
        chmod($file_dir, 0777);
        return true;
    }

    public static function analiseStats() {
	ignore_user_abort();
	set_time_limit(300);
        $status = self::keyStorageGet('Stats.AnalyseAllStatus');
        if ($status == 'doing') {
            return 'Analyse already started!';
        }
        self::keyStorageSet('Stats.AnalyseAllStatus', 'doing');
        $tsTo = strtotime(date('Y-m-d 00:00:00'));
        $sql = <<<SQL
        SELECT DISTINCT date from (
            SELECT (DATE( FROM_UNIXTIME( time ) )) as date FROM `stat_dailies` WHERE `time` < NOW() ORDER BY `time` DESC
        ) a
SQL;

        $allDates = \Yii::$app->db->createCommand($sql)->queryAll();
//        $allDates = models\Dailies::find()
//                        ->andwhere(['<', 'time', $tsTo])
//                        ->select(new \yii\db\Expression('DISTINCT(DATE( FROM_UNIXTIME( time ) )) as date'))
//            ->orderBy(["time"=>SORT_DESC])
////            ->limit()
//            ->column();
        if (empty($allDates)) {
            self::keyStorageSet('Stats.AnalyseAllStatus', 'done');
            return 'no date for analyse.';
        }
        //todo add time tracing
        $start = microtime(true);
        $total = count($allDates);
        \rabint\helpers\process::simpleOutputProgress(0,$total,"start analyse.");
        foreach ($allDates as $k=>$date) {
            if ($date['date'] == date('Y-m-d')) {
                continue;
            }
            models\Stats::analyse($date['date']);
            //todo add time tracing
            $time_elapsed_secs = microtime(true) - $start;
            if($time_elapsed_secs>250){
                break;
            }
            \rabint\helpers\process::simpleOutputProgress($k+1,$total,"done analyse date: ".$date['date']);
            self::keyStorageSet('Stats.AnalyseAllStatus', 'doing-'.$date['date']);
        }
        self::keyStorageSet('Stats.AnalyseAllStatus', 'done');
        return 'analise All done!';
    }

    public static function stat() {
        $REQUEST = Yii::$app->getRequest();
        if (
                !isset($REQUEST->isGet) OR ! isset($REQUEST->isPost) OR ! isset($REQUEST->isAjax) OR ! isset($REQUEST->isPjax) OR ! isset($REQUEST->isPut)
        ) {
            return;
        }
        $model = new models\Dailies();
        $request_type = (($REQUEST->isPjax) ? 'pjax/' :(($REQUEST->isAjax) ? 'ajax/' :(($REQUEST->isConsoleRequest) ? 'console/' : 'normal/')));
        $request_type .= $REQUEST->getMethod();
        $request_type .= ($REQUEST->isFlash) ? '/flash' : '';
        $request_type .= ($REQUEST->isOptions) ? '/options' : '';
        $request_type .= ($REQUEST->port) ? ':' . $REQUEST->port : '';

        $model->request_type = $request_type;
        $model->ip = $REQUEST->getUserIP();
        $model->request = $REQUEST->absoluteUrl;
        $model->time = time();
        $model->user_id = Yii::$app->user->getId() ?: 0;
        $model->maturity = \rabint\helpers\user::userMaturity();
        $model->gender = \rabint\helpers\user::userGender();
        $model->agent = $REQUEST->getUserAgent();
        $model->utm = '';
        $model->referer = Yii::$app->request->referrer;
        $model->status_code = Yii::$app->response->statusCode;
        $model->save();
    }

    /* admin menu ======================================================== */

    public static function adminMenu() {
        return [
            'label' => Yii::t('rabint', 'آمار بازدید'),
            'url' => '#',
            'icon' => '<i class="fas fa-bars "></i>',
            'options' => ['class' => 'treeview'],
            'items' => [
                    ['label' => Yii::t('rabint', 'چکیده'), 'url' => ['/stats/admin/review'], 'icon' => '<i class="far fa-circle"></i>'],
                    ['label' => Yii::t('rabint', 'آمار به تفکیک روز'), 'url' => ['/stats/admin/index'], 'icon' => '<i class="far fa-circle"></i>'],
                    //['label' => Yii::t('rabint', 'آمار تعداد مطالب'), 'url' => ['/stats/admin/content'], 'icon' => '<i class="far fa-circle"></i>'],
            ]
        ];
    }

    /**
     * Parses a user agent string into its important parts
     *
     * @author Jesse G. Donat <donatj@gmail.com>
     * @link https://github.com/donatj/PhpUserAgent
     * @link http://donatstudios.com/PHP-Parser-HTTP_USER_AGENT
     * @param string|null $u_agent User agent string to parse or null. Uses $_SERVER['HTTP_USER_AGENT'] on NULL
     * @throws \InvalidArgumentException on not having a proper user agent to parse.
     * @return string[] an array with browser, version and platform keys
     */
    public static function parse_user_agent($u_agent = null) {
        if (is_null($u_agent)) {
            if (isset($_SERVER['HTTP_USER_AGENT'])) {
                $u_agent = $_SERVER['HTTP_USER_AGENT'];
            } else {
                throw new \InvalidArgumentException('parse_user_agent requires a user agent');
            }
        }
        $platform = null;
        $browser = null;
        $version = null;
        $empty = array('platform' => $platform, 'browser' => $browser, 'version' => $version);
        if (!$u_agent)
            return $empty;
        if (preg_match('/\((.*?)\)/im', $u_agent, $parent_matches)) {
            preg_match_all('/(?P<platform>BB\d+;|Android|CrOS|Tizen|iPhone|iPad|iPod|Linux|Macintosh|Windows(\ Phone)?|Silk|linux-gnu|BlackBerry|PlayBook|X11|(New\ )?Nintendo\ (WiiU?|3?DS)|Xbox(\ One)?)
				(?:\ [^;]*)?
				(?:;|$)/imx', $parent_matches[1], $result, PREG_PATTERN_ORDER);
            $priority = array('Xbox One', 'Xbox', 'Windows Phone', 'Tizen', 'Android', 'CrOS', 'X11');
            $result['platform'] = array_unique($result['platform']);
            if (count($result['platform']) > 1) {
                if ($keys = array_intersect($priority, $result['platform'])) {
                    $platform = reset($keys);
                } else {
                    $platform = $result['platform'][0];
                }
            } elseif (isset($result['platform'][0])) {
                $platform = $result['platform'][0];
            }
        }
        if ($platform == 'linux-gnu' || $platform == 'X11') {
            $platform = 'Linux';
        } elseif ($platform == 'CrOS') {
            $platform = 'Chrome OS';
        }
        preg_match_all('%(?P<browser>Camino|Kindle(\ Fire)?|Firefox|Iceweasel|Safari|MSIE|Trident|AppleWebKit|TizenBrowser|Chrome|
				Vivaldi|IEMobile|Opera|OPR|Silk|Midori|Edge|CriOS|UCBrowser|
				Baiduspider|Googlebot|YandexBot|bingbot|Lynx|Version|Wget|curl|
				Valve\ Steam\ Tenfoot|
				NintendoBrowser|PLAYSTATION\ (\d|Vita)+)
				(?:\)?;?)
				(?:(?:[:/ ])(?P<version>[0-9A-Z.]+)|/(?:[A-Z]*))%ix', $u_agent, $result, PREG_PATTERN_ORDER);
        // If nothing matched, return null (to avoid undefined index errors)
        if (!isset($result['browser'][0]) || !isset($result['version'][0])) {
            if (preg_match('%^(?!Mozilla)(?P<browser>[A-Z0-9\-]+)(/(?P<version>[0-9A-Z.]+))?%ix', $u_agent, $result)) {
                return array('platform' => $platform ?: null, 'browser' => $result['browser'], 'version' => isset($result['version']) ? $result['version'] ?: null : null);
            }
            return $empty;
        }
        if (preg_match('/rv:(?P<version>[0-9A-Z.]+)/si', $u_agent, $rv_result)) {
            $rv_result = $rv_result['version'];
        }
        $browser = $result['browser'][0];
        $version = $result['version'][0];
        $lowerBrowser = array_map('strtolower', $result['browser']);
        $find = function ( $search, &$key, &$value = null ) use ( $lowerBrowser ) {
            $search = (array) $search;
            foreach ($search as $val) {
                $xkey = array_search(strtolower($val), $lowerBrowser);
                if ($xkey !== false) {
                    $value = $val;
                    $key = $xkey;
                    return true;
                }
            }
            return false;
        };
        $key = 0;
        $val = '';
        if ($browser == 'Iceweasel') {
            $browser = 'Firefox';
        } elseif ($find('Playstation Vita', $key)) {
            $platform = 'PlayStation Vita';
            $browser = 'Browser';
        } elseif ($find(array('Kindle Fire', 'Silk'), $key, $val)) {
            $browser = $val == 'Silk' ? 'Silk' : 'Kindle';
            $platform = 'Kindle Fire';
            if (!($version = $result['version'][$key]) || !is_numeric($version[0])) {
                $version = $result['version'][array_search('Version', $result['browser'])];
            }
        } elseif ($find('NintendoBrowser', $key) || $platform == 'Nintendo 3DS') {
            $browser = 'NintendoBrowser';
            $version = $result['version'][$key];
        } elseif ($find('Kindle', $key, $platform)) {
            $browser = $result['browser'][$key];
            $version = $result['version'][$key];
        } elseif ($find('OPR', $key)) {
            $browser = 'Opera Next';
            $version = $result['version'][$key];
        } elseif ($find('Opera', $key, $browser)) {
            $find('Version', $key);
            $version = $result['version'][$key];
        } elseif ($find(array('IEMobile', 'Edge', 'Midori', 'Vivaldi', 'Valve Steam Tenfoot', 'Chrome'), $key, $browser)) {
            $version = $result['version'][$key];
        } elseif ($browser == 'MSIE' || ($rv_result && $find('Trident', $key))) {
            $browser = 'MSIE';
            $version = $rv_result ?: $result['version'][$key];
        } elseif ($find('UCBrowser', $key)) {
            $browser = 'UC Browser';
            $version = $result['version'][$key];
        } elseif ($find('CriOS', $key)) {
            $browser = 'Chrome';
            $version = $result['version'][$key];
        } elseif ($browser == 'AppleWebKit') {
            if ($platform == 'Android' && !($key = 0)) {
                $browser = 'Android Browser';
            } elseif (strpos($platform, 'BB') === 0) {
                $browser = 'BlackBerry Browser';
                $platform = 'BlackBerry';
            } elseif ($platform == 'BlackBerry' || $platform == 'PlayBook') {
                $browser = 'BlackBerry Browser';
            } else {
                $find('Safari', $key, $browser) || $find('TizenBrowser', $key, $browser);
            }
            $find('Version', $key);
            $version = $result['version'][$key];
        } elseif ($pKey = preg_grep('/playstation \d/i', array_map('strtolower', $result['browser']))) {
            $pKey = reset($pKey);
            $platform = 'PlayStation ' . preg_replace('/[^\d]/i', '', $pKey);
            $browser = 'NetFront';
        }
        return array('platform' => $platform ?: null, 'browser' => $browser ?: null, 'version' => $version ?: null);
    }

    function ip_info($ip = NULL, $purpose = "countrycode", $deep_detect = TRUE) {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city" => @$ipdat->geoplugin_city,
                            "state" => @$ipdat->geoplugin_regionName,
                            "country" => @$ipdat->geoplugin_countryName,
                            "country_code" => @$ipdat->geoplugin_countryCode,
                            "continent" => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }

}
