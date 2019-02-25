<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItAppsCategory */

$this->title = Yii::t('app', 'Editar Categoria: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inventario TI'), 'url' => ['site/inventory']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aplicaciones TI'), 'url' => ['itapps/index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');
?>
<div class="it-apps-category-update">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
