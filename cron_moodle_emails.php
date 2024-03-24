<?php

$output = shell_exec('php /var/www/web_apps/sitic.uea.edu.ec/yii cron/moodle_emails');
print_r($output);
