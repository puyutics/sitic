<?php

$output = shell_exec('php /var/www/web_apps/sitic.uea.edu.ec/yii cron/siad2eva');
print_r($output);
