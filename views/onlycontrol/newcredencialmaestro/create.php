<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\NewCredencialMaestro */

$this->title = 'Create New Credencial Maestro';
$this->params['breadcrumbs'][] = ['label' => 'New Credencial Maestros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="new-credencial-maestro-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
