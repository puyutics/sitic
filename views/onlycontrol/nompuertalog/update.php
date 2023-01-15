<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\NomPuertalog */

$this->title = 'Update Nom Puertalog: ' . $model->TURN_NOW;
$this->params['breadcrumbs'][] = ['label' => 'Nom Puertalogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TURN_NOW, 'url' => ['view', 'id' => $model->TURN_NOW]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nom-puertalog-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
