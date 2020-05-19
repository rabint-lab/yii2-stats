<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model rabint\stats\models\Stats */

$this->title = $model->date;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rabint', 'آمار'), 'url' => ['review']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('rabint', 'به تفکیک روز'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="view-box stats-view">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-info">
                <div class="box-header">
                    <div class="action-box">
                        <h2 class="master-title">
                            <?= Html::encode($this->title) ?>
                        </h2>
                    </div>
                </div>
                <div class="box-body">

                    <?=
                    DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'date',
                            'visit',
                            'visitor',
                            'member_visit',
                            'member_visitor',
                            'most_hour:ntext',
                            'visit_in_hour:ntext',
                            'interface:ntext',
                            'maturities:ntext',
                            'genders:ntext',
                            'post',
                            'user',
                            'download',
                            'comment',
                            'like',
                            'rate',
                            'countries:ntext',
                            'most_error_action:ntext',
                            'most_visited_action:ntext',
                            'most_visitor_user:ntext',
                            'agents:ntext',
                            'referer:ntext',
                            'error',
                            'restricted',
                            'restricted_ip:ntext',
                            'utms:ntext',
                        ],
                    ])
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
