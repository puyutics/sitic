<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\siad_pregrado\DocentesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Docentes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docentes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Docentes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'CIInfPer',
            'cedula_pasaporte',
            'TipoDocInfPer',
            'ApellInfPer',
            'ApellMatInfPer',
            //'NombInfPer',
            //'NacionalidadPer',
            //'EtniaPer',
            //'FechNacimPer',
            //'LugarNacimientoPer',
            //'GeneroPer',
            //'EstadoCivilPer',
            //'CiudadPer',
            //'DirecDomicilioPer',
            //'Telf1InfPer',
            //'Telf2InfPer',
            //'CelularInfPer',
            //'TipoInfPer',
            //'StatusPer',
            //'mailPer',
            //'mailInst',
            //'GrupoSanguineo',
            //'tipo_discapacidad',
            //'carnet_conadis',
            //'num_carnet_conadis',
            //'porcentaje_discapacidad',
            //'fotografia',
            //'codigo_dactilar',
            //'hd_posicion',
            //'huella_dactilar',
            //'ultima_actualizacion',
            //'LoginUsu',
            //'ClaveUsu',
            //'StatusUsu',
            //'idcarr',
            //'usa_biometrico',
            //'firma_1',
            //'firma_2',
            //'fecha_reg',
            //'fecha_ultimo_acceso',
            //'usu_registra',
            //'usu_modifica',
            //'fecha_ultima_modif',
            //'invitado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
