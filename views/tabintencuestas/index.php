<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TabIntEncuestasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Encuestas UEA');
$this->params['breadcrumbs'][] = $this->title;

$dataProvider->sort->defaultOrder = ['Apellidos' => SORT_ASC];

?>
<div class="tab-int-encuestas-index">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode($this->title) ?></h3>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
                'label'=>'DNI',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntEncuestas::find()->orderBy('CedulaPasaporte ASC')->all(), 'CedulaPasaporte', 'CedulaPasaporte'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],
            [
                'attribute' => 'Apellidos',
                'label' => 'Beneficiario',
                'value' => function ($model) {
                    $dni = $model->CedulaPasaporte;
                    $TabIntEncuestas = \app\models\TabIntEncuestas::find()
                        ->where(["CedulaPasaporte" => $dni])
                        ->one();

                    return $TabIntEncuestas->Apellidos
                        . ' '
                        . $TabIntEncuestas->Nombres;
                }
            ],
            /*[
                'attribute'=>'Apellidos',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntEncuestas::find()->orderBy('Apellidos ASC')->all(), 'Apellidos', 'Apellidos'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],*/
            /*[
                'attribute'=>'Nombres',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntEncuestas::find()->orderBy('Nombres ASC')->all(), 'Nombres', 'Nombres'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],*/
            //'Email:email',
            //'Campus',
            /*[
                'attribute'=>'Carrera',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntEncuestas::find()->orderBy('Carrera ASC')->all(), 'Carrera', 'Carrera'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],*/
            //'Operadora',
            /*[
                'attribute'=>'Computador',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntEncuestas::find()->orderBy('Computador ASC')->all(), 'Computador', 'Computador'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],*/
            //'TipoComputador',
            /*[
                'attribute'=>'Internet',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntEncuestas::find()->orderBy('Internet ASC')->all(), 'Internet', 'Internet'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],*/
            //'TipoInternet',
            //'PropiedadComputador',
            //'x',
            //'y',
            'Telefono',

            /*[
                'label' => 'Email',
                'value' => function ($model) {
                    $dni = $model->CedulaPasaporte;
                    $user = Yii::$app->ad->getProvider('default')->search()->users()->find($dni);


                    if (isset($user)) {
                        return $user->getAttribute('mail',0);
                    } else {
                        return 'NO';
                    }
                }
            ],*/
            [
                'label' => 'Mat.',
                'format' => ['image',['width'=>'20']],
                'value' => function ($model) {
                    $dni = $model->CedulaPasaporte;
                    $matricula = \app\models\Matricula::find()
                        ->where(["CIInfPer" => $dni])
                        ->andWhere(["idPer" => 34])
                        ->andWhere(["statusMatricula" => 'APROBADA'])
                        ->orderBy(["idsemestre" => SORT_DESC])
                        ->all();

                    if (count($matricula)>0) {
                        return ('@web/images/done.png');
                    } else {
                        return ('@web/images/deny.png');
                    }
                }
            ],
            [
                'label' => 'Mat.',
                'value' => function ($model) {
                    $dni = $model->CedulaPasaporte;
                    $matricula = \app\models\Matricula::find()
                        ->where(["CIInfPer" => $dni])
                        ->andWhere(["idPer" => 34])
                        ->andWhere(["statusMatricula" => 'APROBADA'])
                        ->orderBy(["idsemestre" => SORT_DESC])
                        ->all();

                    if (count($matricula)>0) {
                        return 'SI';
                    } else {
                        return 'NO';
                    }
                }
            ],
            [
                'label' => 'Sem.',
                'format' => ['image',['width'=>'20']],
                'value' => function ($model) {
                    $dni = $model->CedulaPasaporte;
                    $matricula = \app\models\Matricula::find()
                        ->where(["CIInfPer" => $dni])
                        ->andWhere(["idPer" => 34])
                        ->andWhere(["statusMatricula" => 'APROBADA'])
                        ->orderBy(["idsemestre" => SORT_DESC])
                        ->one();

                    if (isset($matricula)){
                        if (($matricula->idCarr == "LTUR")
                            and ($matricula->idsemestre < 9)) {
                            return ('@web/images/done.png');
                        } elseif (($matricula->idCarr != "LTUR")
                            and ($matricula->idsemestre < 10)) {
                            return ('@web/images/done.png');
                        } else {
                            return ('@web/images/deny.png');
                        }
                    } else {
                        return ('@web/images/deny.png');
                    }
                }
            ],
            [
                'label' => 'Sem.',
                'value' => function ($model) {
                    $dni = $model->CedulaPasaporte;
                    $matricula = \app\models\Matricula::find()
                        ->where(["CIInfPer" => $dni])
                        ->andWhere(["idPer" => 34])
                        ->andWhere(["statusMatricula" => 'APROBADA'])
                        ->orderBy(["idsemestre" => SORT_DESC])
                        ->one();

                    if (isset($matricula)){
                        if (($matricula->idCarr == "LTUR")
                            and ($matricula->idsemestre < 9)) {
                            return 'SI';
                        } elseif (($matricula->idCarr != "LTUR")
                            and ($matricula->idsemestre < 10)) {
                            return 'SI';
                        } else {
                            return 'NO';
                        }
                    } else {
                        return 'NO';
                    }
                }
            ],
            [
                'label' => 'Est.',
                'format' => ['image',['width'=>'20']],
                'value' => function ($model) {
                    $dni = $model->CedulaPasaporte;
                    $estratificacion = \app\models\BecasFestrat::find()
                        ->where(["cedula" => $dni])
                        ->orderBy('periodo DESC')
                        ->one();

                    if (isset($estratificacion)) {
                        if ($estratificacion->Grupo == 'C+ (medio típico)'
                            or $estratificacion->Grupo == 'C- (medio bajo)'
                            or $estratificacion->Grupo == 'D (bajo)') {
                            return ('@web/images/done.png');
                        } else {
                            return ('@web/images/deny.png');
                        }
                    } else {
                        return ('@web/images/deny.png');
                    }
                }
            ],
            [
                'label' => 'Estratificacion',
                'value' => function ($model) {
                    $dni = $model->CedulaPasaporte;
                    $estratificacion = \app\models\BecasFestrat::find()
                        ->where(["cedula" => $dni])
                        ->orderBy('periodo DESC')
                        ->one();

                    if (isset($estratificacion)) {
                        return $estratificacion->Grupo;
                    } else {
                        return 'NO';
                    }
                }
            ],
            [
                'label' => 'Contrato',
                'format' => ['image',['width'=>'20']],
                'value' => function ($model) {
                    $dni = $model->CedulaPasaporte;
                    $TabIntFormulario = \app\models\TabIntFormulario::find()
                        ->where(["cedula" => $dni])
                        ->all();

                    if (count($TabIntFormulario)>0) {
                        return ('@web/images/done.png');
                    } else {
                        return ('@web/images/deny.png');
                    }
                }
            ],
            [
                'label' => 'Con.',
                'value' => function ($model) {
                    $dni = $model->CedulaPasaporte;
                    $TabIntFormulario = \app\models\TabIntFormulario::find()
                        ->where(["cedula" => $dni])
                        ->all();

                    if (count($TabIntFormulario)>0) {
                        return 'SI';
                    } else {
                        return 'NO';
                    }
                }
            ],
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
            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{beneficiario}{create}',
                'buttons'=>[
                    'beneficiario' => function ($url, $model) {
                        return Html::a('<span class="btn btn-primary center-block">Check</span>',
                            Url::to(['/tabintformulario/beneficiario', 'search' => $model->CedulaPasaporte]), [
                                'title' => Yii::t('yii', 'Check'),
                                'target'=>'_blank',
                                'data-pjax'=>"0",
                            ]);
                    },
                    'create' => function ($url, $model) {
                        return Html::a('<span class="btn btn-success center-block">Crear</span>',
                            Url::to(['/tabintformulario/create', 'search' => $model->CedulaPasaporte]), [
                                'title' => Yii::t('yii', 'Crear'),
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
