<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UserDepartment */

$this->title = Yii::t('app', 'Asignar Usuario/Departamento');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuario/Departamento'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-department-create">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
