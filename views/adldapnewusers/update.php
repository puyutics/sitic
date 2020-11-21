<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AdldapNewUsers */

$this->title = 'Update Adldap New Users: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Adldap New Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="adldap-new-users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
