<?php

/* @var $this yii\web\View */
/* @var $model yii\models\user_profile */

use kartik\tabs\TabsX;
use kartik\icons\Icon;
Icon::map($this);

$username = Yii::$app->user->identity->username;
$user = Yii::$app->ad->getProvider('default')->search()
    ->findBy('sAMAccountname', $username);
$dni = $user->getAttribute(Yii::$app->params['dni'],0);

$this->title = Yii::t('app', 'Mi Perfil: {nameAttribute}', [
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
            'label' => Icon::show('user').' Perfil',
            'content' => $this->render('edit_profile', [
                'model' => $model,
            ]),
            'active' => true,
        ],
        [
            'label' => Icon::show('cloud').' MS 365',
            'content' => $this->render('profile_o365', [
                'model' => $model,
            ]),
            'active' => false,
        ],
        /*[
            'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Biométrico',
            'content' => $this->render('asistencia', [
                'dni' => $dni
            ]),
        ],*/
        /*[
            'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Roles de Pago',
            'content' => $this->render('../roluser/_user', [
                'username' => $username
            ]),
        ],*/
    ],
]);
?>

