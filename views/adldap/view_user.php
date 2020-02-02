<?php
/**
 * Created by PhpStorm.
 * User: gfernandez
 * Date: 26/9/18
 * Time: 08:51
 */

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use kartik\detail\DetailView;

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $user = Yii::$app->ad->getProvider('default')->search()->users()->find($search);
    $sAMAccountname = $user->getAttribute('samaccountname',0);

    $today = strtotime(date('Y-m-d H:i:s'));
    $lastSetPassword = strtotime($user->getPasswordLastSetDate());
    $diff = round(($today - $lastSetPassword)/86400);

    $this->title = Yii::t('app', 'Ver: {nameAttribute}', [
        'nameAttribute' => $sAMAccountname,
    ]);
}

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestión TI'), 'url' => ['site/management']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['adldap/index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Ver');
?>

<?php $form = ActiveForm::begin([
    'method' => 'post',
]); ?>

<div class="search-form">
    <div class="row">
        <div>
            <?php if (Yii::$app->session->hasFlash('successMail')) { ?>
                &nbsp;
                <div class="alert alert-success">
                    Se ha enviado un correo a <code><?= Yii::$app->session->getFlash('successMail') ?></code> con un enlace (RESET TOKEN) para restablecer la contraseña.
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="row">
        <div>
            <?php if (Yii::$app->session->hasFlash('successActivateMail')) { ?>
                &nbsp;
                <div class="alert alert-success">
                    Se ha enviado un correo a <code><?= Yii::$app->session->getFlash('successActivateMail') ?></code> con las instrucciones para activar la cuenta.
                </div>
            <?php } ?>
        </div>
    </div>

        <?php if (!isset($_GET['search'])) { ?>
            <div class="alert alert-warning col-sm-offset-4 col-sm-4" align="center">
            <?= $form->field($model, 'search')->textInput(); ?>
            <?= Html::submitButton('Buscar',['class' => 'btn btn-default',
                'value'=>'searchButton', 'name'=>'searchButton',
                'onClick'=>'buttonClicked']) ?>
            </div>
    <?php } ?>
</div>

<?php

if (isset($_GET['search'])) { ?>

    <p>
        <?= DetailView::widget([
            'model' => $model,
            'condensed'=>false,
            'hover'=>false,
            'enableEditMode'=>false,
            'mode'=>DetailView::MODE_VIEW,
            'panel'=>[
                'heading'=>'Datos del usuario',
                'type'=>DetailView::TYPE_PRIMARY,
            ],
            'attributes' => [
                'dni',
                'lastname',
                'firstname',
                'commonname',
                'displayname',
                'mail',
                'personalmail',
                'mobile',
                'title',
                'department',
                'dn',
                [
                    'attribute' => 'groups',
                    'value' => call_user_func(function($model) {
                        $groups = "";
                        foreach($model->groups as $group)
                            $groups = $groups . $group->getName() . ", ";
                            return $groups;
                    }, $model),
                ],
                [
                    'label' => 'Último cambio de contraseña:',
                    'value' => $diff . ' días (' . $user->getPasswordLastSetDate() . ')'
                ],
                [
                    'attribute' => 'uac',
                    'value' => call_user_func(function($model) {
                        if ($model->uac == 512)
                            return "Cuenta activada";
                        if ($model->uac == 514)
                            return "Cuenta desactivada";
                        if ($model->uac == 66048)
                            return "Cuenta activada. Contraseña nunca expira.";
                    }, $model),
                ],

            ]
        ])
        ?>
    </p>

    <div class="form-group" align="center">
        <?= Html::a(Yii::t('app', 'Reiniciar Búsqueda'),
            Url::toRoute(['adldap/viewuser']), ['class' => 'btn btn-warning'])
        ?>
        <?= Html::submitButton('Cuenta nueva',['class' => 'btn btn-primary',
            'value'=>'sendActivate', 'name'=>'sendActivate',
            'onClick'=>'buttonClicked']) ?>
        <?= Html::submitButton('Enviar TOKEN',['class' => 'btn btn-danger',
            'value'=>'sendToken', 'name'=>'sendToken',
            //'onClick'=>'buttonClicked'])
            'onClick'=>'alert("Se enviará un enlace (Reset TOKEN) a su correo personal.")'])
        ?>
    </div>

<?php }?>

<?php ActiveForm::end(); ?>