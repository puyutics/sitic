<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\biometrico\CheckInOut */

$this->title = Yii::t('app', 'Create Check In Out');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Check In Outs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="check-in-out-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
