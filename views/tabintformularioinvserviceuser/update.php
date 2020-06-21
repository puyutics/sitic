<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TabIntFormularioInvServiceUser */

$this->title = Yii::t('app', 'Update Tab Int Formulario Inv Service User: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tab Int Formulario Inv Service Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tab-int-formulario-inv-service-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
