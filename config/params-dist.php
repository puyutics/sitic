<?php

return [

    //Atributos Personalizados de Active Directory o LDAP
    'dni'          => 'dni',
    'personalmail' => 'personalmail',
    'mobile'       => 'mobile',

    //Para agregar los atributos personalizados en Active Directory lea los siguientes enlaces:
    //https://windowserver.wordpress.com/2014/10/09/active-directory-agregar-atributos-personalizados/
    //https://www.solvetic.com/tutoriales/article/4340-anadir-atributos-personalizados-directorio-activo-windows-server-2016/

    //Tipo de inicio de sesión: username, userPrincipalName o mail
    // 'login' => 'username',
    // 'login' => 'userPrincipalName',
    // 'login' => 'mail',
    'login' => 'username',

    //Parámetros Personalizados de la Companía, Empresa o Institución
    'company'    => 'Nombre de la Empresa',
    'adminEmail' => 'admin@dominio.com', //Cuenta para recibir correo del formulario de contacto.
    'appURL'     => 'http://sitic.dominio.com/',
    'contact'    => 'Unidad de TI. Contáctese al (+593) 3-2555-555 de lunes a viernes, en horario de atención 08h00 - 17h00.',

    //ADldap2 options
    'LDAP-User-Sync-Options' => [
        'ON_LOGIN_CREATE_USER' => true,
        'ON_LOGIN_REFRESH_GROUP_ASSIGNMENTS' => false,
        'ON_LOGIN_REFRESH_LDAP_ACCOUNT_STATUS' => true,
        'ON_REQUEST_REFRESH_LDAP_ACCOUNT_STATUS' => false,
    ],
    /*'LDAP-Group-Assignment-Options' => [
        'LOGIN_POSSIBLE_WITH_ROLE_ASSIGNED_MATCHING_REGEX' => "/^(yii2|app)(.*)/", // a role has to be assign, which is starting with yii2 or with app
        'REGEX_GROUP_MATCH_IN_LDAP' => "/^(yii2|app)(.*)/", // Active Directory groups beginning with yii2 or app ar filtered and if a yii2 role with the same name exists the role would be added to the user
        'ADD_GROUPS_FROM_LDAP_MATCHING_REGEX' => true, //add matches between groups and roles to the user
        'REMOVE_ALL_GROUPS_NOT_FOUND_IN_LDAP' => false,
        'REMOVE_ONLY_GROUPS_MATCHING_REGEX' => true, //Only remove groups matching regex REGEX_GROUP_MATCH_IN_LDAP
        'SEARCH_NESTED_GROUPS' => false,
    ],*/

    //Parámetros Personalizados Email Sender Gestión de identidad
    'from'     => 'usuario@dominio.com',
    'fromName' => 'Sistema de Gestión de Identidad',
    'cc'       => 'usuario@dominio.com', //Opción para almacenar copias de Emails Enviados
    'subject'  => 'Restablecer Contraseña',


    //Generar un Código de Seguridad (SaltKey) en el siguiente enlace
    //http://www.sethcardoza.com/tools/random-password-generator/
    //Tested -> 40 Characters Long (Good for Cakephp Security Salt)
    'saltKey'         => 'ENTER SALTKEY HERE',
    'algorithm'       => 'sha256',
    'tokenDateFormat' => date('Y-m-d'), //Duración de token en fecha actual desde 00:00 hasta 23:59

    //IPinfo - Logs Module
    //Generate a new AccessKey for you
    'ipInfoAccessKey' => 'ENTER IPINFOKEY HERE',

    //Google Analytics CODE
    'ga-code'         => 'ENTER CODE HERE',
    'ga-status'       => 'disabled', //Uncomment if analytics is disabled
    //'ga-status'     => 'enabled',  //Uncomment if analytic is enabled

];
