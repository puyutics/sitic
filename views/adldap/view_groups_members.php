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

if (isset($_GET['search'])) { ?>
    <div class="edit-form">

        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Miembros del grupo:</h3>
                </div>
                <div class="panel-body">

                    <?php $i=0;
                    $members = array();
                    foreach($model->members as $member)
                    {
                        $members[$i] = ['dn' => $member->getDN(),
                            'name' => $member->getName()];
                        $i++;
                    }

                    $members = ArrayHelper::map($members, 'dn', 'name');
                    ?>

                    <?php echo "<p></p>";
                    echo $form->field($model, 'deleteMember')->widget(Select2::classname(), [
                        'data' => $members,
                        'options' => ['placeholder' => 'Seleccionar miembro'],
                        'pluginOptions' => [
                            'allowClear' => false,
                        ],
                    ]); ?>

                    <div class="form-group" align="center">
                        <?= Html::submitButton('Eliminar',['class' => 'btn btn-danger',
                            'value'=>'deleteMember', 'name'=>'deleteMember',
                            'onClick'=>'buttonClicked']) ?>
                    </div>

                    <?php echo "<p></p>";
                    echo "<p><b>Miembro(s)</b></p>";
                        $i=0;
                        foreach($model->members as $member)
                        {
                            $i=$i+1;
                            echo $i . '. ' . $member->getAttribute(Yii::$app->params['dni'],0). ' -- '.$member->getName(). ' -- '.$member->getEmail()."<br>";
                        }
                    ?>

                </div>
            </div>
        </div>
    </div>

<?php }?>