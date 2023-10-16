<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $model yii\web\View */

$dni = $model->dni;
$mail = $model->mail;

//Sin resultados para Buzones compartidos
if ($dni == '2002' and $mail != 'soporte@uea.edu.ec') {
    $dni = NULL;
}

//Buscar usuario en Parking Control
$oc_user = \app\models\parkingcontrol\Nomina::find()
    ->where(['NOMINA_COD' => $dni])
    ->one();

if (isset($oc_user)) {
    $oc_user_id = $oc_user->NOMINA_ID;
} else {
    $oc_user_id = NULL;
}

$searchModelNomPuerta = new \app\models\parkingcontrol\NomPuertaSearch();
$dataProviderNomPuerta = $searchModelNomPuerta->search(Yii::$app->request->queryParams);
$dataProviderNomPuerta->query->Where(['NOM_ID' => $oc_user_id]);
$dataProviderNomPuerta->sort->defaultOrder = ['PUER_ID' => SORT_ASC,];
$countDataProvider = $dataProviderNomPuerta->getTotalCount();
$dataProviderNomPuerta->pagination = ['pageSize' => $countDataProvider];
?>
<div class="nom-puerta-index">

    <?php if (!isset($oc_user)) { ?>
        <div class="alert alert-info" align="center">
            <h3 align="center">No existe información</h3>
        </div>
    <?php } else { ?>
        <div class="alert alert-info" align="center">
            <h3 align="center"><?= 'PLACA: '.$oc_user->NOMINA_PLACA ?></h3>
            <h3 align="center"><?= $oc_user->NOMINA_APE .' '. $oc_user->NOMINA_NOM ?></h3>
            <h4 align="center" style="color:palevioletred">Tipo: <?= $oc_user->NOMINA_TIPO ?></h4>
            <h4 align="center" style="color:palevioletred">Cédula: <?= $oc_user->NOMINA_COD ?></h4>
            <h4 align="center" style="color:palevioletred">TAG / RF: <?= $oc_user->NOMINA_CARD ?></h4>
            <h4 align="center" style="color:palevioletred">Código: <?= $oc_user->NOMINA_ID ?></h4>
            <?= Html::a(Icon::show('car') . 'Vehículo',
                ['parkingcontrol/nomina/profile', 'oc_user_id'=>base64_encode($oc_user_id)],
                ['class' => 'btn btn-primary','target' => '_blank']
            ); ?>
            <?= Html::a(Icon::show('parking') . 'Barreras',
                ['parkingcontrol/nompuerta/indexuser', 'oc_user_id'=>base64_encode($oc_user_id)],
                ['class' => 'btn btn-primary','target' => '_blank']
            ); ?>
            <?= Html::a(Icon::show('fingerprint') . 'Accesos',
                ['parkingcontrol/asistnow/indexuser', 'oc_user_id'=>base64_encode($oc_user_id)],
                ['class' => 'btn btn-primary','target' => '_blank']
            ); ?>
            <?= Html::a(Icon::show('clipboard-list') . 'Logs',
                ['parkingcontrol/puertasta/indexuser', 'oc_user_id'=>base64_encode($oc_user_id)],
                ['class' => 'btn btn-success','target' => '_blank']
            ); ?>
        </div>
    <?php } ?>

    <div class="col-sm-offset-0 col-sm-12">
        <?php echo TabsX::widget([
            'position' => TabsX::POS_ABOVE,
            'align' => TabsX::ALIGN_CENTER,
            'sideways'=>false,
            'bordered'=>false,
            'encodeLabels'=>false,
            'enableStickyTabs' => true,
            'items' => [
                [
                    'label' => Icon::show('parking').' Barreras Activas',
                    'content' => $this->render('../parkingcontrol/nompuerta/index_user_nom_puerta', [
                        'oc_user_id' => $oc_user_id,
                    ])
                ],
                /*[
                    'label' => Icon::show('door-closed').' Barreras Revocadas',
                    'content' => $this->render('../parkingcontrol/nompuerta/index_user_nom_puertadel', [
                        'oc_user_id' => $oc_user_id,
                    ])
                ],*/
                /*[
                    'label' => Icon::show('clipboard-list').' Auditoría',
                    'content' => $this->render('../parkingcontrol/nompuerta/index_user_nom_puertalog', [
                        'oc_user_id' => $oc_user_id,
                    ])
                ],*/
            ],
        ]); ?>
    </div>

</div>
