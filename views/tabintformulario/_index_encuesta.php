<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TabIntEncuestasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $user = Yii::$app->ad->getProvider('default')->search()->users()->find($search);
    $dni = $user->getAttribute(Yii::$app->params['dni'],0);

} else {
    $sAMAccountname = Yii::$app->user->identity->username;
    $user = Yii::$app->ad->getProvider('default')->search()
        ->findBy('sAMAccountname', $sAMAccountname);
    $dni = $user->getAttribute(Yii::$app->params['dni'],0);
}

$searchModelTabIntEncuestas = new \app\models\TabIntEncuestasSearch();
$searchModelTabIntEncuestas->CedulaPasaporte = $dni;
$dataProviderTabIntEncuestas = $searchModelTabIntEncuestas->search(Yii::$app->request->queryParams);
$dataProviderTabIntEncuestas->sort->defaultOrder = [
    'ID' => SORT_ASC,
];

?>
<div class="tab-int-encuestas-index">

    <?= GridView::widget([
        'dataProvider' => $dataProviderTabIntEncuestas,
        //'filterModel' => $searchModelTabIntEncuestas,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ID',
            //'ObjectID',
            //'GlobalID',
            //'CreationDate',
            //'Creator',
            //'EditDate',
            //'Editor',
            [
                'attribute'=>'CedulaPasaporte',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntEncuestas::find()->orderBy('CedulaPasaporte ASC')->all(), 'CedulaPasaporte', 'CedulaPasaporte'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],
            [
                'attribute'=>'Nombres',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntEncuestas::find()->orderBy('Nombres ASC')->all(), 'Nombres', 'Nombres'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],
            [
                'attribute'=>'Apellidos',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntEncuestas::find()->orderBy('Apellidos ASC')->all(), 'Apellidos', 'Apellidos'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],
            //'Email:email',
            //'Campus',
            [
                'attribute'=>'Carrera',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntEncuestas::find()->orderBy('Carrera ASC')->all(), 'Carrera', 'Carrera'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],
            //'Telefono',
            //'Operadora',
            [
                'attribute'=>'Computador',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntEncuestas::find()->orderBy('Computador ASC')->all(), 'Computador', 'Computador'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],
            //'TipoComputador',
            [
                'attribute'=>'Internet',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntEncuestas::find()->orderBy('Internet ASC')->all(), 'Internet', 'Internet'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],
            //'TipoInternet',
            //'PropiedadComputador',
            //'x',
            //'y',
            [
                'attribute'=>'Beneficio',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntEncuestas::find()->orderBy('Beneficio ASC')->all(), 'Beneficio', 'Beneficio'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
        'containerOptions' => ['style'=>'overflow: auto'],
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
</div>
