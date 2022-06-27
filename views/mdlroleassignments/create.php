<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MdlRoleAssignments */

$this->title = 'Create Mdl Role Assignments';
$this->params['breadcrumbs'][] = ['label' => 'Mdl Role Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mdl-role-assignments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
