<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ItReportsPowerbi */

$this->title = $model->description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reportes (Power BI)'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-reports-powerbi-view">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'description:ntext',
            'url:url',
            'html_iframe',
            [
                'attribute' => 'username',
                'value'=>call_user_func(function($model){
                    $user = Yii::$app->ad->getProvider('default')->search()->findBy('sAMAccountname', $model->username);
                    return $user->getAttribute('cn',0);
                },$model),
            ],
            [
                'attribute' => 'status',
                'value'=>call_user_func(function($model){
                    if ($model->status == '0') {
                        return "INACTIVO";
                    };
                    if ($model->status == '1') {
                        return "ACTIVO";
                    };
                },$model),
            ],        ],
        'bordered' => true,
        'condensed'=>true,
        'enableEditMode'=>false,
        'mode'=>DetailView::MODE_VIEW,
        'panel'=>[
            //'heading'=>$model->code,
            'type'=>DetailView::TYPE_PRIMARY,
        ],
    ]) ?>

    <p>
        <?= Html::a(Yii::t('app', 'Editar'), ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

</div>
