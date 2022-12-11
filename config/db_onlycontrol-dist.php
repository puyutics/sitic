<?php

//Documentación de ayuda
//https://www.yiiframework.com/doc/guide/2.0/es/db-dao
//https://learn.microsoft.com/es-mx/sql/connect/odbc/linux-mac/installing-the-microsoft-odbc-driver-for-sql-server?view=sql-server-ver16
//https://learn.microsoft.com/es-mx/sql/connect/php/installation-tutorial-linux-mac?view=sql-server-ver16#testing-your-installation

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'sqlsrv:Server=localhost;Database=ONLYCONTROL',
    'username' => 'sa',
    'password' => '',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
