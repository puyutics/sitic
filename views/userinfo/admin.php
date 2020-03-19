<?php

use kartik\tabs\TabsX;
use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\daterange\DateRangePicker;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserInfo */

$department = $model->getDepartments()->one();
$department = $department['DEPTNAME'];

$this->title = $model->NAME;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestión TI'), 'url' => ['site/management']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['adldap/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Asistencia'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-info-view">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'USERID',
            'BADGENUMBER',
            'SSN',
            'sca_Nombre',
            'sca_Apellido',
            'sca_Correo',
            [
                'attribute' => 'DEFAULTDEPTID',
                'value' => $department,
            ],

            //'USERID',
            //'BADGENUMBER',
            //'SSN',
            //'NAME',
            //'GENDER',
            //'TITLE',
            //'PAGER',
            //'BIRTHDAY',
            //'HIREDDAY',
            //'STREET',
            //'CITY',
            //'STATE',
            //'ZIP',
            //'OPHONE',
            //'FPHONE',
            //'VERIFICATIONMETHOD',
            //'DEFAULTDEPTID',
            //'SECURITYFLAGS',
            //'ATT',
            //'INLATE',
            //'OUTEARLY',
            //'OVERTIME:datetime',
            //'SEP',
            //'HOLIDAY',
            //'MINZU',
            //'PASSWORD',
            //'LUNCHDURATION',
            //'MVerifyPass',
            //'PHOTO',
            //'Notes',
            //'privilege',
            //'InheritDeptSch',
            //'InheritDeptSchClass',
            //'AutoSchPlan',
            //'MinAutoSchInterval',
            //'RegisterOT',
            //'InheritDeptRule',
            //'EMPRIVILEGE',
            //'CardNo',
            //'sca_IESSID',
            //'sca_Estado',
            //'sca_FormaPago',
            //'sca_1Quincena',
            //'sca_Nombre',
            //'sca_Apellido',
            //'sca_Cargo',
            //'sca_IdCentroCostos',
            //'sca_EstadoCivil',
            //'sca_Sexo',
            //'sca_FechaDespido',
            //'sca_CargasFamiliares',
            //'sca_Firma',
            //'Pin1',
            //'sca_Discapacidad',
            //'sca_Correo',
            //'sca_MotivoInactivacion',
            //'sca_WEB_MarcaManual',
        ],
        'bordered' => true,
        'condensed'=> true,
        'enableEditMode'=>false,
        'panel'=>[
            'heading'=> 'DATOS DEL SISTEMA DE CONTROL DE ASISTENCIA',
            'type'=>DetailView::TYPE_PRIMARY,
        ],
    ]) ?>

    <?php echo TabsX::widget([
        'position' => TabsX::POS_ABOVE,
        'align' => TabsX::ALIGN_LEFT,
        'encodeLabels'=>false,
        'enableStickyTabs' => true,
        'stickyTabsOptions' => [
            'selectorAttribute' => "data-target",
            'backToTop' => true,
        ],
        'items' => [
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Marcaciones',
                'content' => $this->render('_checkinout', [
                    'model' => $model,
                ])

            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Manual',
                'content' => $this->render('_checkexact', [
                    'model' => $model,
                ])

            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Permisos',
                'content' => $this->render('_permisos', [
                    'model' => $model,
                ])

            ],
        ],
    ]);
    ?>

</div>
