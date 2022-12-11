<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Tblserver */

$this->title = 'Create Tblserver';
$this->params['breadcrumbs'][] = ['label' => 'Tblservers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblserver-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
