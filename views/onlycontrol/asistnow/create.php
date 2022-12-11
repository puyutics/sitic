<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Asistnow */

$this->title = 'Create Asistnow';
$this->params['breadcrumbs'][] = ['label' => 'Asistnows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asistnow-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
