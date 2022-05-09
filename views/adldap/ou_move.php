<?php
/**
 * Created by PhpStorm.
 * User: gfernandez
 * Date: 26/9/18
 * Time: 08:51
 */

use kartik\select2\Select2;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model */
/* @var $samaccountname */

$user = \Yii::$app->ad->search()->findBy('samaccountname', $samaccountname);

?>

<?php $form = ActiveForm::begin([
    'method' => 'post',
]); ?>

<div class="edit-form">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Cambiar de Unidad Organizativa</h3>
            </div>
            <div class="panel-body">
                <?php echo "<p></p>";
                echo "<p><b>Unidad Organizativa Actual</b></p>";
                echo $user->getDn();
                ?>
                <br>
                <br>
                <div>
                    <?php echo $form->field($model, 'dn_new')->widget(Select2::classname(), [
                        'data' => Yii::$app->params['containers'],
                        'options' => ['placeholder' => 'Seleccionar contenedor'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>
                </div>

                <div class="form-group" align="center">
                    <?= Html::a(Yii::t('app', 'Regresar'),
                        Url::toRoute(['adldap/edituser','search' => $samaccountname]), ['class' => 'btn btn-warning']) ?>
                    <?= Html::submitButton('Mover OU', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

