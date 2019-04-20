<?php
/**
 * Created by PhpStorm.
 * User: gfernandez
 * Date: 26/9/18
 * Time: 08:51
 */

use kartik\select2\Select2;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use kartik\tabs\TabsX;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestión TI'), 'url' => ['site/management']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['adldap/index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Ver Grupos');
?>

<?php $form = ActiveForm::begin([
    'method' => 'post',
]); ?>

<div class="search-form">
    <?php if (isset($_GET['search'])) { ?>
    <div class="row"> <div class="alert col-sm-offset-4 col-sm-4" align="center">
            <?= Html::a(Yii::t('app', 'Reiniciar Búsqueda'),
                Url::toRoute(['adldap/viewgroups']), ['class' => 'btn btn-warning']) ?>
        </div> </div>
    <?php } ?>

    <?php if (!isset($_GET['search'])) { ?>
        <div class="row"> <div class="alert alert-warning col-sm-offset-4 col-sm-4" align="center">

            <?php echo "<p></p>";
                echo $form->field($model, 'search')->widget(Select2::classname(), [
                    'data' => Yii::$app->params['groups'],
                    'options' => ['placeholder' => 'Seleccionar grupo'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
            ]); ?>

            <?= Html::submitButton('Buscar',['class' => 'btn btn-default',
                'value'=>'searchButton', 'name'=>'searchButton',
                'onClick'=>'buttonClicked']) ?>
        </div> </div>
    <?php } ?>
</div>

<?php

if (isset($_GET['search'])) { ?>

    <?php echo TabsX::widget([
        'position' => TabsX::POS_ABOVE,
        'align' => TabsX::ALIGN_CENTER,
        'sideways'=>false,
        'bordered'=>false,
        'encodeLabels'=>false,
        'enableStickyTabs' => true,
        'items' => [
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Grupo',
                'content' => $this->render('view_groups_edit', [
                    'model' => $model,
                    'form' => $form,
                ])

            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Miembros',
                'content' => $this->render('view_groups_members', [
                    'model' => $model,
                    'form' => $form,
                ])

            ],
        ],
    ]);
    ?>

<?php }?>

<?php ActiveForm::end(); ?>
