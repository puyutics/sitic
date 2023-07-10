<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\eva_pregrado\MdlAttendanceLog */

$this->title = 'Create Mdl Attendance Log';
$this->params['breadcrumbs'][] = ['label' => 'Mdl Attendance Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mdl-attendance-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
