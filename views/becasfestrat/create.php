<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BecasFestrat */

$this->title = Yii::t('app', 'Create Becas Festrat');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Becas Festrats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="becas-festrat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
