<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TabIntSenescytSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Encuestas SENESCYT');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tab-int-senescyt-index">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode($this->title) ?></h3>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'fec_inicio',
            //'fec_fin',
            //'email:email',
            [
                'attribute'=>'cedula_pasaporte',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntSenescyt::find()->orderBy('cedula_pasaporte ASC')->all(), 'cedula_pasaporte', 'cedula_pasaporte'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],
            [
                'attribute'=>'nombres',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntSenescyt::find()->orderBy('nombres ASC')->all(), 'nombres', 'nombres'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],
            //'provincia',
            //'canton',
            //'parroquia',
            //'direccion',
            //'nivel',
            /*[
                'attribute'=>'carrera',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntSenescyt::find()->orderBy('carrera ASC')->all(), 'carrera', 'carrera'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],*/
            /*[
                'attribute'=>'semestre',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntSenescyt::find()->orderBy('semestre ASC')->all(), 'semestre', 'semestre'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],*/
            [
                'label' => 'Email',
                'value' => function ($model) {
                    $dni = $model->cedula_pasaporte;
                    $user = Yii::$app->ad->getProvider('default')->search()->users()->find($dni);


                    if (isset($user)) {
                        return $user->getAttribute('mail',0);
                    } else {
                        return 'NO';
                    }
                }
            ],
            [
                'label' => 'Mat.',
                'value' => function ($model) {
                    $dni = $model->cedula_pasaporte;
                    $matricula = \app\models\siad_pregrado\Matricula::find()
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
                'value' => function ($model) {
                    $dni = $model->cedula_pasaporte;
                    $matricula = \app\models\siad_pregrado\Matricula::find()
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
                'label' => 'Estratificacion',
                'value' => function ($model) {
                    $dni = $model->cedula_pasaporte;
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
                'label' => 'Con.',
                'value' => function ($model) {
                    $dni = $model->cedula_pasaporte;
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
                'attribute'=>'equipos',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntSenescyt::find()->orderBy('equipos ASC')->all(), 'equipos', 'equipos'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],
            //'computador',
            //'portatil',
            //'tablet',
            //'radio',
            //'television',
            //'smartphone',
            //'mic_computador',
            //'cam_computador',
            //'par_computador',
            //'mic_portatil',
            //'cam_portatil',
            //'par_portatil',
            [
                'attribute'=>'internet',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntSenescyt::find()->orderBy('internet ASC')->all(), 'internet', 'internet'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],
            //'tipo',
            //'proveedor',
            //'velocidad',
            //'teletrabajo',
            //'estudios',
            //'cant_usuarios',
            //'horas',
            //'accion',

            //['class' => 'yii\grid\ActionColumn'],

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{beneficiario}{create}',
                'buttons'=>[
                    'beneficiario' => function ($url, $model) {
                        return Html::a('<span class="btn btn-primary center-block">Check</span>',
                            Url::to(['/tabintformulario/beneficiario', 'search' => $model->cedula_pasaporte]), [
                                'title' => Yii::t('yii', 'Check'),
                                'target'=>'_blank',
                                'data-pjax'=>"0",
                            ]);
                    },
                    'create' => function ($url, $model) {
                        return Html::a('<span class="btn btn-success center-block">Crear</span>',
                            Url::to(['/tabintformulario/create', 'search' => $model->cedula_pasaporte]), [
                                'title' => Yii::t('yii', 'Crear'),
                                'target'=>'_blank',
                                'data-pjax'=>"0",
                            ]);
                    },
                ]
            ],
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
