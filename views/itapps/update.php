<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItApps */

$this->title = Yii::t('app', 'Editar Aplicación: ' . $model->title, [
    'nameAttribute' => '' . $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inventario TI'), 'url' => ['site/inventory']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aplicaciones TI'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');
?>
<div class="it-apps-update">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
