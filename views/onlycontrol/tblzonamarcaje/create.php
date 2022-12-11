<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\TblZonamarcaje */

$this->title = 'Create Tbl Zonamarcaje';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Zonamarcajes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-zonamarcaje-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
