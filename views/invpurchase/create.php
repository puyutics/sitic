<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InvPurchase */

$this->title = Yii::t('app', 'Agregar Compra');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Compras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inv-purchase-create">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
