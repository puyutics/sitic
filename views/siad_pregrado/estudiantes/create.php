<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\siad_pregrado\Estudiantes */

$this->title = Yii::t('app', 'Create Estudiantes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Estudiantes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estudiantes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
