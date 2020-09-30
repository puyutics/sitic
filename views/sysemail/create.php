<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SysEmail */

$this->title = 'Crear Email';
$this->params['breadcrumbs'][] = ['label' => 'Servicio de Email', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-email-create">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode($this->title) ?></h3>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
