<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\eva_pregrado\MdlRoleAssignments */

$this->title = 'Update Mdl Role Assignments: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mdl Role Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mdl-role-assignments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>