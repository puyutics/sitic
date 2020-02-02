<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserInfo */

$this->title = $model->NAME;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->USERID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->USERID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'USERID',
            'BADGENUMBER',
            'SSN',
            'NAME',
            'GENDER',
            'TITLE',
            'PAGER',
            'BIRTHDAY',
            'HIREDDAY',
            'STREET',
            'CITY',
            'STATE',
            'ZIP',
            'OPHONE',
            'FPHONE',
            'VERIFICATIONMETHOD',
            'DEFAULTDEPTID',
            'SECURITYFLAGS',
            'ATT',
            'INLATE',
            'OUTEARLY',
            'OVERTIME:datetime',
            'SEP',
            'HOLIDAY',
            'MINZU',
            'PASSWORD',
            'LUNCHDURATION',
            'MVerifyPass',
            'PHOTO',
            'Notes',
            'privilege',
            'InheritDeptSch',
            'InheritDeptSchClass',
            'AutoSchPlan',
            'MinAutoSchInterval',
            'RegisterOT',
            'InheritDeptRule',
            'EMPRIVILEGE',
            'CardNo',
            'sca_IESSID',
            'sca_Estado',
            'sca_FormaPago',
            'sca_1Quincena',
            'sca_Nombre',
            'sca_Apellido',
            'sca_Cargo',
            'sca_IdCentroCostos',
            'sca_EstadoCivil',
            'sca_Sexo',
            'sca_FechaDespido',
            'sca_CargasFamiliares',
            'sca_Firma',
            'Pin1',
            'sca_Discapacidad',
            'sca_Correo',
            'sca_MotivoInactivacion',
            'sca_WEB_MarcaManual',
        ],
    ]) ?>

</div>
