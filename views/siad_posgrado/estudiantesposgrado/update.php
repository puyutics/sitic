<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\siad_posgrado\EstudiantesPosgrado */

$this->title = Yii::t('app', 'Estudiante Posgrado: {name}', [
    'name' => $model->ApellInfPer . ' ' . $model->ApellMatInfPer . ' ' . $model->NombInfPer,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestión TI'), 'url' => ['site/management']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['adldap/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Búsqueda'), 'url' => 'index.php?r=adldap/edituser&search='.$model->cedula_pasaporte];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');
?>
<div class="estudiantes-posgrado-update">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode($this->title) ?></h3>
    </div>

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>
