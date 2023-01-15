<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\NomPuertaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gestión Puertas (Usuario)';
$this->params['breadcrumbs'][] = $this->title;

//Buscar usuario en Onlycontrol
$oc_user_id = base64_decode($_GET['oc_user_id']);
$oc_user = \app\models\onlycontrol\Nomina::find()
    ->where(['NOMINA_ID' => $oc_user_id])
    ->one();

if (isset($oc_user)) {
    $oc_user_admin_bio = $oc_user->NOMINA_ADMIN_BIO;
}

?>
<div class="nom-puerta-index">

    <?php if (!isset($oc_user)) { ?>
        <div class="alert alert-info" align="center">
            <h3 align="center">No existe información</h3>
        </div>
    <?php } else { ?>
        <div class="alert alert-info" align="center">
            <h3 align="center"><?= $this->title ?></h3>
            <h3 align="center"><?= $oc_user->NOMINA_APE .' '. $oc_user->NOMINA_NOM ?></h3>
            <h4 align="center" style="color:palevioletred">Tipo: <?php if ($oc_user_admin_bio == 1) echo 'Administrador'; else echo 'Usuario'; ?></h4>
            <h4 align="center" style="color:palevioletred">Cédula: <?= $oc_user->NOMINA_COD ?></h4>
            <h4 align="center" style="color:palevioletred">Código: <?= $oc_user->NOMINA_ID ?></h4>
            <?= Html::a(Icon::show('plus'). ' Puerta ' .Icon::show('door-closed'),
                ['onlycontrol/nompuerta/create', 'oc_user_id'=>base64_encode($oc_user_id)],
                ['class' => 'btn btn-success']
            ); ?>
        </div>

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
                        'label' => Icon::show('door-closed').' Puertas Activas',
                        'content' => $this->render('index_user_nom_puerta', [
                            'oc_user_id' => $oc_user_id,
                        ])
                    ],
                    [
                        'label' => Icon::show('door-closed').' Puertas Revocadas',
                        'content' => $this->render('index_user_nom_puertadel', [
                            'oc_user_id' => $oc_user_id,
                        ])
                    ],
                    [
                        'label' => Icon::show('clipboard-list').' Auditoría',
                        'content' => $this->render('index_user_nom_puertalog', [
                            'oc_user_id' => $oc_user_id,
                        ])
                    ],
                ],
            ]); ?>
        </div>
    <?php } ?>

</div>
