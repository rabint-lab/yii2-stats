<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model rabint\stats\models\Stats */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stats-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'visit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'visitor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'most_hour')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'visit_in_hour')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'request_type')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'download')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'like')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'most_visited_action')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'most_visitor_user')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'agents')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'utms')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('rabint', 'Create') : Yii::t('rabint', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
