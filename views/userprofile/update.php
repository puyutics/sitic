<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */

$this->title = Yii::t('app', 'Actualizar Perfil de Usuario: ' . $model->username, [
    'nameAttribute' => '' . $model->username,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Perfiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->username]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
?>
<div class="user-profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
