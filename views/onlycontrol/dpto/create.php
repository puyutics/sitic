<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Dpto */

$this->title = 'Create Dpto';
$this->params['breadcrumbs'][] = ['label' => 'Dptos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dpto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
