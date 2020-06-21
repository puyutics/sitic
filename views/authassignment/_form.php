<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'labelOptions' => ['class' => 'col-lg-4 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
        'data' =>ArrayHelper::map(\app\models\UserProfile::find()->all(),
            function ($model) {
                $username = $model->username;
                $user = \app\models\User::find()
                    ->where(["username" => $username])
                    ->one();

                return $user->id;
            },
            function ($model) {
                $username = $model->username;
                $user_profile = \app\models\UserProfile::find()
                    ->where(["username" => $username])
                    ->one();

                return $user_profile->username . ' -- ' . $user_profile->commonname;
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

</div>
