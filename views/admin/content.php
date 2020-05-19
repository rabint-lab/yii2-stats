<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model rabint\stats\models\Stats */

$this->title = $model->date;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rabint', 'آمار'), 'url' => ['review']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('rabint', 'تعداد مطال'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="view-box stats-view">
    <div class="clearfix"></div>
    <div class="row">


        <div class="col-sm-4">

            <div class="box box-warning box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Yii::t('rabint', 'چکیده') ?></h3>
                    <div class="box-tools pull-left float-left">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fas fa-times"></i></button>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    <ul class="nav nav-stacked">
                        <li>
                            <a href="#">
                                <?= Yii::t('rabint', 'تعداد مطالب ارسالی') ?>
                                <span class="pull-left float-left badge bg-green"><?=
                                    app\modules\post\models\Post::find()->where([
//                                'user_id' => $model->id
                                    ])->count();
                                    ?></span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <?= Yii::t('rabint', 'تعداد مطالب ارسالی 30 روز اخیر') ?>
                                <span class="pull-left float-left badge bg-green-active">
                                    <?=
                                            app\modules\post\models\Post::find()
                                            ->andWhere(
                                                    [
//                                                    'user_id' => $model->id,
                                                    ]
                                            )->andWhere(['>=', 'created_at', (time() - cheatsheet\Time::SECONDS_IN_A_MONTH)])
                                            ->count("*");
                                    ?>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <?= Yii::t('rabint', 'تعداد مطالب ارسالی 7 روز اخیر') ?>
                                <span class="pull-left float-left badge bg-green-gradient">
                                    <?=
                                            app\modules\post\models\Post::find()
                                            ->andWhere(
                                                    [
//                                                    'user_id' => $model->id,
                                                    ]
                                            )->andWhere(['>=', 'created_at', (time() - cheatsheet\Time::SECONDS_IN_A_WEEK)])
                                            ->count("*");
//                                echo $res->createCommand()->rawSql;
                                    ?>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <?= Yii::t('rabint', 'تعداد مطالب ارسالی 24 ساعت اخیر') ?>
                                <span class="pull-left float-left badge bg-green-gradient">
                                    <?=
                                            app\modules\post\models\Post::find()
                                            ->andWhere(
                                                    [
//                                                    'user_id' => $model->id,
                                                    ]
                                            )->andWhere(['>=', 'created_at', (time() - cheatsheet\Time::SECONDS_IN_A_DAY)])
                                            ->count("*");
//                                echo $res->createCommand()->rawSql;
                                    ?>
                                </span>
                            </a>
                        </li>

                    </ul>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

        <div class="clearfix"></div>


        <div class="col-sm-6">
            <div class="box box-success box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Yii::t('rabint', 'آمار فایل ارسالی') ?></h3>
                    <div class="box-tools pull-left float-left">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fas fa-times"></i></button>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="spacer clearfix"></div>
                    <div class="col-sm-12">
                        <form method="get">
                            <?php
                            $from = (isset($_GET['from'])) ? $_GET['from'] : null;
                            $to = (isset($_GET['to'])) ? $_GET['to'] : null;
                            ?>
                            <div class="form-group pull-right float-right">
                                <label> <?= Yii::t('rabint', 'از تاریخ') ?> </label>
                                <?php echo \rabint\widget::datePickerStatic("from", $from); ?>
                            </div>
                            <div class="pull-right float-right">&nbsp;&nbsp;&nbsp;</div>
                            <div class="form-group pull-right float-right">
                                <label> <?= Yii::t('rabint', 'تا تاریخ') ?> </label>
                                <?php echo \rabint\widget::datePickerStatic("to", $to); ?>
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
                            $stime = \rabint\locality::jalaliToTimestamp($from);
                            $qStr .= " AND  created_at >= " . $stime;
                        }
                        if (!empty($to)) {
                            $etime = \rabint\locality::jalaliToTimestamp($to);
                            $qStr .= " AND  created_at <= " . $etime;
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
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

    </div>
</div>
