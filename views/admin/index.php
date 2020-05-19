<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use rabint\stats\models\Dailies;
use globals\direct\User;
use globals\direct\UserProfile;

/* @var $this yii\web\View */
/* @var $searchModel rabint\stats\models\StatsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rabint', 'به تفکیک روز');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rabint', 'آمار'), 'url' => ['review']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grid-box stats-index">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-info">
                <?= Html::beginForm(['bulk'], 'post'); ?>
                <div class="box-body">
                    <p>
                        <?= Html::a(Yii::t('rabint', 'تحلیل آمار امروز'), ['/stats/default/today-analyse'], ['class' => 'btn btn-success']) ?>
                        <?= Html::a(Yii::t('rabint', 'تحلیل روز های انجام نشده'), ['/stats/default/analyse-all'], ['class' => 'btn btn-warning']) ?>
                    </p>

                    <?=
                    GridView::widget([
                        'layout' => "<div class=\"pull-left float-left\">{summary}</div>\n{items}\n{pager}",
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                                ['class' => 'yii\grid\CheckboxColumn'],
                            //['class' => 'yii\grid\SerialColumn'],
//                            [
//                                'attribute' => 'id',
//                                'filterOptions' => ['style' => 'max-width:100px;'],
//                                'format' => 'raw',
//                            ],
                            'id',
                            'date',
                                [
                                'attribute' => 'date',
                                'value' => function ($model) {
                                    return \rabint\locality::jdate('j F Y', $model->date);
                                },
                            ],
                            'visit',
                            'visitor',
//                            'most_hour:ntext',
                            // 'visit_in_hour:ntext',
                            // 'interface:ntext',
                            'post',
                            'user',
                            'download',
                            'comment',
                            'like',
//                             'rate',
                            // 'most_visited_action:ntext',
                            // 'most_visitor_user:ntext',
                            // 'agents:ntext',
                            // 'referer:ntext',
                            // 'error',
                            // 'restricted',
                            // 'restricted_ip:ntext',
                            // 'utms:ntext',
                            ['class' => 'yii\grid\ActionColumn',
                                'template' => '{view}',
                                'buttons' => [
                                    'view' => function ($url, $model) {
                                        $url = \Yii::$app->urlManager->createUrl(['/stats/admin/view', 'date' => $model->date]);
                                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                                    'title' => Yii::t('rabint', 'نمایش ')]);
                                    },
                                ],
                            ],
                        ],
                    ]);
                    ?>

                </div>
                <?= Html::endForm(); ?> 
            </div>
        </div>
    </div>
</div>

