<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <?php if (Yii::$app->params['ga-status'] == 'enable') { ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo Yii::$app->params['ga-code']?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', '<?php echo Yii::$app->params['ga-code']?>');
        </script>
    <?php } ?>

</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            //['label' => 'Acerca de', 'url' => ['/site/about']],
            //['label' => 'Contacto', 'url' => ['/site/contact']],
        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => [
            [
                'label' => 'Identidad',
                'items' => [
                    ['label' => '.. Identidad', 'url' => 'index.php?r=site/identity'],
                    '<li class="divider"></li>',
                    ['label' => 'Editar perfil', 'url' => 'index.php?r=adldap/editprofile'],
                    ['label' => 'Cambiar Contraseña', 'url' => 'index.php?r=adldap/forgetpass'],
                    '<li class="divider"></li>',
                    //'<li class="dropdown-header">Dropdown Header</li>',
                    ['label' => 'Olvidaste tu usuario', 'url' => 'index.php?r=adldap/forgetuser'],
                    ['label' => 'Olvidaste tu contraseña', 'url' => 'index.php?r=adldap/forgetpass'],
                ],
            ],
        ],
    ]);


    if (
            (!Yii::$app->user->isGuest)
            and (Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()))
    ) {
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-left'],
            'items' => [
                [
                    'label' => 'Inventario TI',
                    'items' => [
                        ['label' => '.. Inventario TI', 'url' => 'index.php?r=site/inventory'],
                        '<li class="divider"></li>',
                        ['label' => 'Aplicaciones', 'url' => 'index.php?r=itapps/index'],
                        ['label' => 'Impresoras', 'url' => 'index.php?r=printers/index'],
                        ['label' => 'Licencias', 'url' => 'index.php?r=itlicenses/index'],
                        ['label' => 'Telefonía', 'url' => 'index.php?r=phonesextensions/index'],
                    ],
                ],
                [
                    'label' => 'Gestión TI',
                    'items' => [
                        ['label' => '.. Gestión TI', 'url' => 'index.php?r=site/management'],
                        '<li class="divider"></li>',
                        ['label' => 'Bienes', 'url' => 'index.php?r=invpurchaseitem/index'],
                        ['label' => 'Compras', 'url' => 'index.php?r=invpurchase/index'],
                        ['label' => 'Procesos', 'url' => 'index.php?r=itprocesses/index'],
                        ['label' => 'Proyectos', 'url' => 'index.php?r=itprojects/index'],
                        ['label' => 'Servicios', 'url' => 'index.php?r=itservices/index'],
                        ['label' => 'Usuarios', 'url' => 'index.php?r=adldap/index'],
                    ],
                ],
                [
                    'label' => 'Documentación TI',
                    'items' => [
                        ['label' => '.. Documentación (Global)', 'url' => 'index.php?r=documents/index'],
                        '<li class="divider"></li>',
                        ['label' => 'Manuales TI', 'url' => 'index.php?r=documents/index'],
                        ['label' => 'Normativa TI', 'url' => 'index.php?r=documents/index'],
                        ['label' => 'Políticas TI', 'url' => 'index.php?r=documents/index'],
                        ['label' => 'Reglamentos TI', 'url' => 'index.php?r=documents/index'],
                    ],
                ],
                [
                    'label' => 'Reportes TI',
                    'items' => [
                        //['label' => '..Reportes TI', 'url' => 'index.php?r=site/reports'],
                        //'<li class="divider"></li>',
                        ['label' => 'Reporte(s) Incidentes', 'url' => 'index.php?r=itincidentsreports/index'],
                        ['label' => 'Reporte(s) Power BI', 'url' => 'index.php?r=itreportspowerbi/index'],
                        ['label' => 'Registros del Sistema', 'url' => 'index.php?r=logs/index'],
                    ],
                ],
                //['label' => 'Acerca de', 'url' => ['/site/about']],
                //['label' => 'Contacto', 'url' => ['/site/contact']],
            ],
        ]);
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            Yii::$app->user->isGuest ? (
            ['label' => 'Iniciar Sesión', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Cerrar Sesión (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);


    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <a href="https://github.com/puyutics/sitic" target="_blank">Puyutics / Sitic <?= date('Y') ?></a>. GNU GPLv3</p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
