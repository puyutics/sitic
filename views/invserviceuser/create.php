<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InvServiceUser */

$this->title = Yii::t('app', 'Create Inv Service User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inv Service Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inv-service-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
