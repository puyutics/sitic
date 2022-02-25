<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RolTipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipos de Roles de Pago';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
?>
<div class="rol-tipo-index">

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
                'nombre',
                'nom_corto',
                [
                    'attribute' => 'status',
                    'value' => function($model) {
                        if ($model->status == 0){
                            return 'INACTIVO';
                        } elseif ($model->status == 1){
                            return 'ACTIVO';
                        }
                    },
                    'filter'=>['1'=>'ACTIVO','0'=>'INACTIVO'],
                ],

                [
                    'class' => 'kartik\grid\ActionColumn',
                    'template' => '{view}{update}',
                    'dropdown' => false,
                    'vAlign'=>'middle',
                    'urlCreator' => function($action, $model, $key, $index) {
                        return Url::to([$action,'id'=>$key]);
                    },
                    'viewOptions'=>['role'=>'modal-remote','title'=>'Ver','data-toggle'=>'tooltip'],
                    'updateOptions'=>['role'=>'modal-remote','title'=>'Editar','data-toggle'=>'tooltip'],
                ],
            ],
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                        ['role'=>'modal-remote','title'=> 'Crear nuevo Tipo de Rol de Pago','class'=>'btn btn-default']).
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
                'heading' => '<i class="glyphicon glyphicon-list"></i> Gestión - Tipos de Roles de Pagos',
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
