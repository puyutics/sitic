<?php

/* @var $this yii\web\View */

use kartik\tabs\TabsX;
use yii\helpers\Html;

$this->title = 'Depurar Estudiantes';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestión TI'), 'url' => ['site/management']];
$this->params['breadcrumbs'][] = $this->title;

$groupObject = \Yii::$app->ad->search()->findBy('cn', 'estudiantes');
if ($groupObject != null && $groupObject->exists) {
    $members = $groupObject->getMembers();
}

$estudiantes_descontinuados = \app\models\siad_pregrado\Estudiantes::find()
    ->select(['CIInfPer',
        'cedula_pasaporte',
        'ApellInfPer',
        'ApellMatInfPer',
        'NombInfPer',
        'statusper'
    ])
    ->where(['statusper' => 0])
    ->all();

$estudiantes_habilitados = \app\models\siad_pregrado\Estudiantes::find()
    ->select(['CIInfPer',
        'cedula_pasaporte',
        'ApellInfPer',
        'ApellMatInfPer',
        'NombInfPer',
        'statusper'
    ])
    ->where(['statusper' => 1])
    ->all();

$estudiantes_graduados = \app\models\siad_pregrado\Estudiantes::find()
    ->select(['CIInfPer',
        'cedula_pasaporte',
        'ApellInfPer',
        'ApellMatInfPer',
        'NombInfPer',
        'statusper'
    ])
    ->where(['statusper' => 2])
    ->all();

$estudiantes_inhabilitados = \app\models\siad_pregrado\Estudiantes::find()
    ->select(['CIInfPer',
        'cedula_pasaporte',
        'ApellInfPer',
        'ApellMatInfPer',
        'NombInfPer',
        'statusper'
    ])
    ->where(['statusper' => 3])
    ->all();

$tiempoInicial = microtimeFloat();
?>

<h1 align="center"><?= Html::encode($this->title) ?></h1>

<?php
$total_estudiantes_active_directory = count($members);
$total_estudiantes_habilitados = count($estudiantes_habilitados);
$total_estudiantes_descontinuados = count($estudiantes_descontinuados);
$total_estudiantes_graduados = count($estudiantes_graduados);
$total_estudiantes_inhabilitados = count($estudiantes_inhabilitados);
$ad=0;
$o_ad=0;
$p_ad=0;
$i=0;
$h=0;
$n_i=0;
$ed=0;
$p_ed=0;
$eh=0;
$p_eh=0;
$eg=0;
$p_eg=0;
$ei=0;
$p_ei=0;

?>

<?= '<h3>Usuarios Active Directory</h3>' ?>

<?php foreach ($members as $member)
{
    $dn = $member->getDn();
    $dni = $member->getAttribute(Yii::$app->params['dni'],0);
    if (str_contains($dn,'OU=PREGRADO,OU=ESTUDIANTES,DC=uea,DC=edu,DC=ec')) {
        if (str_contains($dni, ' ')) {
            echo 'Caracter en blanco en cédula: '.$dni;
            echo '<br>';
        }
        $estudiante = \app\models\siad_pregrado\Estudiantes::find()
            ->select(['CIInfPer',
                'cedula_pasaporte',
                'ApellInfPer',
                'ApellMatInfPer',
                'NombInfPer',
                'statusper'
            ])
            ->where(['CIInfPer' => $dni])
            ->orWhere(['cedula_pasaporte' => $dni])
            ->one();
        if ((!isset($estudiante)) or (isset($estudiante) and ($estudiante->statusper != 1))) {
            $ad=$ad+1;
            $sAMAccountname = $member->getAttribute('samaccountname',0);
            $user = \Yii::$app->ad->search()->findBy('sAMAccountname', $sAMAccountname);
            userDisable($estudiante, $user, $ad);
            removeGroups($estudiante, $user);
            moveContainer($estudiante, $user);
        } else {
            verificarADduplicado($dni);
            $p_ad=$p_ad+1;
        }
    } else {
        verificarADduplicado($dni);
        $o_ad=$o_ad+1;
    }
}

?>

<div style="font-size: 9pt; text-align: left;">
    <b>Active Directory - Grupo Estudiantes: <?= $total_estudiantes_active_directory ?></b>
</div>
<div style="font-size: 9pt; text-align: left;">
    <b>Total Otros Contenedores: <?= $o_ad ?></b>
