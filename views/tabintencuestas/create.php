<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TabIntEncuestas */

$this->title = Yii::t('app', 'Create Tab Int Encuestas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tab Int Encuestas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tab-int-encuestas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
