<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel rabint\stats\models\StatsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rabint', 'Stats');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stats-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('rabint', 'Create Stats'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date',
            'visit',
            'visitor',
            'most_hour:ntext',
            // 'visit_in_hour:ntext',
            // 'request_type:ntext',
            // 'download',
            // 'comment',
            // 'like',
            // 'rate',
            // 'most_visited_action:ntext',
            // 'most_visitor_user:ntext',
            // 'agents:ntext',
            // 'utms:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
