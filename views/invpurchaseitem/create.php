<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InvPurchaseItem */

$this->title = Yii::t('app', 'Agregar Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inv-purchase-item-create">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
