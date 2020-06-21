<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TabIntFormularioInvItemUser */

$this->title = Yii::t('app', 'Create Tab Int Formulario Inv Item User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tab Int Formulario Inv Item Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tab-int-formulario-inv-item-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
