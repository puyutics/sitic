<?php
/**
 * Created by PhpStorm.
 * User: gfernandez
 * Date: 26/9/18
 * Time: 08:51
 */

use app\models\Department;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $model app\controllers\AdldapController */
/* @var $form app\controllers\AdldapController */

if (isset($_GET['search'])) { ?>
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

                    <?= $form->field($model, 'commonname')->textInput(['readOnly'=> true]) ?>

                    <?= $form->field($model, 'displayname')->textInput() ?>

                    <?= $form->field($model, 'samaccountname')->textInput(['readOnly'=> true]) ?>

                    <?= $form->field($model, 'mail')->textInput(['readOnly'=> true]) ?>


                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'personalmail')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <?= $form->field($model, 'title')->textInput() ?>

                    <?php $department = ArrayHelper::map(Department::find(
                        ['attribute'=>'department'])->orderBy(['department'=>SORT_ASC])->all(),
                        'department', 'department'); ?>

                    <?php echo $form->field($model, 'department')->widget(Select2::classname(), [
                        'data' => $department,
                        'options' => ['placeholder' => 'Seleccionar departamento'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>

                    <?php //Más códigos UAC cuentas Active Directory
                    //https://jackstromberg.com/2013/01/useraccountcontrol-attributeflag-values/
                    //https://social.technet.microsoft.com/Forums/en-US/69211f96-b17e-43aa-9a6a-4f8e99ae2b3a/useraccountcontrol-and-employeestatus?forum=ilm2
                    ?>

                    <div class="row">
                        <div class="col-md-6">

                            <?php echo "<p></p>";
                            echo $form->field($model, 'uac')->dropDownList([
                                '512'=>'Cuenta activada',
                                '66048'=>'Cuenta activada. Contraseña nunca expira',
                                '514'=>'Cuenta desactivada',
                                '66050'=>'Cuenta desactivada. Contraseña nunca expira',
                            ])
                            ?>

                        </div>
                        <div class="col-md-6">

                            <?php echo "<p></p>";
                            echo "<p><b>Estado Actual</b></p>";
                            //NORMAL_ACCOUNT	0x0200	512
                            if ($model->uac == 512) { ?><span class="label label-success">CUENTA ACTIVADA</span><?php }
                            //Disabled Account	0x0202	514
                            if ($model->uac == 514) { ?><span class="label label-danger">CUENTA DESACTIVADA</span><?php }
                            //Enabled, Password Doesn’t Expire	0x10200	66048
                            if ($model->uac == 66048) { ?><span class="label label-success">CUENTA ACTIVADA, CONTRASEÑA NUNCA EXPIRA</span><?php }
                            //Disabled, Password Doesn’t Expire	0x10202	66050
                            if ($model->uac == 66050) { ?><span class="label label-danger">CUENTA DESACTIVADA, CONTRASEÑA NUNCA EXPIRA</span><?php }
                            ?>

                        </div>
                    </div>

                    <?php echo "<p></p>";
                        echo "<p><b>Unidad Organizativa</b></p>";
                        echo $model->dn;
                    ?>

                    <div align="center">
                        <p></p>
                        <p><b>Cuenta creada: </b>
                            <?php
                            echo convert_ldap_time($whenCreated, 'Y-m-d H:i:s');
                            ?>
                        </p>
                    </div>
                    <div align="center">
                        <p></p>
                        <p><b>Último cambio de contraseña: </b>
                            <?php
                            echo $diff . ' días (' . $user->getPasswordLastSetDate() . ')';
                            ?>
                        </p>
                    </div>
                    <div align="center">
                        <?= Html::submitButton('Guardar',['class' => 'btn btn-success',
                            'value'=>'submit', 'name'=>'submit',
                            'onClick'=>'buttonClicked']) ?>
                    </div>
                    <hr>
                    <div class="alert alert-warning">
                        <h3 align="center">Acciones Especiales</h3>
                        <br>
                        <div class="form-group" align="center">
                            <?= Html::submitButton(Icon::show('envelope') . 'Activar cuenta',['class' => 'btn btn-default',
                                'value'=>'sendActivate', 'name'=>'sendActivate',
                                'onClick'=>'buttonClicked']) ?>
                            <?= Html::submitButton(Icon::show('envelope') . 'Enviar TOKEN',['class' => 'btn btn-default',
                                'value'=>'sendToken', 'name'=>'sendToken',
                                'onClick'=>'buttonClicked']) ?>
                            <?= Html::submitButton(Icon::show('key') . 'Random PASS',['class' => 'btn btn-default',
                                'value'=>'randomPassword', 'name'=>'randomPassword',
                                'onClick'=>'buttonClicked']) ?>
                            <?= Html::a(Icon::show('folder') . 'Cambiar OU',
                                ['adldap/oumove', 'samaccountname'=>$model->samaccountname],
                                ['class' => 'btn btn-default']
                            ); ?>
                            <br>
                            <br>
                            <?= Html::a(Icon::show('trash') . 'Eliminar Usuario',
                                ['adldap/deleteuser', 'samaccountname'=>$model->samaccountname],
                                ['class' => 'btn btn-danger']
                            ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

<?php function convert_ldap_time($ldap_time, $output_format)
{
    $format = DateTime::createFromFormat('YmdHis', rtrim($ldap_time, '.0Z'));
    if (!$format) $format = DateTime::createFromFormat('Ymdhis', rtrim($ldap_time, '.0Z'));
    return ($format) ? $format->format($output_format) : false;
} ?>
