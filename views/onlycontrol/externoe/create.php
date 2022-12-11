<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Externoe */

$this->title = 'Create Externoe';
$this->params['breadcrumbs'][] = ['label' => 'Externoes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="externoe-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
