<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AuthAssignment */

$auth_item_child = \app\models\AuthItemChild::find()
    ->where(["parent" => $model->item_name])
    ->one();

$user = \app\models\User::find()
    ->where(["id" => $model->user_id])
    ->one();

$user_profile = \app\models\UserProfile::find()
    ->where(["username" => $user->username])
    ->one();

$idata = date("Y-m-d H:i:s", $model->created_at);

$this->title = $user_profile->commonname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rol de Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="auth-assignment-view">

    <?= DetailView::widget([
        'model' => $model,
        'condensed'=>false,
        'hover'=>false,
        'enableEditMode'=>false,
        'mode'=>DetailView::MODE_VIEW,
        'panel'=>[
            'heading'=>'ROL: ' . $auth_item_child->child,
            'type'=>DetailView::TYPE_PRIMARY,
        ],
        'attributes' => [
            [
                'attribute' => 'item_name',
                'value' => $auth_item_child->child
            ],
            [
                'label' => 'CÉDULA',
                'value' => $user_profile->dni
            ],
            [
                'label' => 'USUARIO',
                'value' => $user_profile->username
            ],
            [
                'label' => 'NOMBRE',
                'value' => $user_profile->commonname
            ],
            [
                'label' => 'EMAIL INSTITUCIONAL',
                'value' => $user_profile->mail
            ],
            [
                'label' => 'EMAIL PERSONAL',
                'value' => $user_profile->personalmail
            ],
            [
                'label' => 'CELULAR',
                'value' => $user_profile->mobile
            ],
            [
                'attribute' => 'created_at',
                'value' => $idata
            ],
        ],
    ]) ?>

</div>
