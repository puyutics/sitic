<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItProjectsUser */

$this->title = Yii::t('app', 'Asignar Usuario');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Asignar Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-projects-user-create">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
