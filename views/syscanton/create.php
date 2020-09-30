<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SysCanton */

$this->title = 'Create Sys Canton';
$this->params['breadcrumbs'][] = ['label' => 'Sys Cantons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-canton-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
