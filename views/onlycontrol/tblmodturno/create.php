<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\TblmodTurno */

$this->title = 'Create Tblmod Turno';
$this->params['breadcrumbs'][] = ['label' => 'Tblmod Turnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblmod-turno-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
