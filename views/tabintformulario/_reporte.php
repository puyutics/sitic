<?php
use yii\helpers\Html;
use yii\helpers\Url;

$fecha = date("Y-m-d H:i:s");
$url = Url::to('@web/uploads/tabintformulario/contrato/', 'https');
$username = Yii::$app->user->identity->username;
$user_profile = \app\models\UserProfile::find()
    ->where(["username" => $username])
    ->one();

?>

<htmlpageheader name="myheader">
    <div style="border-bottom: 1px solid #000000; text-align: center; padding-top: 3mm; ">
        <h3><?= Html::img('images/uea_logo.png',['style' => 'width:40px;height: 40px']); ?>
            <b>UNIVERSIDAD ESTATAL AMAZÓNICA</b></h3>
        <h5><b>Sistema Integrado de Tecnologías de la Información y Comunicación</b></h5>
    </div>
</htmlpageheader>
<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<htmlpagefooter name="myfooter">
    <div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
        Documento generado por el Módulo de Gestión de Recursos Académicos,
        el <?php echo $fecha; ?>  - Pág. {PAGENO} de {nb} - Impreso por <?php echo $user_profile->mail ?>
    </div>
</htmlpagefooter>
<sethtmlpagefooter name="myfooter" value="on" />
<br>
<h4>
    <div align="center">
        <strong>REPORTE DE CONTRATOS DE RECURSOS ACADÉMICOS</strong>
    </div>
</h4>
<br>
<p style="text-align: justify">
    <b>Reporte generado por: <?php echo $user_profile->commonname ?></b>
    <br>
    <b>Correo institucional: <?php echo $user_profile->mail ?></b>
    <br>
    <b>Total de beneficiarios: <?php echo count($tabintformulario) ?></b>
    <br>
    <b>Tipo de reporte: </b>
    <br>
    <b>- Fecha Inicio: </b><?php if ($fecha_inicio == '%') { ?>Todos<?php } ?>
    <?php if ($fecha_inicio != '%') { echo $fecha_inicio; } ?>
    <br>
    <b>- Fecha Fin: </b><?php if ($fecha_fin == '%') { ?>Todos<?php } ?>
    <?php if ($fecha_fin != '%') { echo $fecha_fin; } ?>
    <br>
    <b>- Beneficiario: </b><?php if ($dni == '%') { ?>Todos<?php } ?>
    <?php if ($dni != '%') { echo $tabintformulario[0]->apellidos . ' ' . $tabintformulario[0]->nombres; ?>
        <br>
        <b>- Cédula: </b><?php echo $tabintformulario[0]->cedula; ?>
    <?php } ?>
    <br>
    <b>- Provincia: </b><?php if ($provincia == '%') { ?>Todas<?php } ?>
    <?php if ($provincia != '%') { echo $tabintformulario[0]->provincia; } ?>
    <br>
    <b>- Beneficio: </b><?php if ($beneficio == '%') { ?>Todos<?php } ?>
    <?php if ($beneficio != '%') { echo $tabintformulario[0]->encuesta_beneficiario; } ?>
    <br>
    <b>- Estado: </b><?php if ($status == '%') { ?>Todos<?php } ?>
    <?php if ($status == '1') { echo 'Contrato creado'; } ?>
    <?php if ($status == '2') { echo 'Beneficio Entregado'; } ?>
    <?php if ($status == '3') { echo 'Enviado por Servientrega'; } ?>
    <?php if ($status == '4') { echo 'Enviado Sede El Pangui'; } ?>
    <?php if ($status == '5') { echo 'Enviado Sede Lago Agrio'; } ?>
    <?php if ($status == '6') { echo 'Entregado Sede El Pangui'; } ?>
    <?php if ($status == '7') { echo 'Entregado Sede Lago Agrio'; } ?>
    <br>
</p>
<table width=100% border="1" style="border-collapse:collapse">
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: center">#</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Cédula/Pasaporte</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Beneficiario</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Provincia</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Cantón</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Parroquia</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Beneficio</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Fecha</th>
        <th bgcolor="#EEEEEE" style="text-align: center">QR</th>
    </tr>
    <?php $numero = 1;
    foreach ($tabintformulario as $row)  {
        $dni = $row->cedula;
        $beneficiario = $row->apellidos . ' '
            . $row->nombres;
        $provincia = $row->provincia;
        $canton = $row->canton;
        $parroquia = $row->parroquia;
        $beneficio = $row->encuesta_beneficiario;
        $fec_registro = $row->fec_registro;
        ?>
        <tr>
            <th style="text-align: center"><?= $numero ?></th>
            <th style="text-align: center"><?= $dni ?></th>
            <th style="text-align: center"><?= $beneficiario ?></th>
            <th style="text-align: center"><?= $provincia ?></th>
            <th style="text-align: center"><?= $canton ?></th>
            <th style="text-align: center"><?= $parroquia ?></th>
            <th style="text-align: center"><?= $beneficio ?></th>
            <th style="text-align: center"><?= $fec_registro ?></th>
            <th style="text-align: center">
                <a href=<?php echo $url . $row->doc_contrato?>>
                    <barcode code = "<?php echo $url . $row->doc_contrato ?>"
                             type="QR" class="barcode" size="0.7" error="M" /></a>
            </th>
        </tr>
        <?php $numero++; } ?>
</table>