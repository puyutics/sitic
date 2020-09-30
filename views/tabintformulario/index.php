<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\editable\Editable;
use practically\chartjs\Chart;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TabIntFormularioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$dataProvider->sort->defaultOrder = ['fec_registro' => SORT_DESC];

$this->title = 'Contratos Recursos Académicos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tab-int-formulario-index">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode($this->title) ?></h3>
    </div>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if (!isset($_GET['TabIntFormularioSearch'])) { ?>
        <div class="alert alert-info" align="center">
            <h5 align="center">Para mostrar un reporte haga <b>clic en Buscar</b></h5>
        </div>

    <?php } else { ?>

        <?php $TabIntFormularioSearch = $_GET['TabIntFormularioSearch']; ?>

        <?php if ($dataProvider->count == 0) { ?>
            <div class="alert alert-danger" align="center">
                <h5 align="center">No existen resultados para su búsqueda</h5>
            </div>
        <?php } ?>

        <?php if ($dataProvider->count > 0) { ?>
            <div class="alert alert-info" align="center">
                <?= Html::a('<span class="btn btn-lg btn btn-danger">Reporte en PDF</span>',
                    Url::to(['/tabintformulario/reporte',
                        'dni' => $searchModel->cedula,
                        'provincia' => $searchModel->provincia,
                        'beneficio' => $searchModel->encuesta_beneficiario,
                        'status' => $searchModel->status,
                        'fecha_inicio' => $searchModel->fecha_inicio,
                        'fecha_fin' => $searchModel->fecha_fin
                    ]), [
                        'title' => Yii::t('yii', 'Imprimir Reporte'),
                        'target'=>'_blank',
                        'data-pjax'=>"0",
                    ]);
                ?>

                <?= Html::a('<span class="btn btn-lg btn btn-primary">Reporte Gráfico</span>',
                    Url::to(['/tabintformulario/reportegrafico']), [
                        'title' => Yii::t('yii', 'Imprimir Reporte'),
                        'target'=>'_blank',
                        'data-pjax'=>"0",
                    ]);
                ?>
            </div>

        <?php } ?>

    <?php } ?>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'cedula',
                'value' => function ($model) {
                    $dni = $model->cedula;
                    $tabintformulario = \app\models\TabIntFormulario::find()
                        ->where(["cedula" => $dni])
                        ->one();

                    return $tabintformulario->cedula;
                }
            ],
            [
                'attribute' => 'apellidos',
                'label' => 'Beneficiario',
                'value' => function ($model) {
                    $dni = $model->cedula;
                    $tabintformulario = \app\models\TabIntFormulario::find()
                        ->where(["cedula" => $dni])
                        ->one();

                    return $tabintformulario->apellidos
                        . ' '
                        . $tabintformulario->nombres;
                }
            ],
            /*[
                'attribute'=>'cedula',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntFormulario::find()->orderBy('cedula ASC')->all(), 'cedula', 'cedula'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],*/
            //'username',
            //'email:email',
            /*[
                'attribute'=>'nombres',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntFormulario::find()->orderBy('nombres ASC')->all(), 'nombres', 'nombres'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],*/
            /*[
                'attribute'=>'apellidos',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntFormulario::find()->orderBy('apellidos ASC')->all(), 'apellidos', 'apellidos'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],*/
            //'codigo_postal',
            [
                'attribute'=>'provincia',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntFormulario::find()->orderBy('provincia ASC')->all(), 'provincia', 'provincia'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],
            [
                'attribute'=>'canton',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntFormulario::find()->orderBy('canton ASC')->all(), 'canton', 'canton'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],
            [
                'attribute'=>'parroquia',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntFormulario::find()->orderBy('parroquia ASC')->all(), 'parroquia', 'parroquia'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],
            //'calle_principal',
            //'calle_secundaria',
            //'referencia_texto',
            //'referencia_foto',
            //'cel_contacto',
            //'tel_contacto',
            //'siad_matriculado',
            //'siad_semestre',
            //'siad_carrera',
            //'ficha_escasos_recursos',
            [
                'attribute'=>'encuesta_beneficiario',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntFormulario::find()->orderBy('encuesta_beneficiario ASC')->all(), 'encuesta_beneficiario', 'encuesta_beneficiario'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],
            //'cobertura',
            //'smartphone',
            //'responsabilidad_uso',
            //'condiciones',
            //'doc_cedula_pasaporte',
            //'doc_servicio_basico',
            //'doc_responsabilidad_uso',
            //'doc_contrato',
            //'qrcode',
            'fec_registro',
            //'status',
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'ESTADO',
                'attribute'=>'status',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_DROPDOWN_LIST,
                        'size' => 'sm',
                        'formOptions' => ['action' => Url::to(['tabintformulario/estatus'])],
                        'data' =>['1'=>'CONTRATO CREADO',
                            '2'=>'BENEFICIO ENTREGADO',
                            '3'=>'ENVIADO POR SERVIENTREGA',
                            '4'=>'ENVIADO SEDE EL PANGUI',
                            '5'=>'ENVIADO SEDE LAGO AGRIO',
                            '6'=>'ENTREGADO SEDE EL PANGUI',
                            '7'=>'ENTREGADO SEDE LAGO AGRIO',
                            ],
                        'displayValueConfig'=> [
                            '1' => '<i class="glyphicon glyphicon-ok text-success"></i> CONTRATO CREADO',
                            '2' => '<i class="glyphicon glyphicon-ok text-success"></i><i class="glyphicon glyphicon-ok text-success"></i> BENEFICIO ENTREGADO',
                            '3' => '<i class="glyphicon glyphicon-ok text-success"></i><i class="glyphicon glyphicon-ok text-success"></i> ENVIADO POR SERVIENTREGA',
                            '4' => '<i class="glyphicon glyphicon-ok text-success"></i><i class="glyphicon glyphicon-ok text-success"></i> ENVIADO SEDE EL PANGUI',
                            '5' => '<i class="glyphicon glyphicon-ok text-success"></i><i class="glyphicon glyphicon-ok text-success"></i> ENVIADO SEDE LAGO AGRIO',
                            '6' => '<i class="glyphicon glyphicon-ok text-success"></i><i class="glyphicon glyphicon-ok text-success"></i> ENTREGADO SEDE EL PANGUI',
                            '7' => '<i class="glyphicon glyphicon-ok text-success"></i><i class="glyphicon glyphicon-ok text-success"></i> ENTREGADO SEDE LAGO AGRIO',
                        ],
                        'options' => [
                            'class'=>'form-control', 'prompt'=>'Seleccionar estado',
                        ]
                    ];
                },
                'filter'=>['1'=>'CONTRATO CREADO',
                    '2'=>'BENEFICIO ENTREGADO',
                    '3'=>'ENVIADO POR SERVIENTREGA',
                    '4'=>'ENVIADO SEDE EL PANGUI',
                    '5'=>'ENVIADO SEDE LAGO AGRIO',
                    '6'=>'ENTREGADO SEDE EL PANGUI',
                    '7'=>'ENTREGADO SEDE LAGO AGRIO',
                    ],
            ],

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{admin}',
                'buttons'=>[
                    'admin' => function ($url, $model) {
                        return Html::a('<span class="btn btn-success center-block">Abrir</span>',
                            Url::to(['/tabintformulario/admin', 'id' => $model->id]), [
                                'title' => Yii::t('yii', 'Abrir'),
                                'target'=>'_blank',
                                'data-pjax'=>"0",
                            ]);
                    },
                ]
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
