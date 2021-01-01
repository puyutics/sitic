<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EstudiantesNivelacion */

$this->title = 'Create Estudiantes Nivelacion';
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes Nivelacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estudiantes-nivelacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
