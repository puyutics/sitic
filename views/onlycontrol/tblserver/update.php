<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Tblserver */

$this->title = 'Update Tblserver: ' . $model->PR_ID;
$this->params['breadcrumbs'][] = ['label' => 'Tblservers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PR_ID, 'url' => ['view', 'id' => $model->PR_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tblserver-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
