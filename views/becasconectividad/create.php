<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BecasConectividad */

$this->title = 'Create Becas Conectividad';
$this->params['breadcrumbs'][] = ['label' => 'Becas Conectividads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="becas-conectividad-create">

    <?= $this->render('_create', [
        'model' => $model,
    ]) ?>

</div>
