<?php

use yii\helpers\Html;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\NomPuerta */

$this->title = 'Revocar acceso';
$this->params['breadcrumbs'][] = ['label' => 'Nom Puertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$oc_user_id = base64_decode($_GET['oc_user_id']);
$oc_puerta_id = base64_decode($_GET['oc_puerta_id']);


//Buscar usuario en Onlycontrol
$oc_user = \app\models\onlycontrol\Nomina::find()
    ->where(['NOMINA_ID' => $oc_user_id])
    ->one();

if (isset($oc_user)) {
    $oc_user_admin_bio = $oc_user->NOMINA_ADMIN_BIO;
}

$puerta = \app\models\onlycontrol\Puerta::find()
    ->where(['PRT_COD' => $oc_puerta_id])
    ->one();

?>
<div class="nom-puerta-create">

    <div class="alert alert-warning" align="center">
        <h2 align="center"><?= $this->title .' '. Icon::show('door-closed') ?></h2>
        <h3 align="center"><?= $oc_user->NOMINA_APE .' '. $oc_user->NOMINA_NOM ?></h3>
        <h4 align="center" style="color:palevioletred">Tipo: <?php if ($oc_user_admin_bio == 1) echo 'Administrador'; else echo 'Usuario'; ?></h4>
        <h4 align="center" style="color:palevioletred">Cédula: <?= $oc_user->NOMINA_COD ?></h4>
        <h4 align="center" style="color:palevioletred">Código: <?= $oc_user->NOMINA_ID ?></h4>
    </div>

    <div align="center">
        <h4 align="center">Puerta: <code><?= $puerta->getDatosCompletos() ?></code></h4>
    </div>

    <?= $this->render('_revoca', [
        'model' => $model,
    ]) ?>

</div>
