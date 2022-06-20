<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use practically\chartjs\Chart;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TabIntFormularioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


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
                'attribute'=>'encuesta_beneficiario',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\TabIntFormulario::find()->orderBy('encuesta_beneficiario ASC')->all(), 'encuesta_beneficiario', 'encuesta_beneficiario'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw'
            ],
            [
                'attribute' => 'apellidos',
                'label' => 'Nombre Apellidos',
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
            [
                'attribute' => 'cedula',
                'label' => 'No. Cédula',
                'value' => 'cedula'
            ],
            [
                'attribute' => 'siad_semestre',
                'label' => 'Semestre',
                'value' => 'siad_semestre'
            ],
            [
                'attribute' => 'siad_carrera',
                'label' => 'Carrera',
                'value' => 'siad_carrera'
            ],
            [
                'attribute' => 'siad_carrera',
                'label' => 'Facultad',
                'value' => function ($model) {
                    $siad_carrera = $model->siad_carrera;
                    if ($siad_carrera == 'AGROINDUSTRIA' ||
                        $siad_carrera == 'AGROPECUARIA' ||
                        $siad_carrera == 'INGENIERIA FORESTAL'
                    ) {
                        return 'CIENCIAS DE LA TIERRA';
                    } elseif ($siad_carrera == 'BIOLOGIA' ||
                        $siad_carrera == 'INGENIERIA AMBIENTAL' ||
                        $siad_carrera == 'LICENCIATURA TURISMO'
                    ) {
                        return 'CIENCIAS DE LA VIDA';
                    } else {
                        return '-';
                    }

                }
            ],
            [
                'label' => 'Dirección',
                'value' => function ($model) {
                    return $model->provincia . '. ' .
                        $model->canton . '. ' .
                        $model->parroquia . '. ' .
                        $model->calle_principal . ' ' .
                        $model->calle_secundaria;
                }
            ],
            [
                'label' => 'Teléfono',
                'value' => function ($model) {
                    return $model->cel_contacto . ' ' . $model->tel_contacto;
                }
            ],
            [
                'label' => 'No.Serie',
                'value' => function ($model) {
                    $dni = $model->cedula;
                    $user_profile = \app\models\UserProfile::find()
                        ->where(['dni' => $dni])
                        ->one();
                    if (isset($user_profile)) {
                        $username = $user_profile->username;
                        $inv_item_user = \app\models\InvItemUser::find()
                            ->andWhere(['username' => $username])
                            ->andWhere(['>=','inv_purchase_item_id',1451])
                            ->andWhere(['<=','inv_purchase_item_id',1950])
                            ->one();

                        if (isset($inv_item_user)) {
                            $inv_purchase_item = \app\models\InvPurchaseItem::find()
                                ->where(['id' => $inv_item_user->inv_purchase_item_id])
                                ->one();
                            return $inv_purchase_item->serial_number;
                        } else {
                            return '-';
                        }
                    } else {
                        return 'Sin perfil de usuario';
                    }

                }
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
            //'cobertura',
            //'smartphone',
            //'responsabilidad_uso',
            //'condiciones',
            //'doc_cedula_pasaporte',
            //'doc_servicio_basico',
            //'doc_responsabilidad_uso',
            //'doc_contrato',
            //'qrcode',
            //'fec_registro',
            [
                'attribute' => 'fec_registro',
                'label' => 'Fecha',
                'value' => function ($model) {
                    $fecha = substr($model->fec_registro,0,10);
                    if ($fecha > '2020-07-03') {
                        return '2020-07-03';
                    } else {
                        return $fecha;
                    }
                }
            ],
            //'status',

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
