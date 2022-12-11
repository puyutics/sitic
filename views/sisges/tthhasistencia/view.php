<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\sisges\TthhAsistencia */

$this->title = $model->id_asistencia;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tthh Asistencias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tthh-asistencia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id_asistencia], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id_asistencia], [
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
            'id_asistencia',
            'idx_servidor',
            'idx_tipoasistencia',
            'idx_motivo',
            'idx_tipodocumento',
            'numero_documento',
            'fecha_inicio',
            'fecha_fin',
            'dias',
            'horas',
            'minutos',
            'descripcion:ntext',
            'status_envio',
            'fecha_envio',
            'status_revision',
            'fecha_revision',
            'status_aprobacion',
            'fecha_aprobacion',
            'ip_registrado',
            'idx_usuario',
            'hora_inicial',
            'hora_final',
            'vacaciones_st',
        ],
    ]) ?>

</div>
