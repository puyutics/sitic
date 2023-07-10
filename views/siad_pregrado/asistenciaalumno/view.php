<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\siad_pregrado\AsistenciaAlumno */

$this->title = $model->id_asist;
$this->params['breadcrumbs'][] = ['label' => 'Asistencia Alumnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="asistencia-alumno-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_asist], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_asist], [
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
            'id_asist',
            'ciinfper',
            'fecha_asal',
            'hora_asal',
            'idPer',
            'idnaa',
            'observacion_asal',
            'numsesion_asal',
            'presente',
            'ausente',
            'atraso',
            'justificada',
            'fecha_creacion',
            'fecha_modif',
            'observacion:ntext',
            'id_plasig',
            'fecha_just_asal',
            'usu_reg_just_asal',
        ],
    ]) ?>

</div>
