<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\siad_pregrado\Docentes */

$this->title = $model->CIInfPer;
$this->params['breadcrumbs'][] = ['label' => 'Docentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="docentes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->CIInfPer], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->CIInfPer], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'CIInfPer',
            'cedula_pasaporte',
            'TipoDocInfPer',
            'ApellInfPer',
            'ApellMatInfPer',
            'NombInfPer',
            'NacionalidadPer',
            'EtniaPer',
            'FechNacimPer',
            'LugarNacimientoPer',
            'GeneroPer',
            'EstadoCivilPer',
            'CiudadPer',
            'DirecDomicilioPer',
            'Telf1InfPer',
            'Telf2InfPer',
            'CelularInfPer',
            'TipoInfPer',
            'StatusPer',
            'mailPer',
            'mailInst',
            'GrupoSanguineo',
            'tipo_discapacidad',
            'carnet_conadis',
            'num_carnet_conadis',
            'porcentaje_discapacidad',
            'fotografia',
            'codigo_dactilar',
            'hd_posicion',
            'huella_dactilar',
            'ultima_actualizacion',
            'LoginUsu',
            'ClaveUsu',
            'StatusUsu',
            'idcarr',
            'usa_biometrico',
            'firma_1',
            'firma_2',
            'fecha_reg',
            'fecha_ultimo_acceso',
            'usu_registra',
            'usu_modifica',
            'fecha_ultima_modif',
            'invitado',
        ],
    ]) ?>

</div>
