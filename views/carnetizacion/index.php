<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\CarnetizacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestión TI'), 'url' => ['site/management']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['adldap/index']];
$this->title = 'Carnets Digitales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carnetizacion-index">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode($this->title) ?></h3>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('Create Carnetizacion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="alert alert-primary" align="center">
        <?= Html::a('<span class="btn btn-lg btn btn-primary">Reporte Gráfico</span>',
            Url::to(['/carnetizacion/reportegrafico']), [
                'title' => Yii::t('yii', 'Imprimir Reporte'),
                'target'=>'_blank',
                'data-pjax'=>"0",
            ]); ?>
        <?= Html::a('<span class="btn btn-lg btn btn-danger">'.Icon::show("tools").' Fix Carnets (idPer = 42)</span>',
            Url::to(['/carnetizacion/fixcarnets', 'idPer' => 42]), [
                'title' => Yii::t('yii', 'Fix Carnets'),
                'target'=>'_blank',
                'data-pjax'=>"0",
            ]); ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'username',
            //'CIInfPer',
            [
                'attribute' => 'cedula_pasaporte',
                'value' => 'DatosCompletos',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\Carnetizacion::find()
                    ->select('cedula_pasaporte, ApellInfPer, ApellMatInfPer, NombInfPer')
                    ->orderBy('ApellInfPer ASC, ApellMatInfPer ASC, NombInfPer ASC')
                    ->all(),
                    'cedula_pasaporte',
                    'DatosCompletos'
                ),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw',
            ],
            //'cedula_pasaporte',
            //'TipoDocInfPer',
            //'ApellInfPer',
            //'ApellMatInfPer',
            //'NombInfPer',
            //'FechNacimPer',
            [
                'attribute' => 'mailInst',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\Carnetizacion::find()
                    ->select('mailInst')
                    ->all(),
                    'mailInst',
                    'mailInst'
                ),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw',
            ],
            //'fotografia',
            'idMatricula',
            [
                'attribute' => 'idCarr',
                'value'=>function($model){
                    return \app\models\siad_pregrado\Carrera::findOne($model->idCarr)->Fullname;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\siad_pregrado\Carrera::find()
                    ->all(),
                    'idCarr',
                    'datosCompletos'
                ),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw',
            ],
            [
                'attribute' => 'idPer',
                'value'=>function($model){
                    return \app\models\siad_pregrado\Periodo::Periododescriptivo($model->idPer);
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\siad_pregrado\Periodo::find()
                    ->where('idper >= 39')
                    ->orderBy('idper DESC')
                    ->all(),
                    'idper',
                    'PeriodoDetalle'
                ),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw',
            ],
            //'fechfinalperlec',
            //'filefolder',
            //'filename',
            //'filetype',
            /*[
                'label' => 'Foto',
                'value' => function($model) {
                    $finfo = new finfo(FILEINFO_MIME);
                    $mimeType = $finfo->buffer($model->fotografia);
                    $mimeType = explode('; ',$mimeType);
                    $mimeType = $mimeType[0];
                    return 'data:'.$mimeType.';base64,'.base64_encode($model->fotografia);
                    },
                'format' => ['image', ['height' => '140']],
            ],*/
            'fec_registro',
            'status',

            //['class' => 'yii\grid\ActionColumn'],

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{view}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        $file = $model->filefolder.$model->filename.$model->filetype;
                        if (file_exists($file)) {
                            return Html::a('<span class="btn btn-danger center-block">' . Icon::show('file-pdf') . '</span>',
                                Url::to(['carnetizacion/view', 'id' => base64_encode($model->id)]),
                                [
                                    'title' => Yii::t('yii', 'PDF'),
                                    'target'=>'_blank',
                                    'data-pjax'=>"0",
                                ]);
                        } else {
                            return '-';
                        }
                    },
                ]
            ],

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{fix}',
                'buttons'=>[
                    'fix' => function ($url, $model) {
                        return Html::a('<span class="btn btn-info center-block">' . Icon::show('tools') . '</span>',
                            Url::to('index.php?r=carnetizacion/fixcarnet&id=' . base64_encode($model->id)), [
                                'title' => Yii::t('yii', 'Fix Carnet'), 'target' => '_blank',
                            ]);
                    },
                ]
            ],
        ],
        'pjax' => false,
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
