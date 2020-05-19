<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model rabint\stats\models\Dailies */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rabint', 'Dailies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dailies-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('rabint', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('rabint', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('rabint', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'time',
            'user_id',
            'request',
            'agent:ntext',
            'ip',
            'request_type',
            'utm:ntext',
        ],
    ]) ?>

</div>
