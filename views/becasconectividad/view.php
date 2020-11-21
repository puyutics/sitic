<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BecasConectividad */

$this->title = 'Estudiante: ' . $model->dni;
$this->params['breadcrumbs'][] = ['label' => 'Beneficiario', 'url' => ['beneficiario']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tab-int-formulario-view">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode($this->title) ?></h3>
    </div>
    <br>
    <div class="form-group" align="center">
        <?php
        echo Html::a('Ver libreta', '@web/uploads/becasconectividad/libretas/'. $model->doc_libreta, [
            'class'=>'btn btn-lg btn-primary',
            'target'=>'_blank',
            'data-toggle'=>'tooltip',
            'title'=>'Abrir'
        ]);
        ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'cuenta_dni',
            'cuenta_numero',
            'cuenta_titular',
            'cuenta_tipo',
            'cuenta_institucion',
            'fec_registro',
            'dni',
            'username',
            'email:email',
            'nombres',
            'apellidos',
            'provincia',
            'cel_contacto',
            'tel_contacto',
            'siad_matriculado',
            'siad_semestre',
            'siad_carrera',
            'ficha_escasos_recursos',
            //'status',

        ],
    ]) ?>

</div>
