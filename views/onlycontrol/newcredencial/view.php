<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\NewCredencial */

$this->title = $model->CR_FIMPRESION;
$this->params['breadcrumbs'][] = ['label' => 'New Credencials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="new-credencial-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'CR_FIMPRESION' => $model->CR_FIMPRESION, 'CR_ID' => $model->CR_ID, 'CR_RESULTADO' => $model->CR_RESULTADO], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'CR_FIMPRESION' => $model->CR_FIMPRESION, 'CR_ID' => $model->CR_ID, 'CR_RESULTADO' => $model->CR_RESULTADO], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'CR_ID',
            'CR_FIMPRESION',
            'CR_RESULTADO',
            'CR_CEDULA',
            'CR_CIUDADANO',
            'CR_FCADUDA',
            'CR_UIMPRIME',
            'CR_AAUTORIZA',
            'CR_FAUTORIZA',
            'CR_TARJETA',
        ],
    ]) ?>

</div>
