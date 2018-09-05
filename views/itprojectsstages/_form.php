<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ItProjectsStages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="it-projects-stages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_stage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'percent')->textInput()->label('PORCENTAJE (Ej: 99.99)') ?>

    <?php if (isset($_GET['it_projects_id'])) { ?>
        <?= $form->field($model, 'it_projects_id')->textInput
        (['value' => $_GET['it_projects_id'],'readonly'=> true]) ?>
        <p>
            <?= print_r(\app\models\ItProjects::find()
                ->where(['id' => $_GET['it_projects_id']])
                ->one()->code,1); ?>
        </p>
    <?php } else { ?>
        <?= $form->field($model, 'it_projects_id')->widget(Select2::classname(), [
            'data' =>ArrayHelper::map(\app\models\ItProjects::find()->all(), 'id', 'code'),
            'options' => ['placeholder' => 'Seleccionar proyecto'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
