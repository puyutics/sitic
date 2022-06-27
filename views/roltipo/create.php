<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RolTipo */

$this->title = 'Crear nuevo Tipo de Rol de Pagos';
$this->params['breadcrumbs'][] = ['label' => 'Tipos de Roles de Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rol-tipo-create">

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    <?php } ?>

    <?= $this->render('_create', [
        'model' => $model,
    ]) ?>

</div>
