<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItServices */

$this->title = Yii::t('app', 'Agregar Servicio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Servicios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-services-create">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
