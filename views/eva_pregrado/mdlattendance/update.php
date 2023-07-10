<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\eva_pregrado\MdlAttendance */

$this->title = 'Update Mdl Attendance: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mdl Attendances', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mdl-attendance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
