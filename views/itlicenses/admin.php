<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\bootstrap\Modal;

use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\ItLicenses */

$this->title = $model->license;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Licencias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-licenses-view">

    <?= DetailView::widget([
        'model' => $model,
        'condensed'=>false,
        'hover'=>false,
        'enableEditMode'=>false,
        'mode'=>DetailView::MODE_VIEW,
        'panel'=>[
            'heading'=>'ETIQUETA: ' . $model->license,
            'type'=>DetailView::TYPE_PRIMARY,
        ],
        'attributes' => [
            //'id',
            'license',
            'quantity',
            'description:ntext',
            'serial_number',
            'valid_since',
            'valid_until',

            [
                'attribute' => 'inv_manufacturers_id',
                'value' => $model->invManufacturers->manufacturer,
            ],
            [
                'attribute'=>'status',
                'format'=>'raw',
                'value'=>$model->status ? '<span class="label label-success">ACTIVO</span>' : '<span class="label label-danger">INACTIVO</span>',
                'type'=>DetailView::INPUT_SWITCH,
                'widgetOptions' => [
                    'pluginOptions' => [
                        'onText' => 'Yes',
                        'offText' => 'No',
                    ]
                ],
            ],
        ],
    ]) ?>

    <p>
        <?= Html::a(Yii::t('app', 'Editar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php echo TabsX::widget([
        'position' => TabsX::POS_ABOVE,
        'align' => TabsX::ALIGN_LEFT,
        'encodeLabels'=>false,
        'enableStickyTabs' => true,
        'items' => [
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> DOCUMENTOS',
                'content' => $this->render('_documents', [
                    'model' => $model,
                ])
            ],
        ],
    ]);
    ?>

</div>
