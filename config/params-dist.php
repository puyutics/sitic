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


    //Parámetros Personalizados Email Sender Gestión de identidad
    'from'     => 'usuario@dominio.com',
    'fromName' => 'Sistema de Gestión de Identidad',
    'cc'       => 'usuario@dominio.com', //Opción para almacenar copias de Emails Enviados
    'subject'  => 'Restablecer Contraseña',


    //Generar un Código de Seguridad (SaltKey) en el siguiente enlace
    //http://www.sethcardoza.com/tools/random-password-generator/
    //Tested -> 40 Characters Long (Good for Cakephp Security Salt)
    'saltKey'         => 'SvaD6oysdY4oGh97D9Ejtw6RXROr85Olq2yxBjH7',
    'algorithm'       => 'sha256',
    'tokenDateFormat' => date('Y-m-d'), //Duración de token en fecha actual desde 00:00 hasta 23:59

    //IPinfo - Logs Module
    //Generate a new AccessKey for you
    'ipInfoAccessKey' => '',


];
