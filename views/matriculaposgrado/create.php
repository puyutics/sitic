<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MatriculaPosgrado */

$this->title = 'Create Matricula Posgrado';
$this->params['breadcrumbs'][] = ['label' => 'Matricula Posgrados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matricula-posgrado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
