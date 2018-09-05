<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItProcessesUser */

$this->title = Yii::t('app', 'Agregar relación');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Relaciones Procesos/Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-processes-user-create">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
