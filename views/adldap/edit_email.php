<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;
use kartik\date\DatePicker;

$this->title = 'Cambiar correo personal';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuenta institucional'), 'url' => ['site/identity']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="adldap-edit-email">

    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'options' => ['autocomplete' => 'off'],
    ]); ?>

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= $this->title ?></h3>
        <h4><code>Este proceso es exclusivo para estudiantes de Pregrado y Nivelación</code></h4>
        <h4><code>Para los diferentes usuarios deben crear un ticket</code> <a target="_blank" href="https://www.uea.edu.ec/soporte">aquí</a></h4>
    </div>

    <?php if ($model->step == 1) { ?>
        <div class="edit-form">
            <div class="col-sm-offset-3 col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">PASO 1: Validar datos del usuario</h3>
                    </div>
                    <div class="panel-body">

                        <?= $form->field($model,'step')->hiddenInput()->label(false) ?>

                        <?php if (strlen(Yii::$app->session->getFlash('errorUser')) > 0 ) { ?>
                            <div align="center" class="alert btn-danger"><?= Yii::$app->session->getFlash('errorUser') ?></code></div>
                        <?php } ?>

                        <?= $form->field($model,'dni')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($model,'mail')->textInput() ?>

                        <?= $form->field($model,'personalmail')->hiddenInput()->label(false) ?>

                        <?php if (strlen(Yii::$app->session->getFlash('errorFecha')) > 0 ) { ?>
                            <div align="center" class="alert btn-danger"><?= Yii::$app->session->getFlash('errorFecha') ?></code></div>
                        <?php } ?>

                        <div align="center">
                            <?= $form->field($model, 'fec_nacimiento')->widget(DatePicker::className(), [
                                'type' => DatePicker::TYPE_INLINE,
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                    'todayHighlight' => true,
                                    'format' => 'yyyy-mm-dd'
                                ]
                            ]) ?>
                        </div>

                        <div class="form-group" align="center">
                            <?= Html::submitButton('Validar Datos', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } elseif ($model->step == 2) { ?>
        <div class="edit-form">
            <div class="col-sm-offset-3 col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">PASO 2: Validar email personal</h3>
                    </div>
                    <div class="panel-body">

                        <?= $form->field($model,'step')->hiddenInput()->label(false) ?>

                        <?= $form->field($model,'dni')->textInput(['readOnly' => true]) ?>

                        <?= $form->field($model,'mail')->textInput(['readOnly' => true]) ?>

                        <?= $form->field($model,'fec_nacimiento')->hiddenInput()->label(false) ?>

                        <?= $form->field($model,'personalmail')->textInput() ?>

                        <?php if (strlen(Yii::$app->session->getFlash('errorEmail')) > 0 ) { ?>
                            <div align="center" class="alert btn-danger"><?= Yii::$app->session->getFlash('errorEmail') ?></code></div>
                        <?php } ?>

                        <div class="form-group" align="center">
                            <?= Html::submitButton('Enviar Correo', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } elseif ($model->step == 3) { ?>
        <div class="edit-form">
            <div class="col-sm-offset-3 col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">PASO 3: Validar TOKEN</h3>
                    </div>
                    <div class="panel-body">

                        <?= $form->field($model, 'step')->hiddenInput()->label(false) ?>

                        <?= $form->field($model,'dni')->textInput(['readOnly' => true]) ?>

                        <?= $form->field($model,'mail')->textInput(['readOnly' => true]) ?>

                        <?= $form->field($model,'fec_nacimiento')->hiddenInput()->label(false) ?>

                        <?= $form->field($model, 'personalmail')->textInput(['readOnly' => true]) ?>

                        <?= $form->field($model, 'token')->textInput() ?>

                        <?php if (strlen(Yii::$app->session->getFlash('errorToken')) > 0 ) { ?>
                            <div align="center" class="alert btn-danger"><?= Yii::$app->session->getFlash('errorToker') ?></code></div>
                        <?php } ?>

                        <div class="form-group" align="center">
                            <?= Html::submitButton('Validar TOKEN', ['class' => 'btn btn-success']) ?>
                            <?= Html::a('<span class="btn btn-outline-secondary">Reiniciar Proceso</span>',
                                Url::to(['/adldap/editemail']),
                                ['title' => Yii::t('yii', 'Reiniciar Proceso')]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } elseif ($model->step == 4) { ?>

        <div class="alert btn-success" align="center">
            <h3>Se ha realizado el cambio de su correo personal de manera exitosa</h3>
        </div>

        <p align="center"><a class="btn btn-lg btn-danger" href="index.php?r=adldap/forgetpass"> Cambiar Contraseña &raquo;</a></p>

    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
