<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\NomPuertaDel */

$this->title = 'Create Nom Puerta Del';
$this->params['breadcrumbs'][] = ['label' => 'Nom Puerta Dels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nom-puerta-del-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
