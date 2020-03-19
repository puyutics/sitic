<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserInfo */

$this->title = Yii::t('app', 'Update User Info: {name}', [
    'name' => $model->NAME,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->NAME, 'url' => ['view', 'id' => $model->USERID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
