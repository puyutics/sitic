<?php

/* @var $this yii\web\View */

use kartik\tabs\TabsX;
use yii\helpers\Html;

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestión TI'), 'url' => ['site/management']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <h1 align="center"><?= Html::encode($this->title) ?></h1>

    <?php echo TabsX::widget([
        'position' => TabsX::POS_ABOVE,
        'align' => TabsX::ALIGN_CENTER,
        'sideways'=>false,
        'bordered'=>false,
        'encodeLabels'=>false,
        'enableStickyTabs' => true,
        'items' => [
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> AD/LDAP',
                'content' => $this->render('index_adldap')

            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> BD Local',
                'content' => $this->render('index_local')

            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> BD Asistencia',
                'content' => $this->render('index_biometrico')

            ],
        ],
    ]);
    ?>

