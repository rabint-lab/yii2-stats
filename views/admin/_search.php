<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model rabint\stats\models\StatsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stats-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'visit') ?>

    <?= $form->field($model, 'visitor') ?>

    <?= $form->field($model, 'most_hour') ?>

    <?php // echo $form->field($model, 'visit_in_hour') ?>

    <?php // echo $form->field($model, 'request_type') ?>

    <?php // echo $form->field($model, 'download') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'like') ?>

    <?php // echo $form->field($model, 'rate') ?>

    <?php // echo $form->field($model, 'most_visited_action') ?>

    <?php // echo $form->field($model, 'most_visitor_user') ?>

    <?php // echo $form->field($model, 'agents') ?>

    <?php // echo $form->field($model, 'utms') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('rabint', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('rabint', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
