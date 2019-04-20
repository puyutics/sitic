<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">SITIC</h1>
    <h1 align="center">Sistema Integrado para la Gestión de Tecnologías de la Información y Comunicación</h1>
    <br>
</p>

Este proyecto utiliza Yii 2 Framework Basic Project Template (http://www.yiiframework.com/).

Proyecto creado para la Gestión de Departamentos, Unidades o Áreas de TI, utilizando fundamentos de la ISO/IEC 38500 y el marco de trabajo COBIT 5 (EN DESARROLLO).

Contiene un módulo de Autoservicio y manejo de información de identidad de los usuarios, basados en servidores Active Directory / LDAP. Utilizando la extensión yii2-adldap-module v6 (wrapper for Adldap2 v10).
La configuración de este plugin la podemos encontrar en el siguiente enlace:
https://github.com/edvler/yii2-adldap-module


<h2>DEMO ONLINE</h2>

https://www.uea.edu.ec/sitic-demo/


~~~
Usuario / Contraseña: admin / admin
~~~

REQUERIMIENTOS
--------------

El requerimiento mínimo para este proyecto es que tu servidor Web soporte PHP 5.4.0. El proyecto se está desarrollando utlizando PHP 7.0.31.


INSTALACIÓN
-----------

### Instalar desde un fichero (ZIP)

https://github.com/puyutics/sitic/archive/master.zip

Descargar el proyecto y extraer dentro de una carpeta en la raíz de tu servidor Web. Por ejemplo:

~~~
/var/www/html/sitic/
~~~

Cambiar los archivos de configuración 'dist' en la carpeta `config/`

~~~
console-dist.php  =>  console.php
db-dist.php       =>  db.php
params-dist.php   =>  params.php
web-dist.php      =>  web.php
~~~

Configurar una nueva llave secreta para la cookie en el archivo `config/web.php`.

```php
'request' => [
    // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
    'cookieValidationKey' => '<secret random string goes here>',
],
```

Configurar una nueva llave secreta para la generación de llaves tokens en el archivo `config/params.php`.

```php
//Generar un Código de Seguridad (SaltKey) en el siguiente enlace
    'saltKey'         => '<secret random string goes here>',
    'algorithm'       => 'sha256',
    'tokenDateFormat' => date('Y-m-d'), //Duración de token en fecha actual desde 00:00 hasta 23:59
```

Puedes utilizar el siguiente servicio web para generar una nuevas cadenas alfanuméricas:
http://www.sethcardoza.com/tools/random-password-generator/

Probado con la opción -> 40 Characters Long (Good for Cakephp Security Salt)

Actualizar todos los componentes
--------------------------------
~~~
php /var/www/html/sitic/composer.phar update
~~~

Acceder al sistema
------------------
Puedes acceder a la aplicacion utilizando el siguiente URL:

~~~
http://localhost/sitic/web/
~~~


Configuración
-------------

### Base de Datos

Editar el archivo `config/db.php` con datos reales, por ejemplo:

```php
return [
    'class'    => 'yii\db\Connection',
    'dsn'      => 'mysql:host=localhost;dbname=sitic',
    'username' => 'root',
    'password' => '',
    'charset'  => 'utf8',
];
```

<h5>NOTA:</h5>
Para la creación de la base de datos utiliza el archivo `sitic.sql`.

### Active Directory

Editar el archivo `config/web.php` y el archivo `config/console.php` con datos reales, por ejemplo:

```php
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
                    'account_suffix'    =>  '@dominio.com',
                    'base_dn'           =>  'dc=dominio,dc=com',
                    'admin_username'    =>  'administrador',
                    'admin_password'    =>  '',
                    'port'              =>  636,
                    'use_ssl'           =>  true,
                    'use_tls'           =>  true,
                ],
            ],
        ],
     ],
...
//Adldap2 Conexión SSL/TLS sin comprobar certificado
putenv('LDAPTLS_REQCERT=never');
...
```

Editar el archivo `config/params.php` con datos reales, por ejemplo:

```php
//Tipo de inicio de sesión: username, userPrincipalName o mail
    // 'login' => 'username',
    // 'login' => 'userPrincipalName',
    // 'login' => 'mail',
    'login' => 'mail',
```

```php
//Atributos Personalizados de Active Directory o LDAP
    'dni'          => 'dni',
    'personalmail' => 'personalmail',
    'mobile'       => 'mobile',
```

```php
//Contenedores AD/LDAP para gestión de usuarios
    'containers' => [
        'Users'=>'Users',
        'Computers'=>'Computers',
    ],
```

```php
//Grupos AD/LDAP para gestión de usuarios
    'groups' => [
        'Admins'=>'Admins',
        'Usuarios del dominio'=>'Usuarios del dominio',
    ],
```

### Envío de Email

Editar el archivo `config/web.php` con datos reales, por ejemplo:

```php
'mailer' => [
    'class' => 'yii\swiftmailer\Mailer',
        'transport' => [
            'class'      => 'Swift_SmtpTransport',
            'host'       => 'smtp.dominio.com',
            'username'   => 'usuario@dominio.com',
            'password'   => '',
            'port'       => '587',
            'encryption' => 'tls',
        ],
     ],
```

Editar el archivo `config/params.php` con datos reales, por ejemplo:

```php
//Parámetros Personalizados Email Sender Gestión de identidad
    'from'     => 'usuario@dominio.com',
    'fromName' => 'Sistema de Gestión de Identidad',
    'cc'       => 'usuario@dominio.com', //Opción para almacenar copias de Emails Enviados
    'subject'  => 'Restablecer Contraseña',
```

### Datos Companía, Empresa o Institución

Editar el archivo `config/params.php` con datos reales, por ejemplo:

```php
//Parámetros Personalizados de la Companía, Empresa o Institución
    'company'    => 'Nombre de la Empresa',
    'adminEmail' => 'admin@dominio.com', //Cuenta para recibir correo del formulario de contacto.
    'appURL'     => 'http://sitic.dominio.com/',
    'contact'    => 'Unidad de TI. Contáctese al (+593) 3-2555-555 de lunes a viernes, en horario de atención 08h00 - 17h00.',
```

### Agenda Telefónica (Encabezado)
Cambiar el nombre del archivo `views/phonesextensions/_header-dist.php` a `_header.php` y modificar con datos reales.