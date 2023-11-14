<?php

echo('UEA | Módulo de pruebas para el consumo de datos DINARP<br>');

echo '<br>';
echo 'IP Cliente: ' . $_SERVER['REMOTE_ADDR'] . '<br>';
echo 'IP Servidor: ' . $_SERVER['SERVER_ADDR'] . '<br>';
echo '<br>';

if (isset($_GET['dni'])) {
    $dni = $_GET['dni']; ?>

    <?php $api_url = Yii::$app->params['api_url_biometrico'].$dni;
    $api_token = Yii::$app->params['api_token']; ?>

    <?php $response = \app\models\Dinarp::biometrico($api_url, $api_token);
    if ($response === false) {
        echo 'Error en la solicitud cURL';
    } else {
        $data = json_decode($response, true);
        if ($data === null) {
            echo 'Error al decodificar JSON.';
        } else {
            $i = 0;
            foreach ($data as $key => $val) {
                $i = $i + 1;
                echo $i . '. ' . $key . " : " . $val . "<br><br>";
                $foto = base64_decode($val);
                $finfo    = new finfo(FILEINFO_MIME);
                $mimeType = $finfo->buffer($foto);
                $mimeType = explode('; ',$mimeType);
                $mimeType = $mimeType[0];
                echo '<img style="border:1px solid black;" height="100%" src="data:'.$mimeType.';base64,'.base64_encode($foto).'"/>';
            }
        }
    } ?>

<?php } else {
    echo 'Falta el parámetro DNI';
} ?>
