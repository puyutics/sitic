<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItServicesResult */

$this->title = Yii::t('app', 'Agregar Resultados Servicios');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Resultados (servicios)'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-services-result-create">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
