<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MatriculaNivelacion */

$this->title = $model->idMatricula;
$this->params['breadcrumbs'][] = ['label' => 'Matricula Nivelacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="matricula-nivelacion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idMatricula], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idMatricula], [
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
            'idMatricula',
            'idMatricula_anual',
            'idPer',
            'CIInfPer',
            'idCarr',
            'idanio',
            'idsemestre',
            'FechaMatricula',
            'idParalelo',
            'idMatricula_ant',
            'tipoMatricula',
            'statusMatricula',
            'anulada',
            'observMatricula',
            'promocion',
            'Usu_registra',
            'Usu_legaliza',
            'Fecha_crea',
            'Usu_modifica',
            'Fecha_ultima_modif',
            'archivo_aprobado',
            'archivo_retirado',
            'archivo_anulado',
            'leg_observacion',
            'num_asig_repite',
            'aprobacion_automatica',
            'mail_enviado',
        ],
    ]) ?>

</div>
