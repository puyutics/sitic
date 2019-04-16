<?php
/**
 * Created by PhpStorm.
 * User: gfernandez
 * Date: 26/9/18
 * Time: 08:51
 */

use kartik\form\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Crear usuario');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestión TI'), 'url' => ['site/management']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['adldap/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin([
    'method' => 'post',
]); ?>

    <h1 align="center"><?= Html::encode($this->title) ?></h1>

    <div class="edit-form">

        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Editar datos del usuario:</h3>
                </div>
                <div class="panel-body">

                    <?= $form->field($model, 'dni')->textInput() ?>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'lastname')->textInput() ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'firstname')->textInput() ?>
                        </div>
                    </div>

                    <?= $form->field($model, 'commonname')->textInput() ?>

                    <?= $form->field($model, 'displayname')->textInput() ?>

                    <?= $form->field($model, 'samaccountname')->textInput() ?>

                    <?= $form->field($model, 'mail')->textInput() ?>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'personalmail')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <?= $form->field($model, 'title')->textInput() ?>

                    <?= $form->field($model, 'department')->textInput() ?>

                    <?php //Más códigos UAC cuentas Active Directory
                    //https://jackstromberg.com/2013/01/useraccountcontrol-attributeflag-values/
                    ?>

                    <div class="row">
                        <div class="col-md-6">
                            <?php echo "<p></p>";
                            echo $form->field($model, 'dn')->dropDownList(
                                    Yii::$app->params['containers'])
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo "<p></p>";
                            echo $form->field($model, 'uac')->dropDownList([
                                '512'=>'Cuenta activada',
                                '66048'=>'Cuenta activada. Contraseña nunca expira',
                                '514'=>'Cuenta desactivada',
                            ])
                            ?>
                        </div>
                    </div>

                    <div class="form-group" align="center">
                        <?= Html::submitButton('Crear Usuario',['class' => 'btn btn-success',
                            'value'=>'submit', 'name'=>'submit',
                            'onClick'=>'buttonClicked']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php ActiveForm::end(); ?>