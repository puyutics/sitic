<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\eva_pregrado\MdlAttendance */

$this->title = 'Create Mdl Attendance';
$this->params['breadcrumbs'][] = ['label' => 'Mdl Attendances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mdl-attendance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
