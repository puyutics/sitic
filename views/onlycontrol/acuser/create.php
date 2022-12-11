<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\AcUser */

$this->title = 'Create Ac User';
$this->params['breadcrumbs'][] = ['label' => 'Ac Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ac-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
