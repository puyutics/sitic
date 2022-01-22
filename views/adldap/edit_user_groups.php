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

/* @var $model app\models\adldap */
/* @var $form */

if (isset($_GET['search'])) { ?>
    <div class="edit-form">

        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Editar grupos del usuario:</h3>
                </div>
                <div class="panel-body">

                    <?php echo "<p></p>";
                    echo "<p><b>Grupo(s)</b></p>";
                        $i=0;
                        foreach($model->groups as $group)
                        {
                            $i=$i+1;
                            echo $i . '. ' . $group->getName()."<br>";
                        }
                    ?>

                    <?php echo "<p></p>";
                    echo $form->field($model, 'addGroup')->widget(Select2::classname(), [
                        'data' => Yii::$app->params['groups'],
                        'options' => ['placeholder' => 'Seleccionar grupo'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>

                    <div class="form-group" align="center">
                            <?= Html::submitButton('Agregar',['class' => 'btn btn-success',
                                'value'=>'addGroup', 'name'=>'addGroup',
                                'onClick'=>'buttonClicked']) ?>
                    </div>

                    <?php $i=0;
                    $groups = array();
                    foreach($model->groups as $group)
                        {
                            $groups[$i] = ['name' => $group->getName()];
                            $i++;
                        }

                        $groups = ArrayHelper::map($groups, 'name', 'name');
                    ?>

                    <?php echo $form->field($model, 'deleteGroup')->widget(Select2::classname(), [
                        'data' => $groups,
                        'options' => ['placeholder' => 'Seleccionar grupo'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>

                    <div class="form-group" align="center">
                        <?= Html::submitButton('Eliminar',['class' => 'btn btn-danger',
                            'value'=>'deleteGroup', 'name'=>'deleteGroup',
                            'onClick'=>'buttonClicked']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php }?>