</div>
<div style="font-size: 9pt; text-align: left;">
    <b>Total habilitados: <?= $p_ad ?></b>
</div>
<div style="font-size: 9pt; text-align: left;">
    <b>Total deshabilitados: <?= $ad ?></b>
</div>
<br>


<?= '<h3>Usuarios Habilitados</h3>' ?>

<?php foreach ($estudiantes_habilitados as $estudiante) {
    //Buscar usuario en Active Directory
    $dni = $estudiante->cedula_pasaporte;
    $user = \Yii::$app->ad->search()->findBy(Yii::$app->params['dni'], $dni);
    if (isset($user)) {
        verificarADduplicado($dni);
        $dn = $user->getDn();
        $uac = $user->getUserAccountControl();
        if (str_contains($dn,'OU=PREGRADO,OU=ESTUDIANTES,DC=uea,DC=edu,DC=ec')) {
            if ($uac != 512) {
                $h=$h+1;
                $eh=$eh+1;
                userEnable($estudiante, $user, $h);
                //Chequear carrera y contenedor
                $estudiante_malla_actual = \app\models\siad_pregrado\EstudiantesMalla::find()
                    ->where(['CIInfPer' => $dni])
                    ->orderBy('anio_mallacurricular DESC')
                    ->one();
                $campus = '';
                if ($estudiante_malla_actual->idcarr == 'AGI' or
                    $estudiante_malla_actual->idcarr == 'AGR' or
                    $estudiante_malla_actual->idcarr == 'AMB' or
                    $estudiante_malla_actual->idcarr == 'BLG' or
                    $estudiante_malla_actual->idcarr == 'COM' or
                    $estudiante_malla_actual->idcarr == 'FRT' or
                    $estudiante_malla_actual->idcarr == 'LTUR' or
                    $estudiante_malla_actual->idcarr == 'TUR'
                ) {
                    $campus = 'PUYO';
                } elseif ($estudiante_malla_actual->idcarr == 'BLGEL' or
                    $estudiante_malla_actual->idcarr == 'LTUREL'
                ) {
                    $campus = 'LAGO AGRIO';
                } elseif ($estudiante_malla_actual->idcarr == 'BLGEP' or
                    $estudiante_malla_actual->idcarr == 'LTUREP'
                ) {
                    $campus = 'PANGUI';
                }
                if (str_contains($dn,'OU=ARCHIVO,OU=PREGRADO,OU=ESTUDIANTES,DC=uea,DC=edu,DC=ec')) {
                    addGroups($estudiante, $user, $campus);
                    moveEnableContainer($estudiante, $user, $campus);
                }
                if (!str_contains($dn,$campus)) {
                    removeGroups($estudiante, $user);
                    addGroups($estudiante, $user, $campus);
                    moveEnableContainer($estudiante, $user, $campus);
                }
            } else {
                $p_eh=$p_eh+1;
            }
        }
    } else {
        $n_i=$n_i+1;
        echo $n_i.'. No se encuentra: '.$estudiante->CIInfPer.' - '.$estudiante->cedula_pasaporte.' - '.$estudiante->ApellInfPer.' '.$estudiante->ApellMatInfPer.' '.$estudiante->NombInfPer;
        echo '<br>';
    }
}
?>

<div style="font-size: 9pt; text-align: left;">
    <b>SIAD - Estudiantes habilitados: <?= $total_estudiantes_habilitados ?></b>
</div>
<div style="font-size: 9pt; text-align: left;">
    <b>Total previamente habilitados: <?= $p_eh ?></b>
</div>
<div style="font-size: 9pt; text-align: left;">
    <b>Total habilitados: <?= $eh ?></b>
</div>
<br>

<?php echo '<h3>Usuarios Deshabilitados</h3>';

foreach ($estudiantes_descontinuados as $estudiante) {
    //Buscar usuario en Active Directory
    $dni = $estudiante->cedula_pasaporte;
    $user = \Yii::$app->ad->search()->findBy(Yii::$app->params['dni'], $dni);
    if (isset($user)) {
        verificarADduplicado($dni);
        $dn = $user->getDn();
        $uac = $user->getUserAccountControl();
        if (str_contains($dn,'OU=PREGRADO,OU=ESTUDIANTES,DC=uea,DC=edu,DC=ec')) {
            if ($uac != 514) {
                $i=$i+1;
                $ed=$ed+1;
                userDisable($estudiante, $user, $i);
                removeGroups($estudiante, $user);
                moveContainer($estudiante, $user);
            } else {
                $p_ed=$p_ed+1;
            }
        }
    }
}

