<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\parkingcontrol\NomPuertaDel */

$this->title = 'Update Nom Puerta Del: ' . $model->NOM_ID;
$this->params['breadcrumbs'][] = ['label' => 'Nom Puerta Dels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->NOM_ID, 'url' => ['view', 'NOM_ID' => $model->NOM_ID, 'PUER_ID' => $model->PUER_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nom-puerta-del-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
