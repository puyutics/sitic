<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\siad_pregrado\Estudiantes */

$this->title = $model->CIInfPer;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Estudiantes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="estudiantes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->CIInfPer], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->CIInfPer], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'CIInfPer',
            'num_expediente',
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
            'CelularInfPer',
            'TipoInfPer',
            'statusper',
            'mailPer',
            'mailInst',
            'GrupoSanguineo',
            'tipo_discapacidad',
            'carnet_conadis',
            'num_carnet_conadis',
            'porcentaje_discapacidad',
            'lateralidad',
            'fotografia',
            'codigo_dactilar',
            'hd_posicion',
            'huella_dactilar',
            'ultima_actualizacion',
            'codigo_verificacion',
            'deshabilita_edicion',
            'archivo',
        ],
    ]) ?>

</div>
