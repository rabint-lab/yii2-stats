<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model rabint\stats\models\Dailies */

$this->title = Yii::t('rabint', 'Update {modelClass}: ', [
    'modelClass' => 'Dailies',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rabint', 'Dailies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('rabint', 'Update');
?>
<div class="dailies-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
