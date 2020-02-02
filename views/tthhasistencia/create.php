<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TthhAsistencia */

$this->title = Yii::t('app', 'Create Tthh Asistencia');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tthh Asistencias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tthh-asistencia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
