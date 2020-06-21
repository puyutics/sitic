<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BecasFestrat */

$this->title = Yii::t('app', 'Update Becas Festrat: {name}', [
    'name' => $model->idficha_sa,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Becas Festrats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idficha_sa, 'url' => ['view', 'id' => $model->idficha_sa]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="becas-festrat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
