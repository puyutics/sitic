<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItProjectsParents */

$this->title = Yii::t('app', 'Agregar Proyecto Relacionado');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Proyectos Relacionados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-projects-parents-create">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
