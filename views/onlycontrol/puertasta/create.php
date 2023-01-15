<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\PuertaSta */

$this->title = 'Create Puerta Sta';
$this->params['breadcrumbs'][] = ['label' => 'Puerta Stas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="puerta-sta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
