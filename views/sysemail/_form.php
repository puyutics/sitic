<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model app\models\SysEmail */
/* @var $form yii\widgets\ActiveForm */

$sAMAccountname = Yii::$app->user->identity->username;
$user = Yii::$app->ad->getProvider('default')->search()
    ->findBy('sAMAccountname', $sAMAccountname);
$email = $user->getEmail();


?>

<div class="sys-email-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'from')->dropDownList([
        ''=>'Seleccionar remitente',
        'comunicados@uea.edu.ec'=>'comunicados@uea.edu.ec',
        //'identidad@uea.edu.ec'=>'identidad@uea.edu.ec',
        //'listas@uea.edu.ec'=>'listas@uea.edu.ec',
        //'sitic@uea.edu.ec'=>'sitic@uea.edu.ec',
    ], ['value' => 'comunicados@uea.edu.ec'])
    ?>

    <?= $form->field($model, 'replyto')->textInput(['readOnly' => true, 'value' => $email]) ?>

    <?php /*echo $form->field($model, 'replyto')->widget(Select2::classname(), [
        'data' =>ArrayHelper::map(\app\models\UserProfile::find()->all(), 'mail', 'mail'),
        'options' => [
            'placeholder' => 'Seleccionar usuario',
            'value' => $email,
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */?>

   <?php echo $form->field($model, 'to')->widget(Select2::classname(), [
        'data' => Yii::$app->params['listas-correo'],
        'options' => [
            'placeholder' => 'Seleccionar listas de correo',
            'multiple' => true
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?php //= $form->field($model, 'cc')->textarea(['rows' => 6]) ?>

    <?php //= $form->field($model, 'cco')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'es',
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        ]
    ]);?>

    <?php //= $form->field($model, 'attach')->textarea(['rows' => 6]) ?>

    <?php //= $form->field($model, 'datetime')->textInput() ?>

    <?php //= $form->field($model, 'status')->textInput() ?>

    <div class="form-group" align="center">
        <?= Html::submitButton('Vista Previa', ['class' => 'btn btn-lg btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
