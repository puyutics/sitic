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

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $user = Yii::$app->ad->getProvider('default')->search()->users()->find($search);
    $sAMAccountname = $user->getAttribute('samaccountname',0);

    $today = strtotime(date('Y-m-d H:i:s'));
    $lastSetPassword = strtotime($user->getPasswordLastSetDate());
    $diff = round(($today - $lastSetPassword)/86400);

    $this->title = Yii::t('app', 'Editar: {nameAttribute}', [
        'nameAttribute' => $sAMAccountname,
    ]);
}

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Identidad'), 'url' => ['site/identity']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');
?>

<?php $form = ActiveForm::begin([
    //'type' => ActiveForm::TYPE_HORIZONTAL,
    'method' => 'post',
    //'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_TINY]
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

    <div class="alert alert-warning col-sm-offset-4 col-sm-4" align="center">
        <?php if (isset($_GET['search'])) { ?>
            <?= $form->field($model, 'search')->textInput(
                    ['readOnly'=> true, 'value' => $_GET['search']]); ?>
            <?= Html::a(Yii::t('app', 'Reiniciar'),
                Url::toRoute(['adldap/edituser']), ['class' => 'btn btn-default']) ?>
        <?php } else { ?>
            <?= $form->field($model, 'search')->textInput(); ?>
            <?= Html::submitButton('Buscar',['class' => 'btn btn-default',
                'value'=>'searchButton', 'name'=>'searchButton',
                'onClick'=>'buttonClicked']) ?>
        <?php } ?>
    </div>

    <p>
        <?php if (isset($_GET['search'])) { ?>

        <?php } else { ?>

        <?php } ?>
    </p>
</div>

<?php

if (isset($_GET['search'])) { ?>
    <div class="edit-form">

        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Editar datos del usuario</h3>
                </div>
                <div class="panel-body">

                    <?= $form->field($model, 'dni')->textInput() ?>

                    <?= $form->field($model, 'firstname')->textInput() ?>

                    <?= $form->field($model, 'lastname')->textInput() ?>

                    <?= $form->field($model, 'commonname')->textInput(['readOnly'=> true]) ?>

                    <?= $form->field($model, 'displayname')->textInput() ?>

                    <?= $form->field($model, 'mail')->textInput(['readOnly'=> true]) ?>

                    <?= $form->field($model, 'personalmail')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

                    <div align="center">
                        <p><b>Último cambio de contraseña: </b>
                            <?php
                            echo $diff . ' días (' . $user->getPasswordLastSetDate() . ')';
                            ?>
                        </p>
                    </div>

                    <div class="form-group" align="center">
                            <?= Html::submitButton('Guardar',['class' => 'btn btn-success',
                                'value'=>'submit', 'name'=>'submit',
                                'onClick'=>'buttonClicked']) ?>
                            <?= Html::submitButton('Enviar TOKEN',['class' => 'btn btn-primary',
                                'value'=>'sendToken', 'name'=>'sendToken',
                                'onClick'=>'buttonClicked']) ?>
                    </div>
                </div>
            </div>
        </div>


    </div>

<?php }?>

<?php ActiveForm::end(); ?>