<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\siad_pregrado\NotasAlumno */

$this->title = $model->idnaa;
$this->params['breadcrumbs'][] = ['label' => 'Notas Alumnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="notas-alumno-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idnaa], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idnaa], [
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
            'idnaa',
            'CIInfPer',
            'idAsig',
            'idPer',
            'CAC1',
            'CAC2',
            'CAC3',
            'TCAC',
            'CEF',
            'CSP',
            'CCR',
            'CSP2',
            'CalifFinal',
            'asistencia',
            'StatusCalif',
            'idMatricula',
            'VRepite',
            'observacion',
            'op1',
            'op2',
            'op3',
            'pierde_x_asistencia',
            'pierde_x_ppf',
            'repite',
            'retirado',
            'excluidaxrepitencia',
            'excluidaxreingreso',
            'excluidaxresolucion',
            'excluidaxcambiomalla',
            'convalidacion',
            'convalida_ppf',
            'aprobada',
            'anulada',
            'arrastre',
            'registro_asistencia',
            'usu_registro_asistencia',
            'registro',
            'ultima_modificacion',
            'usu_pregistro',
            'usu_umodif_registro',
            'archivo',
            'archivo_conv_ppf',
            'idMc',
            'institucion_proviene',
            'observacion_conv',
            'porcentaje_convalidacion',
            'usuario_conv',
            'observacion_conv_ppf',
            'usuario_conv_ppf',
            'exam_final_atrasado',
            'exam_supl_atrasado',
            'exam_supl_sancion',
            'observacion_efa',
            'observacion_espa',
            'observacion_sps',
            'observacion_op3',
            'usu_habilita_efa',
            'usu_habilita_espa',
            'usu_habilita_sps',
            'usu_habilita_op3',
            'dpa_id',
        ],
    ]) ?>

</div>
