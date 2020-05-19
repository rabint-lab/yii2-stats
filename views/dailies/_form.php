<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model rabint\stats\models\Dailies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dailies-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'request')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'agent')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'request_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'utm')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('rabint', 'Create') : Yii::t('rabint', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
