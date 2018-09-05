<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItServicesAffectations */

$this->title = Yii::t('app', 'Create It Services Affectations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'It Services Affectations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-services-affectations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
