<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model rabint\stats\models\Stats */

$this->title = Yii::t('rabint', 'Create Stats');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rabint', 'Stats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stats-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
