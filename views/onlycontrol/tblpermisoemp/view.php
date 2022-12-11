<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\TblPermisoemp */

$this->title = $model->NOMINA_ID;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Permisoemps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tbl-permisoemp-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->NOMINA_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->NOMINA_ID], [
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
            'NOMINA_ID',
            'P_CAPTURAH',
            'P_CAPTURAF',
            'P_PERMISOS',
            'P_NOTIFICACION',
            'P_DOCUMENTOS',
            'P_CREDENCIAL',
            'P_MUEVEUSER',
            'P_EXPORTA',
            'P_CAMBIOMASIVO',
            'P_LISTOCONTROL',
            'P_IMPORTAVIRDI',
            'P_RESTRICCION',
            'P_REPORTE',
            'P_CAPTURAR',
        ],
    ]) ?>

</div>
