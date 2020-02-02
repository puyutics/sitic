<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CheckExact */

$this->title = Yii::t('app', 'Create Check Exact');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Check Exacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="check-exact-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
