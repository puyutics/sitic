<?php
/**
 * Created by PhpStorm.
 * User: gfernandez
 * Date: 26/9/18
 * Time: 08:51
 */

use kartik\form\ActiveForm;
use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\helpers\Url;
use kartik\password\PasswordInput;

/* @var $model */
/* @var $estudiante (step = 2) */

$this->title = Yii::t('app', 'Reingreso de estudiantes');
$this->params['breadcrumbs'][] = $this->title;

if (strtotime(date("Y-m-d H:i:s",time())) > strtotime("2022-09-05 08:00:00")) {
    $system_status = true;
} else {
    $system_status = false;
}

if (isset($_GET['test'])) {
    if ($_GET['test'] == 'true') {
        $system_status = true;
    }
}

?>

<?php if ($system_status == true) { ?>

    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'options' => ['autocomplete' => 'off'],
    ]); ?>

    <div class="alert alert-info" align="center">
        <h3>UEA | REINGRESO DE ESTUDIANTES</h3>
    </div>
    <br>
    <?php if ($model->step == 1) { ?>
        <div class="edit-form">
            <div class="col-sm-offset-2 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">PASO 1: Validar datos del usuario</h3>
                    </div>
                    <div class="panel-body">
                        <?php if (Yii::$app->session->hasFlash('errorNoBd')) { ?>
                            <div class="alert alert-danger" align="center">
                                <?= Yii::$app->session->getFlash('errorNoBd') ?>
                            </div>
                        <?php } ?>
                        <div class="alert alert-success" align="center">
                            <h4>Para realizar el proceso de reingreso a la Universidad Estatal Amazónica, vamos a validar algunos datos</h4>
                        </div>
                        <?= $form->field($model, 'step')->hiddenInput()->label(false) ?>
                        <?= $form->field($model, 'dni')->textInput() ?>
                        <div align="center">
                            <?= $form->field($model, 'fec_nacimiento')->widget(DatePicker::className(), [
                                'options' => ['placeholder' => 'Seleccionar fecha'],
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
    <?php }
    elseif ($model->step == 2) { ?>
        <?php
        $estudiante_malla_actual = \app\models\EstudiantesMalla::find()
            ->where(['CIInfPer' => $estudiante->CIInfPer])
            ->orderBy('anio_mallacurricular DESC')
            ->one();

        if (isset($estudiante_malla_actual)) {
            $estudiante_malla_inicial = \app\models\EstudiantesMalla::find()
                ->where(['CIInfPer' => $estudiante->CIInfPer])
                ->andWhere(['idcarr' => $estudiante_malla_actual->idcarr])
                ->orderBy('anio_mallacurricular ASC')
                ->one();

            if ($estudiante_malla_actual->idcarr == 'AGI') $carrera = 'AGROINDUSTRIA';
            elseif ($estudiante_malla_actual->idcarr == 'AGR') $carrera = 'AGROPECUARIA';
            elseif ($estudiante_malla_actual->idcarr == 'AMB') $carrera = 'AMBIENTAL';
            elseif ($estudiante_malla_actual->idcarr == 'BLG') $carrera = 'BIOLOGÍA';
            elseif ($estudiante_malla_actual->idcarr == 'BLGEL') $carrera = 'BIOLOGÍA';
            elseif ($estudiante_malla_actual->idcarr == 'BLGEP') $carrera = 'BIOLOGÍA';
            elseif ($estudiante_malla_actual->idcarr == 'COM') $carrera = 'COMUNICACIÓN';
            elseif ($estudiante_malla_actual->idcarr == 'FRT') $carrera = 'FORESTAL';
            elseif ($estudiante_malla_actual->idcarr == 'LTUR') $carrera = 'TURISMO';
            elseif ($estudiante_malla_actual->idcarr == 'LTUREL') $carrera = 'TURISMO';
            elseif ($estudiante_malla_actual->idcarr == 'LTUREP') $carrera = 'TURISMO';
            elseif ($estudiante_malla_actual->idcarr == 'TUR') $carrera = 'TURISMO';
            ?>
            <div class="edit-form">
                <div class="col-sm-offset-2 col-sm-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">PASO 2: Validar datos académicos del estudiante</h3>
                        </div>
                        <br>
                        <table width=100% border="1" style="table-layout: fixed; border-color: #428bca">
                            <tr>
                                <th colspan="2" width="60%" bgcolor="#428bca" style="text-align: center; color: #ffffff">Ficha del estudiante</th>
                            </tr>
                            <tr>
                                <th style="text-align: center">Cédula</th>
                                <th style="text-align: center"><?= $estudiante->cedula_pasaporte ?></th>
                            </tr>
                            <tr>
                                <th style="text-align: center">Apellidos</th>
                                <th style="text-align: center"><?= $estudiante->ApellInfPer . ' ' . $estudiante->ApellMatInfPer ?></th>
                            </tr>
                            <tr>
                                <th style="text-align: center">Nombres</th>
                                <th style="text-align: center"><?= $estudiante->NombInfPer ?></th>
                            </tr>
                            <tr>
                                <th style="text-align: center">Correo institucional</th>
                                <th style="text-align: center"><?= $estudiante->mailInst ?></th>
                            </tr>
                            <tr>
                                <th style="text-align: center">Estado de la cuenta</th>
                                <th style="text-align: center">
                                    <?php if ($estudiante->statusper == 0) echo 'INACTIVA' ?>
                                    <?php if ($estudiante->statusper == 1) echo 'ACTIVA' ?>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2" width="60%" bgcolor="#428bca" style="text-align: center; color: #ffffff">Carrera</th>
                            </tr>
                            <tr>
                                <th style="text-align: center">Carrera</th>
                                <th style="text-align: center"><?= $carrera ?></th>
                            </tr>
                            <tr>
                                <th style="text-align: center">Última malla vigente</th>
                                <th style="text-align: center"><?= $estudiante_malla_actual->anio_mallacurricular ?></th>
                            </tr>
                            <tr>
                                <th colspan="2" style="text-align: center">
                                    <?php if ($estudiante_malla_inicial->anio_mallacurricular == '2013' or $estudiante_malla_inicial->anio_mallacurricular == '0') { ?>
                                        <br><div class="alert alert-danger" align="center">
                                            <b><code>No cumple con los requisitos para reactivar su cuenta automáticamente.</code></b><br>Comuníquese con Secretaría Académica: Campus Puyo, Bloque D, Planta Baja o al 032-892-118 Ext. 16103 / 16118
                                        </div>
                                    <?php } elseif (($estudiante_malla_actual->anio_mallacurricular == '2021') and ($estudiante->statusper == 1)) { ?>
                                        <br><div class="alert alert-warning" align="center">
                                            No es necesario que realice un proceso de reingreso para matricularse<br>
                                            <a href="https://www.uea.edu.ec/siad2">Ingresar al sistema académico SIAD</a>
                                        </div>
                                    <?php } else { ?>
                                        <br><div class="alert alert-success" align="center">
                                            <?php echo $form->field($model, 'status')->checkBox([
                                                'checked' => false,
                                                'required' => true,
                                                'label' => 'Acepto que he realizado la solicitud de reingreso a la Universidad Estatal Amazónica de forma personal y  procederé a matricularme en el período de matrículas ordinarias'
                                            ]) ?>
                                        </div>
                                        <div class="form-group" align="center">
                                            <?= Html::submitButton('Validar Datos', ['class' => 'btn btn-success']) ?>
                                        </div>
                                    <?php } ?>
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger" align="center">
                Debe realizar su trámite de reingreso debe forma personal en la Secretaría Académica. Acérquese al Campus Puyo, Bloque D, Planta Baja o comuníquese al 032-892-118 Ext. 16103 / 16118
            </div>
        <?php } ?>
        <?= $form->field($model, 'step')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'dni')->hiddenInput()->label(false) ?>
    <?php }
    elseif ($model->step == 3) { ?>
        <div class="alert alert-success" align="center">
            <h4>
                Su trámite de reingreso se ha completado exitosamente.<br><br>
                <a target="_blank" href="https://www.uea.edu.ec/sitic/index.php?r=adldap/forgetpass">1. Actualice la contraseña de su cuenta institucional</a><br><br>
                <a target="_blank" href="https://www.uea.edu.ec/siad2">2. Proceda a matricularse: Sistema académico SIAD</a>
            </h4>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

<?php } else { ?>
    <div class="alert alert-info" align="center">
        <h3 align="center">El sistema no se encuentra habilitado. Debe realizar su trámite de reingreso debe forma personal en la Secretaría Académica. Acérquese al Campus Puyo, Bloque D, Planta Baja o comuníquese al 032-892-118 Ext. 16103 / 16118.</h3>
    </div>
<?php } ?>