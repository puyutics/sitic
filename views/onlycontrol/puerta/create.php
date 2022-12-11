<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Puerta */

$this->title = 'Create Puerta';
$this->params['breadcrumbs'][] = ['label' => 'Puertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="puerta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
