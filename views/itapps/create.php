<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItApps */

$this->title = Yii::t('app', 'Nueva Aplicación');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aplicaciones TI'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-apps-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
