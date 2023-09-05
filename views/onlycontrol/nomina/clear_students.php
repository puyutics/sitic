<?php

/* @var $this yii\web\View */

use kartik\tabs\TabsX;
use yii\helpers\Html;

$this->title = 'Onlycontrol - Depurar Estudiantes';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestión TI'), 'url' => ['site/management']];
$this->params['breadcrumbs'][] = $this->title;

//DB Connections
$siad_connection = Yii::$app->get('db_siad');

//Estudiantes habilitados
$siad_command = $siad_connection->createCommand("
    SELECT
            ipe.cedula_pasaporte,
            ipe.ApellInfPer,
            ipe.ApellMatInfPer,
            ipe.NombInfPer,
            ipe.mailInst,
            ipe.FechNacimPer,
            m.idCarr
    FROM
            notasalumnoasignatura naa,
            matricula m,
            informacionpersonal ipe
    WHERE
            naa.idPer = ".Yii::$app->params['siad_periodo']."
            AND naa.idAsig NOT LIKE 'UEA-L-%'
            AND naa.retirado = 0
            AND naa.anulada = 0
            AND m.idMatricula = naa.idMatricula
            AND m.idCarr NOT LIKE '%EL'
            AND m.idCarr NOT LIKE '%EP'
            AND m.statusMatricula = 'APROBADA'
            AND ipe.CIInfPer = naa.CIInfPer
            AND ipe.mailInst LIKE '%@uea.edu.ec'
            AND ipe.statusper = 1
    GROUP BY
            naa.CIInfPer
    ORDER BY
            ipe.cedula_pasaporte ASC
            ");
$estudiantes_habilitados = $siad_command->queryAll();
$total_estudiantes_habilitados = count($estudiantes_habilitados);

//Estudiantes inhabilitados

$siad_command = $siad_connection->createCommand("
    SELECT
            ipe.cedula_pasaporte
    FROM
            informacionpersonal ipe
    WHERE
            ipe.statusper <> 1
            AND ipe.mailInst LIKE '%@uea.edu.ec'
    ORDER BY
            ipe.cedula_pasaporte ASC
            ");
$estudiantes_inhabilitados = $siad_command->queryAll();
$total_estudiantes_inhabilitados = count($estudiantes_inhabilitados);

//OnlyControl Usuarios Nómina
$usuarios_nomina = \app\models\onlycontrol\Nomina::find()
    ->select('NOMINA_ID')
    ->all();
$total_usuarios_nomina = count($usuarios_nomina);

$tiempoInicial = microtimeFloat();
?>

<h1 align="center"><?= Html::encode($this->title) ?></h1>
<hr>

<?php

print_r('Total usuario onlycontrol: '.$total_usuarios_nomina.'<br>');
print_r('Total estudiantes habilitados: '.$total_estudiantes_habilitados.'<br>');
print_r('Total estudiantes inhabilitados: '.$total_estudiantes_inhabilitados.'<br>');


?>


<?= '<h3>Usuarios Habilitados</h3>' ?>

<?php $i=0;
foreach ($estudiantes_habilitados as $estudiante) {
    $i+=1;
    $dni = $estudiante['cedula_pasaporte'];
    $oc_nomina = \app\models\onlycontrol\Nomina::find()
        ->where(['NOMINA_COD' => $dni])
        ->one();
    if (isset($oc_nomina)) {
        print_r($i.'. NOMINA_ID: '.$oc_nomina->NOMINA_ID.' >> '.$dni.' >> El Registro ya ha sido creado correctamente <br>');
    } else {
        //Consultar NOMINA_ID
        $oc_nomina = \app\models\onlycontrol\Nomina::find()
            ->select('NOMINA_ID')
            ->andWhere(['<>','NOMINA_ID','999999'])
            ->andWhere(['<>','NOMINA_ID','999998'])
            ->andWhere(['<>','NOMINA_ID','009999'])
            ->orderBy('NOMINA_ID DESC')
            ->one();
        //CREAR NUEVO USUARIO NOMINA ONLYCONTROL
        $nomina_create = New \app\models\onlycontrol\Nomina();
        $fecha_actual = date('Ymd 00:00:00.000');
        $nomina_id = ($oc_nomina->NOMINA_ID)+1;
        if (strlen($nomina_id) == 1) $nomina_id_string = '00000'.$nomina_id;
        if (strlen($nomina_id) == 2) $nomina_id_string = '0000'.$nomina_id;
        if (strlen($nomina_id) == 3) $nomina_id_string = '000'.$nomina_id;
        if (strlen($nomina_id) == 4) $nomina_id_string = '00'.$nomina_id;
        if (strlen($nomina_id) == 5) $nomina_id_string = '0'.$nomina_id;
        $nomina_create->NOMINA_ID = $nomina_id_string;
        $nomina_create->NOMINA_APE = $estudiante['ApellInfPer'].' '.$estudiante['ApellMatInfPer'];
        $nomina_create->NOMINA_NOM = $estudiante['NombInfPer'];
        $nomina_create->NOMINA_CLAVE = NULL;
        $nomina_create->NOMINA_COD = $estudiante['cedula_pasaporte'];
        $nomina_create->NOMINA_TIPO = 'USUARIO';
        $nomina_create->NOMINA_CAL = 114;
        $nomina_create->NOMINA_AREA = 8;
        if ($estudiante['idCarr']=='AGI') $nomina_create->NOMINA_DEP = 39;
        if ($estudiante['idCarr']=='AGR') $nomina_create->NOMINA_DEP = 40;
        if ($estudiante['idCarr']=='AMB') $nomina_create->NOMINA_DEP = 41;
        if ($estudiante['idCarr']=='BLG') $nomina_create->NOMINA_DEP = 42;
        if ($estudiante['idCarr']=='COM') $nomina_create->NOMINA_DEP = 43;
        if ($estudiante['idCarr']=='FRT') $nomina_create->NOMINA_DEP = 44;
        if ($estudiante['idCarr']=='LTUR') $nomina_create->NOMINA_DEP = 45;
        $nomina_create->NOMINA_CAL1 = 'ESTUDIANTE';
        $nomina_create->NOMINA_AREA1 = 'UEA - ESTUDIANTES';
        if ($estudiante['idCarr']=='AGI') $nomina_create->NOMINA_DEP1 = 'AGROINDUSTRIAS';
        if ($estudiante['idCarr']=='AGR') $nomina_create->NOMINA_DEP1 = 'AGROPECUARIA';
        if ($estudiante['idCarr']=='AMB') $nomina_create->NOMINA_DEP1 = 'AMBIENTAL';
        if ($estudiante['idCarr']=='BLG') $nomina_create->NOMINA_DEP1 = 'BIOLOGIA';
        if ($estudiante['idCarr']=='COM') $nomina_create->NOMINA_DEP1 = 'COMUNICACION';
        if ($estudiante['idCarr']=='FRT') $nomina_create->NOMINA_DEP1 = 'FORESTAL';
        if ($estudiante['idCarr']=='LTUR') $nomina_create->NOMINA_DEP1 = 'TURISMO';
        $nomina_create->NOMINA_FING = date('Ymd 00:00:00.000');
        $fechNacimPer = strtotime($estudiante['FechNacimPer']);
        $nomina_create->NOMINA_FSAL = date('Ymd 00:00:00.000', $fechNacimPer);
        $nomina_create->NOMINA_SUEL = NULL;
        $nomina_create->NOMINA_COM = NULL;
        $nomina_create->NOMINA_AUTI = NULL;
        $nomina_create->NOMINA_ES = -1;
        $nomina_create->NOMINA_OBS = $estudiante['mailInst'];
        $nomina_create->NOMINA_EMP = 3;
        $nomina_create->NOMINA_FINGER = 64;
        $nomina_create->NOMINA_F1 = NULL;
        $nomina_create->NOMINA_CED = NULL;
        $nomina_create->NOMINA_FIR = NULL;
        $nomina_create->NOMINA_HD1 = NULL;
        $nomina_create->NOMINA_HF1 = NULL;
        $nomina_create->NOMINA_HI1 = NULL;
        $nomina_create->NOMINA_HD2 = NULL;
        $nomina_create->NOMINA_HF2 = NULL;
        $nomina_create->NOMINA_HI2 = NULL;
        $nomina_create->NOMINA_SEL = 0;
        $nomina_create->NOMINA_EMPC = NULL;
        $nomina_create->NOMINA_EMPE = NULL;
        $nomina_create->NOMINA_P1 = 0;
        $nomina_create->NOMINA_P2 = 0;
        $nomina_create->NOMINA_P3 = 0;
        $nomina_create->NOMINA_P4 = 0;
        $nomina_create->NOMINA_P5 = 0;
        $nomina_create->NOMINA_P6 = 0;
        $nomina_create->NOMINA_P7 = 0;
        $nomina_create->NOMINA_P8 = 0;
        $nomina_create->NOMINA_P9 = 0;
        $nomina_create->NOMINA_P10 = 0;
        $nomina_create->NOMINA_P11 = 0;
        $nomina_create->NOMINA_P12 = 0;
        $nomina_create->NOMINA_P13 = 0;
        $nomina_create->NOMINA_P14 = 0;
        $nomina_create->NOMINA_P15 = 0;
        $nomina_create->NOMINA_P16 = 0;
        $nomina_create->NOMINA_P17 = 0;
        $nomina_create->NOMINA_P18 = 0;
        $nomina_create->NOMINA_P19 = 0;
        $nomina_create->NOMINA_P20 = 0;
        $nomina_create->NOMINA_DOC = NULL;
        $nomina_create->NOMINA_PLA = NULL;
        $nomina_create->NOMINA_F = 0;
        $nomina_create->NOMINA_CARD = NULL;
        $nomina_create->NOMINA_FCARD = date('Ymd 00:00:00.000', strtotime($fecha_actual."+ 1 year"));
        $nomina_create->NOMINA_OBS1 = NULL;
        $nomina_create->NOMINA_NOW = date('Ymd H:i:s.000');
        $nomina_create->NOMINA_CAFE = NULL;
        $nomina_create->NOMINA_AUTO = NULL;
        $nomina_create->NOMINA_P21 = 0;
        $nomina_create->NOMINA_P22 = 0;
        $nomina_create->NOMINA_P23 = NULL;
        $nomina_create->NOMINA_P24 = NULL;
        $nomina_create->NOMINA_P25 = NULL;
        $nomina_create->NOMINA_CONTROLAPB = 0;
        $nomina_create->NOMINA_STATUSAPB = 0;
        $nomina_create->NOMINA_CAFEMENU = NULL;
        $nomina_create->NOMINA_LEVEL = 5;
        $nomina_create->NOMINA_TIPOID = 'FA';
        $nomina_create->NOMINA_TIPONOM = 'ROSTRO';
        $nomina_create->NOMINA_HS1 = NULL;
        $nomina_create->NOMINA_HS2 = NULL;
        $nomina_create->NOMINA_CAFECONTROL = 0;
        $nomina_create->NOMINA_SERV1 = 0;
        $nomina_create->NOMINA_SERV2 = 0;
        $nomina_create->NOMINA_SERV3 = 0;
        $nomina_create->NOMINA_SERV4 = 0;
        $nomina_create->NOMINA_SERV5 = 0;
        $nomina_create->NOMINA_SERV6 = 0;
        $nomina_create->NOMINA_SERV7 = 0;
        $nomina_create->NOMINA_SERV8 = 0;
        $nomina_create->NOMINA_SERV9 = 0;
        $nomina_create->NOMINA_CARDKEY = 'U<-$';
        $nomina_create->NOMINA_TIPO_REGISTRO = 1;
        $nomina_create->NOMINA_HWSQ1 = NULL;
        $nomina_create->NOMINA_HWSQ2 = NULL;
        $nomina_create->NOMINA_FACE = NULL;
        $nomina_create->NOMINA_FACE_LEN = NULL;
        $nomina_create->B_MATCHER_FLAG = 0;
        $nomina_create->NOMINA_P26 = NULL;
        $nomina_create->NOMINA_KEY_CONSULT = NULL;
        $nomina_create->NOMINA_P27 = NULL;
        $nomina_create->NOMINA_ADMIN_BIO = 0;
        if ($nomina_create->save(false)) {
            //Agregar log al servidor OnlyControl
            $puerta_sta_create = New \app\models\onlycontrol\PuertaSta();
            $puerta_sta_create->P_ID = \app\models\User::obtenerip();
            $puerta_sta_create->P_Fecha = $nomina_create->NOMINA_NOW;
            $puerta_sta_create->P_Status = 'Crea Modifica Empleado:'.$nomina_create->NOMINA_ID;
            $puerta_sta_create->P_User = '999998';
            $puerta_sta_create->P_Maq = 'sitic';
            $puerta_sta_create->save();
            print_r($i.'. NOMINA_ID: '.$nomina_create->NOMINA_ID.' >> '.$dni.' >> Se ha creado un nuevo registro correctamente <br>');
        } else {
            print_r($i.'. '.$dni.' >> No existe. <code>Error al crear el registro</code> <br>');
        }
        //print_r();
    }
    //if ($i==1) break;
}
?>
<br>
<?php echo '<h3>Usuarios Deshabilitados</h3>';

foreach ($estudiantes_inhabilitados as $estudiante) {
    $dni = $estudiante['cedula_pasaporte'];
    print_r($dni.'<br>');
    break;
}

$tiempoFinal = microtimeFloat();
$tiempoEjecucion = round($tiempoFinal - $tiempoInicial,2) . ' segundos';

?>
<br>
<div style="font-size: 9pt; text-align: left;">
    <b>Tiempo: <?= $tiempoEjecucion ?></b>
</div>

<?php function microtimeFloat() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
} ?>
