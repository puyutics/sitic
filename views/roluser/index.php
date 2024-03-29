<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use johnitvn\ajaxcrud\CrudAsset;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\RolUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Roles de Pago';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

$anio_inicio = date('Y');
$anio_fin = ('2021');
$anio_array = [];
$i=0;
foreach (range($anio_inicio, $anio_fin, -1) as $anio) {
    $anio_array[$anio] = $anio;
    $i++;
}

$mes_array = [];
$mes_array[1] = 'Enero';
$mes_array[2] = 'Febrero';
$mes_array[3] = 'Marzo';
$mes_array[4] = 'Abril';
$mes_array[5] = 'Mayo';
$mes_array[6] = 'Junio';
$mes_array[7] = 'Julio';
$mes_array[8] = 'Agosto';
$mes_array[9] = 'Septiembre';
$mes_array[10] = 'Octubre';
$mes_array[11] = 'Noviembre';
$mes_array[12] = 'Diciembre';

?>
<div class="rol-user-index">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode($this->title) ?></h3>
    </div>

    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => [
                ['class' => 'kartik\grid\SerialColumn'],

                //'id',
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'username',
                    'label' => 'Usuario',
                    'value'=>function($model){
                        return \app\models\UserProfile::findOne($model->username)->datosCompletos;
                    },
                    'filterType'=>GridView::FILTER_SELECT2,
                    'filter'=>ArrayHelper::map(\app\models\UserProfile::find()
                        ->orderBy('lastname ASC, firstname ASC')
                        ->all(),
                        'username',
                        'datosCompletos'),
                    'filterWidgetOptions'=>[
                        'pluginOptions'=>['allowClear'=>true],
                    ],
                    'filterInputOptions'=>['placeholder'=>'Seleccionar Usuario'],
                    'format'=>'raw'
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'rol_tipo_id',
                    'label' => 'Tipo Rol',
                    'value'=>function($model){
                        return \app\models\RolTipo::findOne($model->rol_tipo_id)->nombre;
                    },
                    'filterType'=>GridView::FILTER_SELECT2,
                    'filter'=>ArrayHelper::map(\app\models\RolTipo::find()
                        ->all(),
                        'id',
                        'nombre'),
                    'filterWidgetOptions'=>[
                        'pluginOptions'=>['allowClear'=>true],
                    ],
                    'filterInputOptions'=>['placeholder'=>'Seleccionar Tipo'],
                    'format'=>'raw'
                ],
                [
                    'attribute' => 'anio',
                    'label' => 'Año',
                    'filter'=>$anio_array,
                ],
                [
                    'attribute' => 'mes',
                    'label' => 'Mes',
                    'filter'=>$mes_array,
                    'value' => function($model) {
                        if ($model->mes == 1){
                            return 'Enero';
                        } elseif ($model->mes == 2){
                            return 'Febrero';
                        } elseif ($model->mes == 3){
                            return 'Marzo';
                        } elseif ($model->mes == 4){
                            return 'Abril';
                        } elseif ($model->mes == 5){
                            return 'Mayo';
                        } elseif ($model->mes == 6){
                            return 'Junio';
                        } elseif ($model->mes == 7){
                            return 'Julio';
                        } elseif ($model->mes == 8){
                            return 'Agosto';
                        } elseif ($model->mes == 9){
                            return 'Septiembre';
                        } elseif ($model->mes == 10){
                            return 'Octubre';
                        } elseif ($model->mes == 11){
                            return 'Noviembre';
                        } elseif ($model->mes == 12){
                            return 'Diciembre';
                        }
                    },
                ],
                //'filename',
                //'filetype',
                [
                    'attribute' => 'status',
                    'label' => 'Estado',
                    'value' => function($model) {
                        if ($model->status == 0){
                            return 'Correo No Enviado';
                        } elseif ($model->status == 1){
                            return 'Correo Enviado';
                        }
                    },
                    'filter'=>['1'=>'Correo Enviado','0'=>'Correo No Enviado'],
                ],
                ['class' => 'kartik\grid\ActionColumn',
                    'template'=>'{update} {pdf} {email}',
                    'buttons'=>[
                        'pdf' => function ($url, $model) {
                            $filefolder = $model->filefolder;
                            $filename = $model->filename;
                            $filetype = $model->filetype;
                            if (file_exists($filefolder.$filename.'.'.$filetype)) {
                                return Html::a(Icon::show('file-pdf'),
                                    Url::to('index.php?r=roluser/pdf&id=' . base64_encode($model->id)), [
                                        'title' => Yii::t('yii', 'PDF'), 'target' => '_blank',
                                        'data-pjax'=>"0"]);
                            } else {
                                return '-';
                            }
                        },
                        'email' => function ($url, $model) {
                            return Html::a(Icon::show('paper-plane'),
                                Url::to('index.php?r=roluser/email&id=' . base64_encode($model->id)), [
                                    'title' => Yii::t('yii', 'Reenviar Correo'), 'target' => '_blank',
                                    'data-pjax'=>"0"]);
                        },
                    ],
                    'updateOptions'=>[
                        'role'=>'modal-remote',
                        'title'=>'Editar',
                        'data-toggle'=>'tooltip'],
                ],

                /*[
                    'class' => 'kartik\grid\ActionColumn',
                    'template' => '{view}{update}',
                    'dropdown' => false,
                    'vAlign'=>'middle',
                    'urlCreator' => function($action, $model, $key, $index) {
                        return Url::to([$action,'id'=>$key]);
                    },
                    'viewOptions'=>['role'=>'modal-remote','title'=>'Ver','data-toggle'=>'tooltip'],
                    'updateOptions'=>['role'=>'modal-remote','title'=>'Editar','data-toggle'=>'tooltip'],
                ],*/
            ],
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                        ['role'=>'modal-remote','title'=> 'Subir nuevo Rol de Pago','class'=>'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                        ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Resetear Grid']).
                    '{toggleData}'.
                    '{export}'
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> Gestión - Roles de Pagos',
            ]
        ])?>
    </div>

</div>
<?php Modal::begin([
    "footer"=>"",// always need it for jquery plugin
    'options' => [
        'id' => 'ajaxCrudModal',
        'tabindex' => false // important for Select2 to work properly
    ],
])?>
<?php Modal::end(); ?>
