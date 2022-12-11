<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\NewCredencial */

$this->title = 'Create New Credencial';
$this->params['breadcrumbs'][] = ['label' => 'New Credencials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="new-credencial-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
