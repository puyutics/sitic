<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\AuxNomina */

$this->title = 'Create Aux Nomina';
$this->params['breadcrumbs'][] = ['label' => 'Aux Nominas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aux-nomina-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
