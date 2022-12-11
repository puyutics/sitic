<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Califica */

$this->title = 'Create Califica';
$this->params['breadcrumbs'][] = ['label' => 'Calificas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="califica-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
