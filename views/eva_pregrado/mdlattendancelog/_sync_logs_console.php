<?php

$folder = '/var/www/web_apps/sitic.uea.edu.ec/web/attendance/'.Yii::$app->params['course_code'].'/console_output/';
$url = 'https://www.uea.edu.ec/sitic/attendance/'.Yii::$app->params['course_code'].'/console_output/';
$arrFiles = array();
$handle = opendir($folder);
$i=0;
$add=$del='';

?>

<div align="center">
    <?php if ($handle) {
        while (($entry = readdir($handle)) !== FALSE) {
            $arrFiles[] = $entry;
        }
        arsort($arrFiles);
        foreach ($arrFiles as $filename) {
            $i=$i+1;
            if ($filename != '.' and $filename != '..') {
                if (strpos(file_get_contents($folder.$filename), 'Error') !== false) {
                    echo $i.'. <a href="'.$url.$filename.'" target="_blank">'.$filename.'</a> <code>Error</code><br>';
                } elseif (strpos(file_get_contents($folder.$filename), 'existe') !== false) {
                    echo $i.'. <a href="'.$url.$filename.'" target="_blank">'.$filename.'</a> <code>Fichero existe</code><br>';
                } else {
                    echo $i.'. <a href="'.$url.$filename.'" target="_blank">'.$filename.'</a><br>';
                }
            }
            if ($i == 100) break;
        }
    }
    closedir($handle); ?>
</div>