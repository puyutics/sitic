<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItServicesAvailability */

$this->title = Yii::t('app', 'Create It Services Availability');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'It Services Availabilities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-services-availability-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
