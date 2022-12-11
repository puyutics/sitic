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
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">Confirmar la eliminación del usuario</h3>
            </div>
            <div class="panel-body">
                <?php echo "<p></p>";
                echo "<p><b>Usuario</b></p>";
                echo "<p align='center'><code>".$user->getDn()."</code></p>";
                echo "<h3><p align='center'><b>SamAccountName: </b><code>".$samaccountname."</code></p></h3>";
                ?>
                <br>
                <div class="alert alert-danger" align="center">
                    <?php echo $form->field($model, 'delete_user')->checkBox([
                        'checked' => false,
                        'required' => true,
                        'label' => '<b>Confirmo que deseo eliminar esta cuenta y acepto que este proceso no se puede deshacer</b>'
                    ]) ?>
                </div>

                <div class="form-group" align="center">
                    <?= Html::a(Yii::t('app', 'Regresar'),
                        Url::toRoute(['adldap/edituser','search' => $samaccountname]), ['class' => 'btn btn-warning']) ?>
                    <?= Html::submitButton('Eliminar', ['class' => 'btn btn-danger']) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

