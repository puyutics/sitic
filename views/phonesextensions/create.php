<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PhonesExtensions */

$this->title = Yii::t('app', 'Agregar Extensión');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inventario TI'), 'url' => ['site/inventory']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Extensiones Telefónicas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phones-extensions-create">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