foreach ($estudiantes_graduados as $estudiante) {
    //Buscar usuario en Active Directory
    $dni = $estudiante->cedula_pasaporte;
    $user = \Yii::$app->ad->search()->findBy(Yii::$app->params['dni'], $dni);
    if (isset($user)) {
        verificarADduplicado($dni);
        $dn = $user->getDn();
        $uac = $user->getUserAccountControl();
        if (str_contains($dn,'OU=PREGRADO,OU=ESTUDIANTES,DC=uea,DC=edu,DC=ec')) {
            if ($uac != 514) {
                $i=$i+1;
                $eg=$eg+1;
                userDisable($estudiante, $user, $i);
                removeGroups($estudiante, $user);
                moveContainer($estudiante, $user);
            } else {
                $p_eg=$p_eg+1;
            }
        }
    }
}

foreach ($estudiantes_inhabilitados as $estudiante) {
    //Buscar usuario en Active Directory
    $dni = $estudiante->cedula_pasaporte;
    $user = \Yii::$app->ad->search()->findBy(Yii::$app->params['dni'], $dni);
    if (isset($user)) {
        verificarADduplicado($dni);
        $dn = $user->getDn();
        $uac = $user->getUserAccountControl();
        if (str_contains($dn,'OU=PREGRADO,OU=ESTUDIANTES,DC=uea,DC=edu,DC=ec')) {
            if ($uac != 514) {
                $i=$i+1;
                $ei=$ei+1;
                userDisable($estudiante, $user, $i);
                removeGroups($estudiante, $user);
                moveContainer($estudiante, $user);
            } else {
                $p_ei=$p_ei+1;
            }
        }
    }
}

$tiempoFinal = microtimeFloat();
$tiempoEjecucion = round($tiempoFinal - $tiempoInicial,2) . ' segundos';

?>

<div style="font-size: 9pt; text-align: left;">
    <b>SIAD - Estudiantes descontinuados: <?= $total_estudiantes_descontinuados ?></b>
</div>
<div style="font-size: 9pt; text-align: left;">
    <b>Total previamente desactivados: <?= $p_ed ?></b>
</div>
<div style="font-size: 9pt; text-align: left;">
    <b>Total desactivados: <?= $ed ?></b>
</div>
<br>
<div style="font-size: 9pt; text-align: left;">
    <b>SIAD - Estudiantes graduados: <?= $total_estudiantes_graduados ?></b>
</div>
<div style="font-size: 9pt; text-align: left;">
    <b>Total previamente desactivados: <?= $p_eg ?></b>
</div>
<div style="font-size: 9pt; text-align: left;">
    <b>Total desactivados: <?= $eg ?></b>
</div>
<br>
<div style="font-size: 9pt; text-align: left;">
    <b>SIAD - Estudiantes inhabilitados: <?= $total_estudiantes_inhabilitados ?></b>
</div>
<div style="font-size: 9pt; text-align: left;">
    <b>Total previamente desactivados: <?= $p_ei ?></b>
</div>
<div style="font-size: 9pt; text-align: left;">
    <b>Total desactivados: <?= $ei ?></b>
</div>
<br>
<div style="font-size: 9pt; text-align: left;">
    <b>Tiempo: <?= $tiempoEjecucion ?></b>
</div>


<?php function verificarADduplicado($dni) {
    //Verificar si existe usuarios AD duplicados
    $users = Yii::$app->ad->getProvider('default')->search()->users()
        ->orWhereEquals(Yii::$app->params['dni'], $dni)
        ->get();
    if (count($users) > 1) {
        echo 'Duplicado: '.$dni;
        echo '<br>';
    }
} ?>


<?php function userEnable($estudiante, $user, $h) {
    //Activar cuenta Active Directory
    $user->setUserAccountControl(512);
    $user->save();
    echo $h .'. '.$estudiante->cedula_pasaporte.' '.$estudiante->ApellInfPer.' '.$estudiante->ApellMatInfPer.' '.$estudiante->NombInfPer;
    echo '<br>';
} ?>


