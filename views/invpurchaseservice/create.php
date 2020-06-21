<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InvPurchaseService */

$this->title = Yii::t('app', 'Create Inv Purchase Service');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inv Purchase Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inv-purchase-service-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
