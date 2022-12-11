<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\siad_pregrado\EstudiantesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Estudiantes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estudiantes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Estudiantes'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'CIInfPer',
            //'num_expediente',
            'cedula_pasaporte',
            'TipoDocInfPer',
            'ApellInfPer',
            'ApellMatInfPer',
            'NombInfPer',
            //'NacionalidadPer',
            //'EtniaPer',
            //'FechNacimPer',
            //'LugarNacimientoPer',
            //'GeneroPer',
            //'EstadoCivilPer',
            //'CiudadPer',
            //'DirecDomicilioPer',
            //'Telf1InfPer',
            //'CelularInfPer',
            //'TipoInfPer',
            //'statusper',
            'mailPer',
            'mailInst',
            //'GrupoSanguineo',
            //'tipo_discapacidad',
            //'carnet_conadis',
            //'num_carnet_conadis',
            //'porcentaje_discapacidad',
            //'lateralidad',
            //'fotografia',
            //'codigo_dactilar',
            //'hd_posicion',
            //'huella_dactilar',
            //'ultima_actualizacion',
            //'codigo_verificacion',
            //'deshabilita_edicion',
            //'archivo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
