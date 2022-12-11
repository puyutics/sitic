<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\siad_pregrado\DocenteAsignatura */

$this->title = $model->dpa_id;
$this->params['breadcrumbs'][] = ['label' => 'Docente Asignaturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="docente-asignatura-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->dpa_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->dpa_id], [
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
            'dpa_id',
            'CIInfPer',
            'idPer',
            'idAsig',
            'idCarr',
            'idAnio',
            'idSemestre',
            'bloque',
            'idParalelo',
            'status',
            'idMc',
            'tipo_orgmalla',
            'id_actdist',
            'id_contdoc',
            'transf_asistencia',
            'transf_frecuente',
            'transf_parcial',
            'transf_final',
            'transf_supletorio',
            'transf_cursointensivo',
            'transf_recuperacion',
            'arrastre',
            'extra',
            'compensar_horas',
            'compensar_tipo',
            'regimen_academico',
            'tutor',
            'cupo',
        ],
    ]) ?>

</div>