<?php function moveEnableContainer($estudiante, $user, $campus) {
    //Mover estudiantes al contenedor correspondiente
    if ($campus == 'PUYO') {
        $dn_new = 'OU=PUYO,OU=PREGRADO,OU=ESTUDIANTES,DC=uea,DC=edu,DC=ec';
    }
    if ($campus == 'LAGO AGRIO') {
        $dn_new = 'OU=LAGO AGRIO,OU=PREGRADO,OU=ESTUDIANTES,DC=uea,DC=edu,DC=ec';
    }
    if ($campus == 'PANGUI') {
        $dn_new = 'OU=PANGUI,OU=PREGRADO,OU=ESTUDIANTES,DC=uea,DC=edu,DC=ec';
    }
    if (isset($dn_new)) {
        try {
            $user->move($dn_new);
        } catch (Exception $e) {
            echo 'Error Container: '.$estudiante->cedula_pasaporte.' '.$e->getMessage();
            echo '<br>';
        }
    }
} ?>


<?php function addGroups($estudiante, $user, $campus) {
    //Agregar grupos
    $groupNames = $user->getGroupNames($recursive = true);
    if (count($groupNames)>1) {
        $existGroup = '';
        foreach ($groupNames as $groupName) {
            if ($groupName == 'Microsoft 365 Apps para Estudiantes') {
                $existGroup = 'SI';
            }
        }
        if ($existGroup != 'SI') {
            $groupObject = \Yii::$app->ad->search()->findBy('cn', 'Microsoft 365 Apps para Estudiantes');
            $user->addGroup($groupObject);
        }
        $existGroup = '';
        foreach ($groupNames as $groupName) {
            if ($groupName == 'Power BI (free)') {
                $existGroup = 'SI';
            }
        }
        if ($existGroup != 'SI') {
            $groupObject = \Yii::$app->ad->search()->findBy('cn', 'Power BI (free)');
            $user->addGroup($groupObject);
        }
        $existGroup = '';
        foreach ($groupNames as $groupName) {
            if ($groupName == 'Office 365 A1 para Estudiantes') {
                $existGroup = 'SI';
            }
        }
        if ($existGroup != 'SI') {
            $groupObject = \Yii::$app->ad->search()->findBy('cn', 'Office 365 A1 para Estudiantes');
            $user->addGroup($groupObject);
        }
        $existGroup = '';
        foreach ($groupNames as $groupName) {
            if ($groupName == 'estudiantes') {
                $existGroup = 'SI';
            }
        }
        if ($existGroup != 'SI') {
            $groupObject = \Yii::$app->ad->search()->findBy('cn', 'estudiantes');
            $user->addGroup($groupObject);
        }
        $existGroup = '';
        foreach ($groupNames as $groupName) {
            if ($groupName == '3gm4v0hkup5dx55') {
                $existGroup = 'SI';
            }
        }
        if ($existGroup != 'SI') {
            $groupObject = \Yii::$app->ad->search()->findBy('cn', '3gm4v0hkup5dx55');
            $user->addGroup($groupObject);
        }
        if ($campus == 'PUYO') {
            $existGroup = '';
            foreach ($groupNames as $groupName) {
                if ($groupName == 'pnnfxlrnu8mux5w') {
                    $existGroup = 'SI';
                }
            }
            if ($existGroup != 'SI') {
                $groupObject = \Yii::$app->ad->search()->findBy('cn', 'pnnfxlrnu8mux5w');
                $user->addGroup($groupObject);
            }
        }
        if ($campus == 'LAGO AGRIO') {
            $existGroup = '';
            foreach ($groupNames as $groupName) {
                if ($groupName == 'djga0oexs3jesqu') {
                    $existGroup = 'SI';
                }
            }
            if ($existGroup != 'SI') {
                $groupObject = \Yii::$app->ad->search()->findBy('cn', 'djga0oexs3jesqu');
                $user->addGroup($groupObject);
            }
        }
        if ($campus == 'PANGUI') {
            $existGroup = '';
            foreach ($groupNames as $groupName) {
                if ($groupName == 'ohgs7tioixj8dr4') {
                    $existGroup = 'SI';
                }
            }
            if ($existGroup != 'SI') {
                $groupObject = \Yii::$app->ad->search()->findBy('cn', 'ohgs7tioixj8dr4');
                $user->addGroup($groupObject);
            }
        }
    }
    else {
        $groupObject = \Yii::$app->ad->search()->findBy('cn', 'Microsoft 365 Apps para Estudiantes');
        $user->addGroup($groupObject);
        $groupObject = \Yii::$app->ad->search()->findBy('cn', 'Power BI (free)');
        $user->addGroup($groupObject);
        $groupObject = \Yii::$app->ad->search()->findBy('cn', 'Office 365 A1 para Estudiantes');
        $user->addGroup($groupObject);
        $groupObject = \Yii::$app->ad->search()->findBy('cn', 'estudiantes');
        $user->addGroup($groupObject);
        $groupObject = \Yii::$app->ad->search()->findBy('cn', '3gm4v0hkup5dx55');
        $user->addGroup($groupObject);
        if ($campus == 'PUYO') {
            $groupObject = \Yii::$app->ad->search()->findBy('cn', 'pnnfxlrnu8mux5w');
            $user->addGroup($groupObject);
        }
        if ($campus == 'LAGO AGRIO') {
            $groupObject = \Yii::$app->ad->search()->findBy('cn', 'djga0oexs3jesqu');
            $user->addGroup($groupObject);
        }
        if ($campus == 'PANGUI') {
            $groupObject = \Yii::$app->ad->search()->findBy('cn', 'ohgs7tioixj8dr4');
            $user->addGroup($groupObject);
        }
    }
} ?>


