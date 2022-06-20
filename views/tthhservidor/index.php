<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TthhServidorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tthh Servidors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tthh-servidor-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tthh Servidor'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'tipo_documento',
            'id_documento',
            'nombres',
            'apellidos',
            'fecha_nacimiento',
            //'servidorpasante',
            //'num_libretamilitar',
            //'nacionalidad',
            //'sexo',
            //'tipo_sangre',
            //'estado_civil',
            //'discapacidad',
            //'numero_conadis',
            //'tipo_discapacidad',
            //'servidor_carrera',
            //'numero_certificado',
            //'identificacion_etnica',
            //'nacionalidad_indigena',
            //'dir_calleprincipal',
            //'dir_numero',
            //'dir_callesecundaria',
            //'dir_referencia',
            //'tel_domicilio',
            //'tel_celular',
            //'tel_trabajo',
            //'tel_extension',
            //'email:email',
            //'email_temp:email',
            //'provincia',
            //'canton',
            //'parroquia',
            //'contacto_apellidos',
            //'contacto_nombres',
            //'contacto_telefono',
            //'contacto_celular',
            //'notaria_lugar',
            //'notaria_numero',
            //'notaria_fecha',
            //'institucion_bancaria',
            //'cuenta_tipo',
            //'cuenta_numero',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
