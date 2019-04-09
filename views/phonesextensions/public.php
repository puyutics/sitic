<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PhonesExtensionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="phones-extensions-index">

    <?php Pjax::begin(); ?>

    <?= $this->render('_header') ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'EXTENSION',
                'attribute'=>'extension',
            ],
            [
                'label'=>'DETALLE',
                'attribute'=>'description',
            ],
            [
                'label'=>'USUARIO',
                'attribute' => 'username',
                'value'=>function($model){
                    $user = Yii::$app->ad->getProvider('default')->search()->findBy('sAMAccountname', $model->username);
                    return $user->getAttribute('cn',0);
                },
            ],
        ],
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'hover' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