<?php function userDisable($estudiante, $user, $i) {
    //Desactivar cuenta Active Directory
    $user->setUserAccountControl(514);
    $user->save();
    if (isset($estudiante)) {
        echo $i . '. ' . $estudiante->cedula_pasaporte . ' ' . $estudiante->ApellInfPer . ' ' . $estudiante->ApellMatInfPer . ' ' . $estudiante->NombInfPer;
        echo '<br>';
    }
} ?>


<?php function moveContainer($estudiante, $user) {
    $dn = $user->getDn();
    if (str_contains($dn,'OU=PUYO,OU=PREGRADO,OU=ESTUDIANTES,DC=uea,DC=edu,DC=ec')) {
        $dn_new = 'OU=PUYO,OU=ARCHIVO,OU=PREGRADO,OU=ESTUDIANTES,DC=uea,DC=edu,DC=ec';
    }
    if (str_contains($dn,'OU=LAGO AGRIO,OU=PREGRADO,OU=ESTUDIANTES,DC=uea,DC=edu,DC=ec')) {
        $dn_new = 'OU=LAGO AGRIO,OU=ARCHIVO,OU=PREGRADO,OU=ESTUDIANTES,DC=uea,DC=edu,DC=ec';
    }
    if (str_contains($dn,'OU=PANGUI,OU=PREGRADO,OU=ESTUDIANTES,DC=uea,DC=edu,DC=ec')) {
        $dn_new = 'OU=PANGUI,OU=ARCHIVO,OU=PREGRADO,OU=ESTUDIANTES,DC=uea,DC=edu,DC=ec';
    }
    if (isset($dn_new)) {
        try {
            $user->move($dn_new);
        } catch (Exception $e) {
            echo 'Error Container: '.$estudiante->cedula_pasaporte.' '.$e->getMessage();
            echo '<br>';
        }
    }
} ?>


<?php function removeGroups($estudiante, $user) {
    //Eliminar grupos
    $groupNames = $user->getGroupNames($recursive = true);
    if (count($groupNames) > 1) {
        foreach ($groupNames as $groupName) {
            if (($groupName != 'Usuarios del dominio') and ($groupName != 'Usuarios')) {
                $groupObject = \Yii::$app->ad->search()->findBy('cn', $groupName);
                try {
                    $user->removeGroup($groupObject);
                    $user->save();
                } catch (Exception $e) {
                    if (isset($estudiante)) {
                        echo 'Error: [' . count($groupNames) . '] ' . $estudiante->cedula_pasaporte . ' ' . $e->getMessage();
                        echo '<br>';
                    }
                    if (isset($groupNames)) {
                        echo json_encode($groupNames);
                        echo '<br>';
                    }
                }
            }
        }
    }
} ?>


<?php function microtimeFloat() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
} ?>
