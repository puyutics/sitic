<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItProcessesPurchase */

$this->title = Yii::t('app', 'Agregar Relación');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Relaciones Procesos / Compras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-processes-purchase-create">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
