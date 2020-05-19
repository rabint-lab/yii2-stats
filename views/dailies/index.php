<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel rabint\stats\models\DailiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rabint', 'Dailies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dailies-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('rabint', 'Create Dailies'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'time',
            'user_id',
            'request',
            'agent:ntext',
            // 'ip',
            // 'request_type',
            // 'utm:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
