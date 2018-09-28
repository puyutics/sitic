<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItAppsCategory */

$this->title = Yii::t('app', 'Agregar Categoría');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inventario TI'), 'url' => ['site/inventory']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aplicaciones TI'), 'url' => ['itapps/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-apps-category-create">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
