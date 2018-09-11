<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\ipinfo\IpInfo;
use kartik\popover\PopoverX;

$this->title = 'Sistema Integrado';
//$this->params['breadcrumbs'][] = $this->title;
?>

<?php if (isset(Yii::$app->user->identity->username)
    and (Yii::$app->session->get('authtype') == 'adldap')) {
    $user = Yii::$app->ad->getProvider('default')->search()->findBy('sAMAccountname', Yii::$app->user->identity->username);
    $today = strtotime(date('Y-m-d H:i:s'));
    $lastSetPassword = strtotime($user->getPasswordLastSetDate());
    $diff = round(($today - $lastSetPassword)/86400);
} ?>

<div class="site-index">
    <div align="center">

        <h7><p class="lead"><b>Cédula: </b><?php echo $user->getAttribute(Yii::$app->params['dni'],0);?></p></h7>
        <h7><p class="lead"><b>Nombres: </b><?php echo $user->getFirstName();?></p></h7>
        <h7><p class="lead"><b>Apellidos: </b><?php echo $user->getLastName();?></p></h7>
        <h7><p class="lead"><b>Nombre completo: </b><?php echo $user->getCommonName();?></p></h7>
        <h7><p class="lead"><b>Nombre para mostrar: </b><?php echo $user->getDisplayName();?></p></h7>
        <h7><p class="lead"><b>Email institucional: </b><?php echo $user->getEmail();?></p></h7>
        <h7><p class="lead"><b>Email personal: </b><?php echo $user->getAttribute(Yii::$app->params['personalmail'],0);?></p></h7>
        <h7><p class="lead"><b>Celular: </b><?php echo $user->getAttribute(Yii::$app->params['mobile'],0);?></p></h7>
        <h7><p class="lead"><b>Último Cambio de Contraseña: </b><?php echo $diff . ' días (' . $user->getPasswordLastSetDate() . ')';?></p></h7>
        <h7><p class="lead"><b>IP: </b><?php echo Yii::$app->request->userIP;?></p></h7>

        <a class="btn btn-lg btn-primary" href="./index.php?r=adldap/edit">Editar datos usuario</a>
        <a class="btn btn-lg btn-primary" href="./index.php?r=adldap/password">Cambiar Contraseña</a>
    </div>
</div>
