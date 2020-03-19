<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TthhAsistencia */

$this->title = Yii::t('app', 'Update Tthh Asistencia: {name}', [
    'name' => $model->id_asistencia,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tthh Asistencias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_asistencia, 'url' => ['view', 'id' => $model->id_asistencia]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tthh-asistencia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
