<?php

/* @var $this yii\web\View */
/* @var $model rabint\stats\models\Stats */

//$this->title = $model->date;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rabint', 'آمار'), 'url' => ['review']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('rabint', 'تعداد مطال'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="view-card stats-view">
    <div class="clearfix"></div>
    <div class="row">


        <div class="col-12 col-sm-12 col-md-4 col-lg-3">

            <div class="card card-warning card-solid">
                <div class="card-header with-border">
                    <h3 class="card-title"><?= Yii::t('rabint', 'چکیده') ?></h3>
                </div><!-- /.card-header -->
                <div class="card-body no-padding">
                    <ul class="">
                        <li style="display:block">
                            <a href="#">
                                <?= Yii::t('rabint', 'تعداد مطالب ارسالی') ?>
                                <span class="pull-left float-left badge bg-green"><?=
                                    app\modules\post\models\Post::find()->where([
//                                'user_id' => $model->id
                                    ])->count();
                                    ?></span>
                            </a>
                        </li>

                        <li style="display:block">
                            <a href="#">
                                <?= Yii::t('rabint', 'تعداد مطالب ارسالی 30 روز اخیر') ?>
                                <span class="pull-left float-left badge bg-green-active">
                                    <?=
                                    app\modules\post\models\Post::find()
                                        ->andWhere(
                                            [
//                                                    'user_id' => $model->id,
                                            ]
                                        )->andWhere(['>=', 'created_at', (time() - \rabint\cheatsheet\Time::SECONDS_IN_A_MONTH)])
                                        ->count("*");
                                    ?>
                                </span>
                            </a>
                        </li>

                        <li style="display:block">
                            <a href="#">
                                <?= Yii::t('rabint', 'تعداد مطالب ارسالی 7 روز اخیر') ?>
                                <span class="pull-left float-left badge bg-green-gradient">
                                    <?=
                                    app\modules\post\models\Post::find()
                                        ->andWhere(
                                            [
//                                                    'user_id' => $model->id,
                                            ]
                                        )->andWhere(['>=', 'created_at', (time() - \rabint\cheatsheet\Time::SECONDS_IN_A_WEEK)])
                                        ->count("*");
                                    //                                echo $res->createCommand()->rawSql;
                                    ?>
                                </span>
                            </a>
                        </li>
                        <li style="display:block">
                            <a href="#">
                                <?= Yii::t('rabint', 'تعداد مطالب ارسالی 24 ساعت اخیر') ?>
                                <span class="pull-left float-left badge bg-green-gradient">
                                    <?=
                                    app\modules\post\models\Post::find()
                                        ->andWhere(
                                            [
//                                                    'user_id' => $model->id,
                                            ]
                                        )->andWhere(['>=', 'created_at', (time() - \rabint\cheatsheet\Time::SECONDS_IN_A_DAY)])
                                        ->count("*");
                                    //                                echo $res->createCommand()->rawSql;
                                    ?>
                                </span>
                            </a>
                        </li>

                    </ul>
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div>


        <div class="col-12 col-sm-12 col-md-8 col-lg-9 mb-4">
            <div class="card card-success card-solid">
                <div class="card-header with-border">
                    <h3 class="card-title"><?= Yii::t('rabint', 'آمار مطالب ارسالی') ?></h3>
                </div><!-- /.card-header -->
                <div class="card-body no-padding">
                    <div class="spacer clearfix"></div>
                    <div class="col-sm-12">
                        <form method="get">
                            <?php
                            $from = (isset($_GET['from'])) ? $_GET['from'] : null;
                            $to = (isset($_GET['to'])) ? $_GET['to'] : null;
                            ?>
                            <div class="form-group pull-right float-right">
                                <label> <?= Yii::t('rabint', 'از تاریخ') ?> </label>
                                <?php echo \rabint\helpers\widget::datePickerStatic("from", $from); ?>
                            </div>
                            <div class="pull-right float-right">&nbsp;&nbsp;&nbsp;</div>
                            <div class="form-group pull-right float-right">
                                <label> <?= Yii::t('rabint', 'تا تاریخ') ?> </label>
                                <?php echo \rabint\helpers\widget::datePickerStatic("to", $to); ?>
                            </div>
                            <div class="pull-right float-right">&nbsp;&nbsp;&nbsp;</div>
                            <div class="form-group pull-right float-right">
                                <br/>

                                <input type="submit" class="btn btn-primary" value="<?= Yii::t('rabint', 'اعمال') ?>"/>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                    </div>

                    <div class="spacer clearfix"></div>

                    <ul class="nav nav-stacked">

                        <?php
                        $stime = $etime = NULL;
                        $qStr = " ( 1=1 ";
                        if (!empty($from)) {
                            $stime = \rabint\helpers\locality::jalaliToTimestamp($from);
                            $qStr .= " AND  pst_post.created_at >= " . $stime;
                        }
                        if (!empty($to)) {
                            $etime = \rabint\helpers\locality::jalaliToTimestamp($to);
                            $qStr .= " AND  pst_post.created_at <= " . $etime;
                        }
                        $qStr .= " ) ";
                        ?>
                        <?php $sum = 0; ?>

                        <li>
                            <a href="#">
                                <?= Yii::t('rabint', 'تعداد مطالب ارسالی') ?>
                                <span class="pull-left float-left badge bg-green"><?=
                                    app\modules\post\models\Post::find()
                                        ->andFilterWhere(
                                            [
                                                'and',
                                                ['>=', 'created_at', $stime],
                                                ['<=', 'created_at', $etime]
                                            ])
                                        ->count();
                                    ?></span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <?= Yii::t('rabint', 'تعداد عکس ارسال شده') ?>
                                <span class="pull-left float-left badge bg-green-gradient">
                                    <?=
                                    $t = Yii::$app->db
                                        ->createCommand("SELECT count(*) FROM `pst_attachment` "
                                            . "WHERE post_id in "
                                            . "(SELECT id FROM `pst_post` WHERE `format` = "
                                            . \app\modules\post\models\Post::FORMAT_IMAGE . " and " . $qStr . ")"
                                        )
                                        ->queryScalar();
                                    ?>
                                    <?php $sum += $t; ?>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <?= Yii::t('rabint', 'تعداد ویدئو ارسال شده') ?>
                                <span class="pull-left float-left badge bg-green-gradient">
                                    <?=
                                    $t = Yii::$app->db
                                        ->createCommand("SELECT count(*) FROM `pst_attachment` "
                                            . "WHERE post_id in "
                                            . "(SELECT id FROM `pst_post` WHERE `format` = "
                                            . \app\modules\post\models\Post::FORMAT_VIDEO . " and " . $qStr . ")"
                                        )
                                        ->queryScalar();
                                    ?>
                                    <?php $sum += $t; ?>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <?= Yii::t('rabint', 'تعداد صوت ارسال شده') ?>
                                <span class="pull-left float-left badge bg-green-gradient">
                                    <?=
                                    $t = Yii::$app->db
                                        ->createCommand("SELECT count(*) FROM `pst_attachment` "
                                            . "WHERE post_id in "
                                            . "(SELECT id FROM `pst_post` WHERE `format` = "
                                            . \app\modules\post\models\Post::FORMAT_AUDIO . " and " . $qStr . " )"
                                        )
                                        ->queryScalar();
                                    ?>
                                    <?php $sum += $t; ?>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <?= Yii::t('rabint', 'تعداد مقاله ارسال شده') ?>
                                <span class="pull-left float-left badge bg-green-gradient">
                                    <?=
                                    $t = app\modules\post\models\Post::find()
                                        ->andFilterWhere(
                                            [
                                                'and',
                                                ['>=', 'created_at', $stime],
                                                ['<=', 'created_at', $etime]
                                            ])
                                        ->andWhere(
                                            [
                                                'format' => \app\modules\post\models\Post::FORMAT_ARTICLE,
                                            ]
                                        )
                                        ->count("*");
                                    ?>
                                    <?php $sum += $t; ?>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <?= Yii::t('rabint', 'مجموع فایل ها') ?>
                                <span class="pull-left float-left badge bg-green-gradient">
                                    <?= $sum; ?>
                                </span>
                            </a>
                        </li>

                    </ul>

                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div>


        <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-4">
            <div class="card card-success card-solid">
                <div class="card-header with-border">
                    <h3 class="card-title"><?= Yii::t('rabint', 'بیشترین بازدید') ?></h3>
                </div><!-- /.card-header -->
                <div class="card-body no-padding">
    <ul>
        <li class="row">
            <span class="post_title col-8 col-sm-6"><b><?= Yii::t('app', 'عنوان مطلب');?></b></span>
            <span class="post_gtitle col-3 col-sm-4"><b><?= Yii::t('app', 'گروه');?></b></span>
            <span class="post_visit col-1 col-sm-2 text-center"><b><?= Yii::t('app', 'تعداد بازدید');?></b></span>
        </li>
                    <?php
                    $Posts = Yii::$app->db
                        ->createCommand("
                            SELECT pst_group.title as gtitle, pst_post.title as title ,pst_post.visit_count as visit
                            FROM `pst_post`  
                            LEFT JOIN pst_group on pst_post.group_id = pst_group.id
                            WHERE {$qStr} AND pst_post.visit_count > 1 
                            ORDER BY pst_post.visit_count DESC
                            LIMIT 20
                            "
                        )
                        ->queryAll();
                    foreach ($Posts as $post) {
                        ?>
                        <li class="row">
                            <span class="post_title col-8 col-sm-6">«<?= $post['title'];?>»</span>
                            <span class="post_gtitle col-3 col-sm-4"><?= $post['gtitle'];?></span>
                            <span class="post_visit col-1 col-sm-2  text-center"><?= $post['visit'];?></span>
                        </li>
                        <?php
                    }
                    ?>
    </ul>
                </div>
            </div><!-- /.card -->
        </div>

        <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-4">
            <div class="card card-success card-solid">
                <div class="card-header with-border">
                    <h3 class="card-title"><?= Yii::t('rabint', 'تفکیک مدیریت ها') ?></h3>
                </div><!-- /.card-header -->
                <div class="card-body no-padding">

                    <?php
                    $GroupPosts = Yii::$app->db
                        ->createCommand("
                            SELECT pst_group.title as title, pst_post.group_id, count(pst_post.id) as total_post 
                            FROM `pst_post`  
                            LEFT JOIN pst_group on pst_post.group_id = pst_group.id
                            WHERE {$qStr}
                            GROUP BY group_id"
                        )
                        ->queryAll();
                    foreach ($GroupPosts as &$gp) {
                        if ($gp['title'] == null) {
                            $gp['title'] = Yii::t('app', 'غیره');
                            break;
                        }
                    }
                    ?>

                    <?=
                    dosamigos\chartjs\ChartJs::widget([
                        'type' => 'bar',
                        'data' => [
                            'labels' => \yii\helpers\ArrayHelper::getColumn($GroupPosts, 'title'),
                            'datasets' =>
                                [
                                    [
                                        'label' => \Yii::t('rabint', 'تعداد مطالب ارسالی'),
                                        'backgroundColor' => "rgba(255,99,132,1)",
                                        'borderColor' => "rgba(255,99,132,1)",
                                        'pointBackgroundColor' => "rgba(255,99,132,1)",
                                        'pointBorderColor' => "#fff",
                                        'pointHoverBackgroundColor' => "#fff",
                                        'pointHoverBorderColor' => "rgba(255,99,132,1)",
                                        'data' => \yii\helpers\ArrayHelper::getColumn($GroupPosts, 'total_post'),
                                    ],
                                ]
                        ]
                    ]);
                    ?>
                </div>
            </div><!-- /.card -->
        </div>


        <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-4">
            <div class="card card-success card-solid">
                <div class="card-header with-border">
                    <h3 class="card-title"><?= Yii::t('rabint', 'دانش نامه') ?></h3>
                </div><!-- /.card-header -->
                <div class="card-body no-padding">

                    <?php
                    $dataSet = [];
                    $statusDataSet = [];
                    // subsets
                    $allStatus = \app\modules\post\models\Post::wikiStatuses();
                    foreach (\app\modules\post\models\Post::wikiStatuses() as $key => $status) {
                        $dataSet[$key] = [
                            'label' => $status['title'],
                            'select_label' => $status['title'],
                            //'select_label' => $masterGroup['title'],
                            'data' => [],
                            'yLabel' => Yii::t('app', 'زیر گروه'),
                            'xLabel' => Yii::t('app', 'تعداد'),
                        ];
                        $statusDataSet[$status['title']] = 0;
                    }


                    // mastersets
                    $MasterGroups = Yii::$app->db
                        ->createCommand(
                            "SELECT id,title FROM pst_group_category WHERE group_id = 1 and parent_id is NULL"
                        )
                        ->queryAll();
                    foreach ($MasterGroups as $k => $masterGroup) {
                        $GroupCats = Yii::$app->db
                            ->createCommand(
                                "SELECT id FROM pst_group_category WHERE group_id = 1 and  parent_id = :pid", ['pid' => $masterGroup['id']]
                            )
                            ->queryColumn();
                        $postStats = Yii::$app->db
                            ->createCommand(
                                "
                            SELECT
                              `wiki_status`,
                                count( id ) AS total_post 
                            FROM
                                `pst_post`
                            WHERE
                                (group_category_id = (:catid) or group_category_id in (:scatids))
                                and group_id = 1
                                and {$qStr}
                            GROUP BY
                                pst_post.`wiki_status` ", ['catid' => $masterGroup['id'], 'scatids' => $GroupCats]
                            )
                            ->queryAll();

                        if (empty($postStats)) {
                            continue;
                        }
                        $postStats = \yii\helpers\ArrayHelper::map($postStats, 'wiki_status', 'total_post');

                        foreach ($allStatus as $stk => $statusData) {
                            if (isset($postStats[$stk])) {
                                $dataSet[$stk]['data'][$masterGroup['title']] = $postStats[$stk];
                                $statusDataSet[$statusData['title']] += $postStats[$stk];
                            } else {
                                $dataSet[$stk]['data'][$masterGroup['title']] = 0;
                            }
                            //$dataSet[$subsetKey]['select_label']='';
                        }
                    }
                    ?>

                    <?=
                    rabint\widgets\chart\ChartWidget::widget([
                        'title' => Yii::t('app', 'تعداد مداخل به تفکیک وضعیت'),
                        'theme' => 'default',
                        'dataset' => $dataSet,
                        'xLabel' => '',
                        'yLabel' => Yii::t('app', 'تعداد'),
                        //'defaultFontFamily' => 'vazir_fd',
                    ]);
                    ?>
                </div>
            </div><!-- /.card -->
        </div>


        <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-4">
            <div class="card card-success card-solid">
                <div class="card-header with-border">
                    <h3 class="card-title"><?= Yii::t('rabint', 'دانش‌نامه') ?></h3>
                </div><!-- /.card-header -->
                <div class="card-body no-padding">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">

                            <?php
                            $dataSet = [];
                            // mastersets
                            $MasterGroups = Yii::$app->db
                                ->createCommand(
                                    "SELECT id,title FROM pst_group_category WHERE group_id = 1 and parent_id is NULL"
                                )
                                ->queryAll();
                            foreach ($MasterGroups as $k => $masterGroup) {
                                $GroupCats = Yii::$app->db
                                    ->createCommand(
                                        "SELECT id FROM pst_group_category WHERE group_id = 1 and  parent_id = :pid", ['pid' => $masterGroup['id']]
                                    )
                                    ->queryColumn();
                                $postStats = Yii::$app->db
                                    ->createCommand(
                                        "
                            SELECT
                                count( id ) AS total_post 
                            FROM
                                `pst_post`
                            WHERE
                                (group_category_id = (:catid) or group_category_id in (:scatids))
                                and group_id = 1
                                and {$qStr}
                            ", ['catid' => $masterGroup['id'], 'scatids' => $GroupCats]
                                    )
                                    ->queryScalar();

                                $dataSet[$masterGroup['title']] = $postStats;

                            }
                            ?>


                            <?php
                            echo rabint\widgets\chart\ChartWidget::widget([
                                'title' => Yii::t('app', 'تعداد مداخل به تفکیک گروه'),
                                'theme' => 'default',
                                'type' => rabint\widgets\chart\ChartWidget::TYPE_PIE,
                                'dataset' => [
                                    [
                                        'label' => 'گروه',
                                        'data' => ['a' => 10, 'v' => 20, 's' => 15],
                                        'data' => $dataSet,
                                    ]
                                ],
                            ]);
                            ?>

                        </div>
                        <div class="col-sm-12 col-md-6">

                            <?php
                            echo rabint\widgets\chart\ChartWidget::widget([
                                'title' => Yii::t('app', 'تعداد مداخل به تفکیک وضعیت'),
                                'theme' => 'default',
                                'type' => rabint\widgets\chart\ChartWidget::TYPE_PIE,
                                'dataset' => [
                                    [
                                        'label' => 'وضعیت',
                                        'data' => ['a' => 10, 'v' => 20, 's' => 15],
                                        'data' => $statusDataSet,
                                    ]
                                ],
                            ]);
                            ?>
                        </div>

                    </div>

                </div>
            </div><!-- /.card -->
        </div>


        <div class="col-md-12">
            <div class="card card-default card-solid mb-4">
                <div class="card-header with-border">
                    <h3 class="card-title"><?= \Yii::t('rabint', 'بازدید مطالب هر مدیریت'); ?></h3>

                </div><!-- /.card-header -->
                <div class="card-body no-padding" style="display: block;">
                    <?php
                    $dataSet = [];
                    $data = [];


                    $postStats = Yii::$app->db
                        ->createCommand(
                            "
                        SELECT g.title, pst_post.group_id, SUM(pst_post.visit_count) AS visit
                        FROM `pst_post`
                        JOIN `pst_group` g ON pst_post.group_id = g.id
                        WHERE {$qStr}
                        GROUP BY pst_post.group_id;
 "
                        )
                        ->queryAll();

                    $postStats = \yii\helpers\ArrayHelper::map($postStats, 'title', 'visit');
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
                        'yLabel' => Yii::t('app', 'تعداد بازدید'),
                        //'defaultFontFamily' => 'vazir_fd',
                    ]);

                    ?>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card card-default card-solid mb-4">
                <div class="card-header with-border">
                    <h3 class="card-title"><?= \Yii::t('rabint', 'بازدید به تفکیک زیر گروه'); ?></h3>

                </div><!-- /.card-header -->
                <div class="card-body no-padding" style="display: block;">
                    <?php
                    $dataSet=[];
                    $allGroup = \app\modules\post\models\Group::find()->all();
                    $groupCats = \app\modules\post\models\GroupCategory::find()->all();
                    $groupCats = \yii\helpers\ArrayHelper::map($groupCats, 'id', 'title');
                    foreach ($allGroup as $key => $group) {
                        $GroupCats = Yii::$app->db
                            ->createCommand(
                                "SELECT id FROM pst_group_category WHERE group_id = :gid"
                                , ['gid' => $group->id]
                            )->queryColumn();

                        $postStats = Yii::$app->db
                            ->createCommand(
                                "
                        SELECT pst_post.group_category_id, SUM(pst_post.visit_count) AS visit
                        FROM `pst_post` 
                        WHERE group_id = :gid and {$qStr} 
                        GROUP BY pst_post.group_category_id;
 "
                                , ['gid' => $group->id]
                            )
                            ->queryAll();

                        foreach ($postStats as &$postStat) {
                            $postStat['title'] = $groupCats[$postStat['group_category_id']];
                        }
                        $postStats = \yii\helpers\ArrayHelper::map($postStats, 'title', 'visit');

                        if (empty($postStats)) {
                            continue;
                        }
                        $dataSet[] = [
                            'label' => $group->title,
                            'select_label' => $group->title,
                            'data' => $postStats,
                            'yLabel' => Yii::t('app', 'زیر گروه'),
                            'xLabel' => Yii::t('app', 'بازدید'),
                        ];

                        ?>
                        <?php
                    }

                    ?>

                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                        <?php
                        foreach ($dataSet as $key => $dataset) {
                            $tabName = 't' . $key;
                            ?>
                            <li class="nav-item">
                                <a class="nav-link <?= $key == 0 ? 'active' : ''; ?>" id="<?= $tabName; ?>-tab"
                                   data-toggle="tab" href="#<?= $tabName; ?>" role="tab"
                                   aria-controls="<?= $tabName; ?>"
                                   aria-selected="<?= $key == 0 ? 'true' : 'false'; ?>">
                                    <?= $dataset['label']; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>


                    <div class="tab-content" id="myTabContent2">
                        <?php
                        foreach ($dataSet as $key => $dataset) {
                            $tabName = 't' . $key;
                            ?>
                            <div class="tab-pane fade <?= $key == 0 ? 'show active' : ''; ?>" id="<?= $tabName; ?>"
                                 role="tabpanel" aria-labelledby="<?= $tabName; ?>-tab">
                                <div class="clearfix mb-4"></div>
                                <?php
                                echo  rabint\widgets\chart\ChartWidget::widget([
                                    'title' => $dataset['label'],
                                    'theme' => 'default',
                                    'dataset' => [$dataset],
                                    //'type' => \rabint\widgets\chart\ChartWidget::TYPE_LINE,
                                    'xLabel' => '',
                                    'yLabel' => Yii::t('app', 'تعداد بازدید'),
                                ]);

                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
