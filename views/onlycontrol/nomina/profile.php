<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Nomina */

$this->title = 'Perfil (Usuario)';
$this->params['breadcrumbs'][] = ['label' => 'Nominas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

if (isset($_GET['oc_user_id'])) {
    $oc_user_id = base64_decode($_GET['oc_user_id']);
} else {
    $oc_user_id = NULL;
}

//Buscar usuario en Onlycontrol
$oc_user = \app\models\onlycontrol\Nomina::find()
    ->where(['NOMINA_ID' => $oc_user_id])
    ->one();

if (isset($oc_user)) {
    $oc_user_admin_bio = $oc_user->NOMINA_ADMIN_BIO;
}

?>
<div class="nomina-view">

    <div class="alert alert-warning" align="center">
        <h3 align="center"><?= $this->title ?></h3>
        <h3 align="center"><?= $oc_user->NOMINA_APE .' '. $oc_user->NOMINA_NOM ?></h3>
        <h4 align="center" style="color:palevioletred">Tipo: <?php if ($oc_user_admin_bio == 1) echo 'Administrador'; else echo 'Usuario'; ?></h4>
        <h4 align="center" style="color:palevioletred">Cédula: <?= $oc_user->NOMINA_COD ?></h4>
        <h4 align="center" style="color:palevioletred">Código: <?= $oc_user->NOMINA_ID ?></h4>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Código',
                'attribute' => 'NOMINA_ID',
            ],
            [
                'label' => 'Cédula',
                'attribute' => 'NOMINA_COD',
            ],
            [
                'label' => 'Apellidos',
                'attribute' => 'NOMINA_APE',
            ],
            [
                'label' => 'Nombres',
                'attribute' => 'NOMINA_NOM',
            ],
            [
                'label' => 'Tipo',
                'attribute' => 'NOMINA_TIPO',
            ],
            [
                'label' => 'Cargo',
                'attribute' => 'NOMINA_CAL1',
            ],
            [
                'label' => 'Area',
                'attribute' => 'NOMINA_AREA1',
            ],
            [
                'label' => 'Oficina',
                'attribute' => 'NOMINA_DEP1',
            ],
            [
                'label' => 'Fec. Ingreso',
                'attribute' => 'NOMINA_FING',
            ],
            [
                'label' => 'Fec. Salida',
                'attribute' => 'NOMINA_FSAL',
            ],
            [
                'label' => 'Tarjeta Acceso',
                'attribute' => 'NOMINA_CARD',
            ],
            [
                'label' => 'Tarjeta Caducidad',
                'attribute' => 'NOMINA_FCARD',
            ],
            [
                'label' => 'Fecha Creación',
                'attribute' => 'NOMINA_NOW',
            ],
            [
                'label' => 'Tipo Control',
                'attribute' => 'NOMINA_CONTROLAPB',
                'value' => function ($model) {
                    if ($model->NOMINA_CONTROLAPB == 0) {
                        return 'Control Online';
                    } elseif ($model->NOMINA_CONTROLAPB == 1) {
                        return 'Control Onlines / Local';
                    } else {
                        return $model->NOMINA_CONTROLAPB;
                    }
                }
            ],
            [
                'label' => 'Tipo Autenticación',
                'attribute' => 'NOMINA_TIPOID',
            ],
            [
                'label' => 'Medio Aut.',
                'attribute' => 'NOMINA_TIPONOM',
            ],
        ],
    ]) ?>

</div>
