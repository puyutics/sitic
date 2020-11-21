<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SysEmail */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => 'Servicio de Email', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sys-email-view">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode($this->title) ?></h3>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'from:ntext',
            'replyto:ntext',
            //'to:ntext',
            //'cc:ntext',
            //'cco:ntext',
            'subject',
            'body:html',
            'attach:ntext',
            'datetime',
            [
                'attribute' => 'status',
                'value'=>call_user_func(function($model){
                    if ($model->status == '0') {
                        return "NO APROBADO";
                    };
                    if ($model->status == '1') {
                        return "CREADO";
                    };
                    if ($model->status == '2') {
                        return "ENVIADO";
                    };
                },$model),
            ],
        ],
    ]) ?>

    <p align="center">
        <?= Html::a('Editar', ['update', 'id' => base64_encode($model->id)], ['class' => 'btn btn-lg btn-primary']) ?>
        <?= Html::a('Enviar', ['send', 'id' => base64_encode($model->id), 'type' => base64_encode('o365list')], ['class' => 'btn btn-lg btn-danger']) ?>
    </p>

</div>
