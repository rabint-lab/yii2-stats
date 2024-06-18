<?php

use yii\helpers\Html;
use rabint\stats\models\Dailies;
use rabint\stats\models\Stats;

/* @var $this yii\web\View */
/* @var $model rabint\stats\models\Stats */

$this->title = \Yii::t('rabint', 'چکیده آمار');
$this->params['breadcrumbs'][] = $this->title;
$todateFrom = strtotime(date('Y-m-d') . ' 00:00:00');
$todateTo = $todateFrom + 86400;
?>
<div class="view-card stats-review">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-sm-12">
            <?= Html::a(Yii::t('rabint', 'تحلیل روز های انجام نشده'), ['/stats/default/analyse-all'], ['target' => '_BLANK', 'class' => 'btn btn-warning']) ?>
        </div>
        <div class="clearfix spacer"></div>
        <!-- ################################################################### -->
        <!-- ################################################################### -->
        <div class="col-md-4">
            <div class="card card-info card-solid mb-4">
                <div class="card-header with-border">
                    <h3 class="card-title"><?= \Yii::t('rabint', 'تعداد بازدید'); ?></h3>

                </div><!-- /.card-header -->
                <div class="card-body no-padding" style="display: block;">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover ">
                            <tr>
                                <th></th>
                                <th class="center"><?= \Yii::t('rabint', 'بازدید'); ?></th>
                                <th class="center"><?= \Yii::t('rabint', 'بازدیدکننده'); ?></th>
                            </tr>
                            <tr>
                                <td><?= \Yii::t('rabint', 'امروز'); ?></td>
                                <td class="center"><span class="badge bg-green"><?php
                                        echo number_format(Dailies::find()
                                            ->andwhere(['>=', 'time', $todateFrom])
                                            ->andwhere(['<', 'time', $todateTo])
                                            ->count());
                                        ?></span></td>
                                <td class="center"><span class="badge bg-red"><?php
                                        echo number_format(Dailies::find()
                                            ->select('agent')
                                            ->andwhere(['>=', 'time', $todateFrom])
                                            ->andwhere(['<', 'time', $todateTo])
                                            ->groupBy('agent')
                                            ->count());
                                        ?></span></td>
                            </tr>
                            <tr>
                                <td><?= \Yii::t('rabint', 'دیروز'); ?></td>
                                <td class="center"><span class="badge bg-green"><?php
                                        echo number_format(Stats::find()
                                            ->where(['date' => date("Y-m-d", strtotime('-1 day'))])
                                            ->select('visit')->scalar());
                                        ?></span></td>
                                <td class="center"><span class="badge bg-red"><?php
                                        echo number_format(Stats::find()
                                            ->where(['date' => date("Y-m-d", strtotime('-1 day'))])
                                            ->select('visitor')->scalar());
                                        ?></span></td>
                            </tr>
                            <tr>
                                <td><?= \Yii::t('rabint', 'این هفته'); ?></td>
                                <td class="center"><span class="badge bg-green"><?php
                                        echo number_format(Stats::find()
                                            ->andwhere(['<', 'date', date("Y-m-d", strtotime('-1 day'))])
                                            ->andwhere(['>=', 'date', date("Y-m-d", strtotime('-8 day'))])
                                            ->sum('visit'));
                                        ?></span></td>
                                <td class="center"><span class="badge bg-red"><?php
                                        echo number_format(Stats::find()
                                            ->andwhere(['<', 'date', date("Y-m-d", strtotime('-1 day'))])
                                            ->andwhere(['>=', 'date', date("Y-m-d", strtotime('-8 day'))])
                                            ->sum('visitor'));
                                        ?></span></td>
                            </tr>
                            <tr>
                                <td><?= \Yii::t('rabint', 'هفته گذشته'); ?></td>
                                <td class="center"><span class="badge bg-green"><?php
                                        echo number_format(Stats::find()
                                            ->andwhere(['<', 'date', date("Y-m-d", strtotime('-8 day'))])
                                            ->andwhere(['>=', 'date', date("Y-m-d", strtotime('-15 day'))])
                                            ->sum('visit'));
                                        ?></span></td>
                                <td class="center"><span class="badge bg-red"><?php
                                        echo number_format(Stats::find()
                                            ->andwhere(['<', 'date', date("Y-m-d", strtotime('-8 day'))])
                                            ->andwhere(['>=', 'date', date("Y-m-d", strtotime('-15 day'))])
                                            ->sum('visitor'));
                                        ?></span></td>
                            </tr>
                            <tr>
                                <td><?= \Yii::t('rabint', 'این ماه'); ?></td>
                                <td class="center"><span class="badge bg-green"><?php
                                        echo number_format(Stats::find()
                                            ->andwhere(['<', 'date', date("Y-m-d", strtotime('-1 day'))])
                                            ->andwhere(['>=', 'date', date("Y-m-d", strtotime('-31 day'))])
                                            ->sum('visit'));
                                        ?></span></td>
                                <td class="center"><span class="badge bg-red"><?php
                                        echo number_format(Stats::find()
                                            ->andwhere(['<', 'date', date("Y-m-d", strtotime('-1 day'))])
                                            ->andwhere(['>=', 'date', date("Y-m-d", strtotime('-31 day'))])
                                            ->sum('visitor'));
                                        ?></span></td>
                            </tr>
                            <tr>
                                <td><?= \Yii::t('rabint', 'ماه گذشته'); ?></td>
                                <td class="center"><span class="badge bg-green"><?php
                                        echo number_format(Stats::find()
                                            ->andwhere(['<', 'date', date("Y-m-d", strtotime('-31 day'))])
                                            ->andwhere(['>=', 'date', date("Y-m-d", strtotime('-61 day'))])
                                            ->sum('visit'));
                                        ?></span></td>
                                <td class="center"><span class="badge bg-red"><?php
                                        echo number_format(Stats::find()
                                            ->andwhere(['<', 'date', date("Y-m-d", strtotime('-31 day'))])
                                            ->andwhere(['>=', 'date', date("Y-m-d", strtotime('-61 day'))])
                                            ->sum('visitor'));
                                        ?></span></td>
                            </tr>
                            <tr>
                                <td><?= \Yii::t('rabint', 'کل'); ?></td>
                                <td class="center"><span class="badge bg-green"><?php
                                        echo number_format(Stats::find()
                                            ->sum('visit'));
                                        ?></span></td>
                                <td class="center"><span class="badge bg-red"><?php
                                        echo number_format(Stats::find()
                                            ->sum('visitor'));
                                        ?></span></td>
                            </tr>
                        </table>
                    </div>
                </div><!-- /.card-body -->
            </div><!-- /.card -->

            <!-- =================================================================== -->
        </div>
        <!-- ################################################################### -->
        <!-- ################################################################### -->

        <div class="col-md-8">
            <div class="card card-success card-solid mb-4">
                <div class="card-header with-border">
                    <h3 class="card-title"><?= \Yii::t('rabint', 'نمودار بازدید'); ?></h3>

                </div><!-- /.card-header -->
                <div class="card-body no-padding" style="display: block;">
                    <?php
                    $curentWeekVisit = Stats::find()
                        ->andwhere(['<', 'date', date("Y-m-d", strtotime('-1 day'))])
                        ->andwhere(['>=', 'date', date("Y-m-d", strtotime('-8 day'))])
                        ->select('visit')->column();
                    $curentWeekVisitor = Stats::find()
                        ->andwhere(['<', 'date', date("Y-m-d", strtotime('-1 day'))])
                        ->andwhere(['>=', 'date', date("Y-m-d", strtotime('-8 day'))])
                        ->select('visitor')->column();
                    $curentWeekMemVisit = Stats::find()
                        ->andwhere(['<', 'date', date("Y-m-d", strtotime('-1 day'))])
                        ->andwhere(['>=', 'date', date("Y-m-d", strtotime('-8 day'))])
                        ->select('member_visit')->column();
                    $curentWeekMemVisitor = Stats::find()
                        ->andwhere(['<', 'date', date("Y-m-d", strtotime('-1 day'))])
                        ->andwhere(['>=', 'date', date("Y-m-d", strtotime('-8 day'))])
                        ->select('member_visitor')->column();
                    ?>
                    <?=
                    dosamigos\chartjs\ChartJs::widget([
                        'type' => 'line',
                        'data' => [
                            'labels' => [
                                \rabint\helpers\locality::jdate('l-j F', strtotime('-7 day')),
                                \rabint\helpers\locality::jdate('l-j F', strtotime('-6 day')),
                                \rabint\helpers\locality::jdate('l-j F', strtotime('-5 day')),
                                \rabint\helpers\locality::jdate('l-j F', strtotime('-4 day')),
                                \rabint\helpers\locality::jdate('l-j F', strtotime('-3 day')),
                                \rabint\helpers\locality::jdate('l-j F', strtotime('-2 day')),
                                \rabint\helpers\locality::jdate('l-j F', strtotime('-1 day')),
                            ],
                            'datasets' =>
                                [
                                    [
                                        'label' => \Yii::t('rabint', 'بازدید'),
                                        'backgroundColor' => "rgba(179,181,198,0.2)",
                                        'borderColor' => "rgba(179,181,198,1)",
                                        'pointBackgroundColor' => "rgba(179,181,198,1)",
                                        'pointBorderColor' => "#fff",
                                        'pointHoverBackgroundColor' => "#fff",
                                        'pointHoverBorderColor' => "rgba(179,181,198,1)",
                                        'data' => $curentWeekVisit
                                    ],
                                    [
                                        'label' => \Yii::t('rabint', 'بازدید کننده'),
                                        'backgroundColor' => "rgba(255,99,132,0.2)",
                                        'borderColor' => "rgba(255,99,132,1)",
                                        'pointBackgroundColor' => "rgba(255,99,132,1)",
                                        'pointBorderColor' => "#fff",
                                        'pointHoverBackgroundColor' => "#fff",
                                        'pointHoverBorderColor' => "rgba(255,99,132,1)",
                                        'data' => $curentWeekVisitor
                                    ],
                                    [
                                        'label' => \Yii::t('rabint', 'بازدید اعضاء'),
                                        'backgroundColor' => "rgba(99,255,132,0.2)",
                                        'borderColor' => "rgba(99,255,132,1)",
                                        'pointBackgroundColor' => "rgba(99,255,132,1)",
                                        'pointBorderColor' => "#fff",
                                        'pointHoverBackgroundColor' => "#fff",
                                        'pointHoverBorderColor' => "rgba(99,255,132,1)",
                                        'data' => $curentWeekMemVisit
                                    ],
                                    [
                                        'label' => \Yii::t('rabint', 'اعضای بازدید کننده'),
                                        'backgroundColor' => "rgba(255,132,99,0.2)",
                                        'borderColor' => "rgba(255,132,99,1)",
                                        'pointBackgroundColor' => "rgba(255,132,99,1)",
                                        'pointBorderColor' => "#fff",
                                        'pointHoverBackgroundColor' => "#fff",
                                        'pointHoverBorderColor' => "rgba(255,132,99,1)",
                                        'data' => $curentWeekMemVisitor
                                    ]
                                ]
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>

        <!-- ################################################################### -->
        <!-- ################################################################### -->

        <div class="col-md-6">
            <div class="card card-danger card-solid mb-4">
                <div class="card-header with-border">
                    <h3 class="card-title"><?= \Yii::t('rabint', 'نمودار مرورگر'); ?></h3>

                </div><!-- /.card-header -->
                <div class="card-body no-padding" style="display: block;">
                    <?php
                    $allMaturities = Stats::find()
                        ->andWhere(['not', ['agents' => null]])
                        ->select('agents')->column();
                    $res = [
                    ];
                    foreach ($allMaturities as $aCol) {
                        //eval('$row=' . $aCol . ';');
                        $row = json_decode($aCol, 1);
                        foreach ((array)$row as $key => $value) {
                            if (isset($res[$key])) {
                                $res[$key] += $value;
                            } else {
                                if (count($res) < 10) {
                                    $res[$key] = $value;
                                }
                            }
                        }
                    }
                    ksort($res);
                    ?>
                    <?=
                    dosamigos\chartjs\ChartJs::widget([
                        'type' => 'pie',
                        'data' => ['datasets' =>
                            [0 =>
                                ['data' => array_values($res),
                                    'backgroundColor' => [
                                        '#E7E9ED',
                                        '#FF6384',
                                        '#4BC0C0',
                                        '#36A2EB',
                                        '#A236EB',
                                        '#EB36A2',
                                        '#FFCE56',
                                        '#F7E9ED',
                                        '#FF63F4',
                                        '#FBC0C0',
                                    ],
                                ],
                            ],
                            'labels' => array_keys($res),
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <!-- ################################################################### -->
        <!-- ################################################################### -->

        <!-- ################################################################### -->
        <!-- ################################################################### -->

        <div class="col-md-6">
            <div class="card card-default card-solid mb-4">
                <div class="card-header with-border">
                    <h3 class="card-title"><?= \Yii::t('rabint', 'لینک دهنده'); ?></h3>

                </div><!-- /.card-header -->
                <div class="card-body no-padding" style="display: block;">
                    <?php
                    $allMaturities = Stats::find()
                        ->andWhere(['not', ['referer' => null]])
                        ->select('referer')->column();
                    $res = [
                    ];
                    foreach ($allMaturities as $aCol) {
                        //eval('$row=' . $aCol . ';');
                        $row = json_decode($aCol, 1);
                        foreach ((array)$row as $key => $value) {
                            if (isset($res[$key])) {
                                $res[$key] += $value;
                            } else {
                                if (count($res) < 10) {
                                    $res[$key] = $value;
                                }
                            }
                        }
                    }
                    ksort($res);
                    ?>
                    <?=
                    dosamigos\chartjs\ChartJs::widget([
                        'type' => 'pie',
                        'data' => ['datasets' =>
                            [0 =>
                                ['data' => array_values($res),
                                    'backgroundColor' => [
                                        '#E7E9ED',
                                        '#FF6384',
                                        '#4BC0C0',
                                        '#36A2EB',
                                        '#A236EB',
                                        '#EB36A2',
                                        '#FFCE56',
                                        '#F7E9ED',
                                        '#FF63F4',
                                        '#FBC0C0',
                                    ],
                                ],
                            ],
                            'labels' => array_keys($res),
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <!-- ################################################################### -->
        <!-- ################################################################### -->

        <!-- ################################################################### -->
        <!-- ################################################################### -->
        <?php /* ********************************** * / ?>
        <div class="col-md-6">
            <div class="card card-warning card-solid mb-4">
                <div class="card-header with-border">
                    <h3 class="card-title"><?= \Yii::t('rabint', 'نمودار گروه سنی'); ?></h3>

                </div><!-- /.card-header -->
                <div class="card-body no-padding" style="display: block;">
                    <?php
                    $allMaturities = Stats::find()
                        ->andWhere(['not', ['maturities' => null]])
                        ->select('maturities')->column();
                    $res = [
                        "نامشخص" => 0,
                        "هـ" => 0,
                        "د" => 0,
                        "ج" => 0,
                        "ب" => 0,
                        "الف" => 0,
                        "زیر الف" => 0,
                    ];
                    foreach ($allMaturities as $aCol) {
                        //eval('$row=' . $aCol . ';');
                        $row = json_decode($aCol,1);
                        foreach ((array) $row as $key => $value) {
                            if (isset($res[$key])) {
                                $res[$key] += $value;
//                            } else {
//                                $res[$key] = $value;
                            }
                        }
                    }
                    ?>
                    <?=
                    dosamigos\chartjs\ChartJs::widget([
                        'type' => 'pie',
                        'data' => ['datasets' =>
                            [0 =>
                                ['data' => array_values($res),
                                    'backgroundColor' => [
                                        '#E7E9ED',
                                        '#FF6384',
                                        '#4BC0C0',
                                        '#36A2EB',
                                        '#A236EB',
                                        '#EB36A2',
                                        '#FFCE56',
                                    ],
                                ],
                            ],
                            'labels' => array_keys($res),
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <!-- ################################################################### -->
        <!-- ################################################################### -->

        <div class="col-md-6">
            <div class="card card-primary card-solid mb-4">
                <div class="card-header with-border">
                    <h3 class="card-title"><?= \Yii::t('rabint', 'نمودار جنسیت'); ?></h3>

                </div><!-- /.card-header -->
                <div class="card-body no-padding" style="display: block;">
                    <?php
                    $allMaturities = Stats::find()
                        ->andWhere(['not', ['genders' => null]])
                        ->select('genders')->column();
                    $res = [
                        "نامشخص" => 0,
                        "مؤنث" => 0,
                        "مذکر" => 0,
                    ];
                    foreach ($allMaturities as $aCol) {
                        //eval('$row=' . $aCol . ';');
                        $row = json_decode($aCol,1);
                        foreach ((array) $row as $key => $value) {
                            if (isset($res[$key])) {
                                $res[$key] += $value;
//                            } else {
//                                $res[$key] = $value;
                            }
                        }
                    }
                    ?>
                    <?=
                    dosamigos\chartjs\ChartJs::widget([
                        'type' => 'pie',
                        'data' => ['datasets' =>
                            [0 =>
                                ['data' => array_values($res),
                                    'backgroundColor' => [
                                        '#E7E9ED',
                                        '#FF6384',
                                        '#4BC0C0',
                                    ],
                                ],
                            ],
                            'labels' => array_keys($res),
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>

        <?php /* ********************************** */ ?>


        <div class="col-md-12">
            <div class="card card-default card-solid mb-4">
                <div class="card-header with-border">
                    <h3 class="card-title"><?= \Yii::t('rabint', 'مدیریت ها'); ?></h3>

                </div><!-- /.card-header -->
                <div class="card-body no-padding" style="display: block;">
                    <?php
                    $dataSet = [];
                    $data = [];



                    $postStats = Yii::$app->db
                        ->createCommand(
                            "
                        SELECT g.title, p.group_id, SUM(p.visit_count) AS visit
                        FROM `pst_post` p
                        JOIN `pst_group` g ON p.group_id = g.id
                        GROUP BY p.group_id;
 "
                        )
                        ->queryAll();

                    $postStats = \yii\helpers\ArrayHelper::map($postStats,'title','visit');
                    $data['label'] = Yii::t('app', 'تعداد بازدید');
                    $data['select_label'] = Yii::t('app', 'تعداد بازدید');
                    $data['data'] = $postStats;
                    $data['yLabel'] = Yii::t('app', 'سال ');
                    $data['xLabel'] = Yii::t('app', 'درصد ');
//
//
                    $dataSet[] = $data;
//                    $dataSet[] = [
//                        'label'=>  Yii::t('app', 'ستون دوم'),
//                        'select_label' => Yii::t('app', 'ستون دوم'),
//                        'data' => ['a' => 126, 'b' => 101, 'c' => 95, 'd' => 124],
//                        'yLabel' => Yii::t('app', 'سال '),
//                        'xLabel' => Yii::t('app', 'درصد '),
//                    ];


                    echo rabint\widgets\chart\ChartWidget::widget([
                        'title' => Yii::t('app', 'تعداد بازدید به تفکیک مدیریت'),
                        'filterTitle' => Yii::t('app', 'مدیریت'),
                        'theme' => 'default',
                        'dataset' => $dataSet,
                        //'type' => \rabint\widgets\chart\ChartWidget::TYPE_LINE,
                        'xLabel' => '',
                        'yLabel' => Yii::t('app', 'تعداد'),
                        //'defaultFontFamily' => 'vazir_fd',
                    ]);

                    ?>
                </div>
            </div>
        </div>

    </div>
</div>



