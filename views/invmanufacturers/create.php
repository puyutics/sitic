<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InvManufacturers */

$this->title = Yii::t('app', 'Agregar Fabricante');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fabricantes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inv-manufacturers-create">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
