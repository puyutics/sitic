<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\AcUser */

$this->title = 'Update Ac User: ' . $model->AC_USER;
$this->params['breadcrumbs'][] = ['label' => 'Ac Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->AC_USER, 'url' => ['view', 'id' => $model->AC_USER]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ac-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
