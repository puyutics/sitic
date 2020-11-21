<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AdldapNewUsers */

$this->title = 'Create Adldap New Users';
$this->params['breadcrumbs'][] = ['label' => 'Adldap New Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adldap-new-users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
