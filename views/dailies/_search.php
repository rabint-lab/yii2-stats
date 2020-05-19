<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model rabint\stats\models\DailiesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dailies-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'time') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'request') ?>

    <?= $form->field($model, 'agent') ?>

    <?php // echo $form->field($model, 'ip') ?>

    <?php // echo $form->field($model, 'request_type') ?>

    <?php // echo $form->field($model, 'utm') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('rabint', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('rabint', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
