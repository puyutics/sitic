<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TthhServidor */

$this->title = Yii::t('app', 'Create Tthh Servidor');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tthh Servidors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tthh-servidor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
