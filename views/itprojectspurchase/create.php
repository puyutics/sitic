<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItProjectsPurchase */

$this->title = Yii::t('app', 'Agregar relación Proyecto/Compra');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Relaciones Proyectos/Compras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-projects-purchase-create">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
