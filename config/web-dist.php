<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$db_biometrico = require __DIR__ . '/db_biometrico.php';
$db_bservicios = require __DIR__ . '/db_bservicios.php';
$db_sisges = require __DIR__ . '/db_sisges.php';
$db_siad = require __DIR__ . '/db_siad.php';
$db_siad_nivelacion = require __DIR__ . '/db_siad_nivelacion.php';
$db_siad_posgrado = require __DIR__ . '/db_siad_posgrado.php';
$db_eva_pregrado = require __DIR__ . '/db_eva_pregrado.php';
use kartik\mpdf\Pdf;

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
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module',
        ],
        'pdfjs' => [
            'class' => '\yii2assets\pdfjs\Module',
        ],
        'treemanager' =>  [
            'class' => '\kartik\tree\Module',
        ]
    ],
    'components' => [
        'session' => [
            // this is the name of the session cookie
            'name' => 'sitic',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            //https://passwordsgenerator.net/
            'cookieValidationKey' => 'ENTER COOKIE KEY HERE',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            //'identityClass' => 'app\models\User',
            //'enableAutoLogin' => true,
            'identityClass' => 'Edvlerblog\Adldap2\model\UserDbLdap',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class'          => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            //'useFileTransport' => true,
            'transport'      => [
                'class'      => 'Swift_SmtpTransport',
                'host'       => 'smtp.dominio.com',
                'username'   => 'identidad@dominio.com',
                'password'   => '',
                'port'       => '587',
                'encryption' => 'tls',
            ],
        ],
        'mailerSitic' => [
            'class'          => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            //'useFileTransport' => true,
            'transport'      => [
                'class'      => 'Swift_SmtpTransport',
                'host'       => 'smtp.dominio.com',
                'username'   => 'sitic@dominio.com',
                'password'   => '',
                'port'       => '587',
                'encryption' => 'tls',
            ],
        ],
        'mailerListas' => [
            'class'          => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            //'useFileTransport' => true,
            'transport'      => [
                'class'      => 'Swift_SmtpTransport',
                'host'       => 'smtp.dominio.com',
                'username'   => 'listas@dominio.com',
                'password'   => '',
                'port'       => '587',
                'encryption' => 'tls',
            ],
        ],
        'mailerComunicados' => [
            'class'          => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            //'useFileTransport' => true,
            'transport'      => [
                'class'      => 'Swift_SmtpTransport',
                'host'       => 'smtp.dominio.com',
                'username'   => 'comunicados@dominio.com',
                'password'   => '',
                'port'       => '587',
                'encryption' => 'tls',
            ],
        ],
        'mailerRoles' => [
            'class'          => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            //'useFileTransport' => true,
            'transport'      => [
                'class'      => 'Swift_SmtpTransport',
                'host'       => 'smtp.dominio.com',
                'username'   => 'roles@dominio.com',
                'password'   => '',
                'port'       => '587',
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
        'db_biometrico' => $db_biometrico,
        'db_bservicios' => $db_bservicios,
        'db_sisges' => $db_sisges,
        'db_siad' => $db_siad,
        'db_siad_nivelacion' => $db_siad_nivelacion,
        'db_siad_posgrado' => $db_siad_posgrado,
        'db_eva_pregrado' => $db_eva_pregrado,
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
                        'hosts' => [
                            'ipaddress',
                            'dominio.com',
                        ],
                        'account_suffix'      => '@dominio.com',
                        'base_dn'             => 'dc=dominio,dc=com',
                        'username'            => 'administrador@dominio.com',
                        'password'            => '',
                        'port'                => 636,
                        'use_ssl'             => true,
                        'use_tls'             => true,
                    ],
                ],
            ],

        ],

        // setup Krajee Pdf component
        'pdf' => [
            'class' => Pdf::classname(),
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            // refer settings section for all configuration options
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
