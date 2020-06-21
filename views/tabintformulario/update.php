<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TabIntFormulario */

$this->title = 'Update Tab Int Formulario: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tab Int Formularios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tab-int-formulario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
