<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Dpto */

$this->title = 'Update Dpto: ' . $model->DEP_ID;
$this->params['breadcrumbs'][] = ['label' => 'Dptos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->DEP_ID, 'url' => ['view', 'DEP_ID' => $model->DEP_ID, 'DEP_NOM' => $model->DEP_NOM]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dpto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
