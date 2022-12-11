<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\siad_posgrado\EstudiantesPosgrado */

$this->title = 'Create Estudiantes Posgrado';
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes Posgrados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estudiantes-posgrado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
