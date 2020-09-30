<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SysEmail */

$this->title = 'Editar Email: ' . $model->subject;
$this->params['breadcrumbs'][] = ['label' => 'Servicio de Email', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->subject, 'url' => ['view', 'id' => base64_encode($model->id)]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="sys-email-update">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode($this->title) ?></h3>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
