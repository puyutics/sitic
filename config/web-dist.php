<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'SITIC',
    'language' => 'es-us',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            //http://www.sethcardoza.com/tools/random-password-generator/
            'cookieValidationKey' => 'EoFgS2DJuEY1HgxpzSwuq8rrDUNZ4bUEiVTAC5fl',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'user' => [
            //'identityClass' => 'app\models\User',
            'identityClass' => 'Edvlerblog\Adldap2\model\UserDbLdap',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            //'useFileTransport' => true,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.dominio.com',
                'username' => 'usuario@dominio.com',
                'password' => '',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */


        //Adldap2 Config
        //Para activar protocolo SSL/TLS en Active Directory, lea el siguiente enlace:
        //https://docs.microsoft.com/es-es/windows-server/networking/core-network-guide/cncg/server-certs/install-the-certification-authority
        'ad' => [
            'class' => 'Edvlerblog\Adldap2\Adldap2Wrapper',
            'providers' => [
                'default' => [
                    'autoconnect' => true,
                    'config' => [
                        'domain_controllers' => [
                            'dominio.com',
                            'ipaddress',
                        ],
                        'account_suffix'      => '@dominio.com',
                        'base_dn'             => 'dc=dominio,dc=com',
                        'admin_username'      => 'administrador',
                        'admin_password'      => '',
                        'port'                => 636,
                        'use_ssl'             => true,
                        'use_tls'             => true,
                    ],
                ],
            ],

        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}



//Adldap2 Conexión SSL/TLS sin comprobar certificado
putenv('LDAPTLS_REQCERT=never');

return $config;