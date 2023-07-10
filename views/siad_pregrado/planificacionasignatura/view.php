<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\siad_pregrado\PlanificacionAsignatura */

$this->title = $model->id_plasig;
$this->params['breadcrumbs'][] = ['label' => 'Planificacion Asignaturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="planificacion-asignatura-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_plasig], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_plasig], [
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
            'id_plasig',
            'dpa_id',
            'num_unidad',
            'desc_unidad',
            'tema_clase',
            'contenido',
            'metodologia',
            'num_encuentro',
            'fecha',
            'hora_ini_planif',
            'hora_fin_planif',
            'fecha_reg',
            'objetivo_plasig:ntext',
            'fecha_rcd',
            'hora_inicio',
            'hora_fin',
            'fecha_cierre',
            'hora_cierre',
            'hc_periodo',
            'num_periodos',
            'ip_pcacceso',
            'nomb_pcacceso',
            'observacion:ntext',
            'atraso',
            'status',
            'ps_id',
            'fecha_recp',
            'hora_ini_recp',
            'hora_fin_recp',
            'autorizacion_recp',
            'estado_asist',
            'acceso',
            'id_amb',
            'habilita_asist',
            'usu_habilita_asist',
            'usu_habilita_pldoc',
            'id_actdist',
            'habilita_frec',
            'usu_habilita_frec',
            'ce_id',
            'bloqueado_x_parcial',
            'usu_dicta',
            'extra',
            'excluida_x_disposicion',
            'archivo_justificativo',
        ],
    ]) ?>

</div>
