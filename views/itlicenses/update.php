<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItLicenses */

$this->title = Yii::t('app', 'Update It Licenses: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inventario TI'), 'url' => ['site/inventory']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'It Licenses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="it-licenses-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
