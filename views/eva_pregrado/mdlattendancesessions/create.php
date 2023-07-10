<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\eva_pregrado\MdlAttendanceSessions */

$this->title = 'Create Mdl Attendance Sessions';
$this->params['breadcrumbs'][] = ['label' => 'Mdl Attendance Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mdl-attendance-sessions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
