<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TabIntSenescyt */

$this->title = Yii::t('app', 'Create Tab Int Senescyt');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tab Int Senescyts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tab-int-senescyt-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
