<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\siad_pregrado\Matricula */

$this->title = Yii::t('app', 'Create Matricula');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Matriculas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matricula-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
