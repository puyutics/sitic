<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use johnitvn\ajaxcrud\CrudAsset;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */

CrudAsset::register($this);

?>

<div align="center">
    <?= Html::a('Agregar usuario',
        [
            'user/adduser',
            'action'=>'authassignment/create'
        ],[
            'role'=>'modal-remote',
            'title'=> 'Agregar usuario',
            'class'=>'btn btn-warning'
        ]) ?>
</div>
<hr>


<div class="auth-assignment-form">
    <div id="ajaxCrudDatatable">
        <?php Pjax::begin([
            'id'=>'crud-datatable',
        ]); ?>
        <?php $form = ActiveForm::begin([
            'id' => 'create-form',
            'layout' => 'horizontal',
            'options' => ['autocomplete' => 'off'],
            'fieldConfig' => [
                'labelOptions' => ['class' => 'col-lg-4 control-label'],
            ],
        ]); ?>

        <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
            'data' =>ArrayHelper::map(\app\models\UserProfile::find()->all(),
                function ($model) {
                    $username = $model->username;
                    $user = \app\models\User::find()
                        ->select('id')
                        ->where(["username" => $username])
                        ->one();
                    return $user->id;
                },
                function ($model) {
                    $username = $model->username;
                    $user_profile = \app\models\UserProfile::find()
                        ->select('dni, username, commonname')
                        ->where(["username" => $username])
                        ->one();
                    return $user_profile->dni.' -- '.$user_profile->username.' -- '.$user_profile->commonname;
                }),
            'options' => ['placeholder' => 'Seleccionar usuario'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

        <?= $form->field($model, 'item_name')->widget(Select2::classname(), [
            'data' =>ArrayHelper::map(\app\models\AuthItem::find()
                ->where('type=1')->all(), 'name',
                function ($model) {
                    $name = $model->name;
                    $auth_item_child = \app\models\AuthItemChild::find()
                        ->where(["parent" => $name])
                        ->one();

                    return $auth_item_child->child;
                }
            ),
            'options' => ['placeholder' => 'Seleccionar Rol'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

        <div class="form-group" align="center">
            <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-lg btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        <?php Pjax::end(); ?>
    </div>

</div>

<?php Modal::begin([
    "footer"=>"",// always need it for jquery plugin
    'options' => [
        'id' => 'ajaxCrudModal',
        'tabindex' => false // important for Select2 to work properly
    ],
])?>
<?php Modal::end(); ?>
