<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\NomPuerta */

$this->title = 'Create Nom Puerta';
$this->params['breadcrumbs'][] = ['label' => 'Nom Puertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nom-puerta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
