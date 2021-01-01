<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MatriculaNivelacion */

$this->title = 'Create Matricula Nivelacion';
$this->params['breadcrumbs'][] = ['label' => 'Matricula Nivelacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matricula-nivelacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
