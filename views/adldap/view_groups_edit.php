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
use yii\helpers\Url;

if (isset($_GET['search'])) { ?>
    <div class="edit-form">

        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Editar datos del grupo:</h3>
                </div>
                <div class="panel-body">

                    <?= $form->field($model, 'name')->textInput(['readOnly'=> true]) ?>

                    <?= $form->field($model, 'dn')->textInput(['readOnly'=> true]) ?>

                    <div class="form-group" align="center">
                        <?= Html::submitButton('Guardar',['class' => 'btn btn-success',
                            'value'=>'submit', 'name'=>'submit',
                            'onClick'=>'buttonClicked']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php }?>