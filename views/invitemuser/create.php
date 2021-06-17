<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InvItemUser */

$this->title = Yii::t('app', 'Asignar Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Asignar Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inv-item-user-create">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?= $this->render('_create', [
        'model' => $model,
    ]) ?>

</div>
