<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TthhServidor */

$this->title = $model->id_documento;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tthh Servidors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tthh-servidor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id_documento], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id_documento], [
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
            'tipo_documento',
            'id_documento',
            'nombres',
            'apellidos',
            'fecha_nacimiento',
            'servidorpasante',
            'num_libretamilitar',
            'nacionalidad',
            'sexo',
            'tipo_sangre',
            'estado_civil',
            'discapacidad',
            'numero_conadis',
            'tipo_discapacidad',
            'servidor_carrera',
            'numero_certificado',
            'identificacion_etnica',
            'nacionalidad_indigena',
            'dir_calleprincipal',
            'dir_numero',
            'dir_callesecundaria',
            'dir_referencia',
            'tel_domicilio',
            'tel_celular',
            'tel_trabajo',
            'tel_extension',
            'email:email',
            'email_temp:email',
            'provincia',
            'canton',
            'parroquia',
            'contacto_apellidos',
            'contacto_nombres',
            'contacto_telefono',
            'contacto_celular',
            'notaria_lugar',
            'notaria_numero',
            'notaria_fecha',
            'institucion_bancaria',
            'cuenta_tipo',
            'cuenta_numero',
            'status',
        ],
    ]) ?>

</div>
