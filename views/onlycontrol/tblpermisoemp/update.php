<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\TblPermisoemp */

$this->title = 'Update Tbl Permisoemp: ' . $model->NOMINA_ID;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Permisoemps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->NOMINA_ID, 'url' => ['view', 'id' => $model->NOMINA_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-permisoemp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
