<?php

/* @var $this yii\web\View */
/* @var $model yii\models\user_profile */

use kartik\tabs\TabsX;

$sAMAccountname = Yii::$app->user->identity->username;
$user = Yii::$app->ad->getProvider('default')->search()
    ->findBy('sAMAccountname', $sAMAccountname);
$dni = $user->getAttribute(Yii::$app->params['dni'],0);

$this->title = Yii::t('app', 'Editar: {nameAttribute}', [
    'nameAttribute' => Yii::$app->user->identity->username,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Identidad'), 'url' => ['site/identity']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');
?>

<?php echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_CENTER,
    'sideways'=>false,
    'bordered'=>false,
    'encodeLabels'=>false,
    'enableStickyTabs' => true,
    'items' => [
        [
            'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Mi Perfil',
            'content' => $this->render('edit_profile', [
                'model' => $model,
            ]),
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Asistencia',
            'content' => $this->render('asistencia', [
                'dni' => $dni
            ]),
        ],
    ],
]);
?>

