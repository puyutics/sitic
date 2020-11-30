<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AdldapNewUsers */

$this->title = 'Editar Estudiante: ' . $model->dni;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestión TI'), 'url' => ['site/management']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['adldap/index']];
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dni, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="adldap-new-users-update">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode($this->title) ?></h3>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
