<?php
/**
 * Created by PhpStorm.
 * User: gfernandez
 * Date: 26/9/18
 * Time: 08:53
 */

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\detail\DetailView;

?>

<div class="profile-view">

    <p>
        <?= DetailView::widget([
            'model' => $model,
            'condensed'=>false,
            'hover'=>false,
            'enableEditMode'=>false,
            'mode'=>DetailView::MODE_VIEW,
            'panel'=>[
                'heading'=>'Datos del usuario',
                'type'=>DetailView::TYPE_PRIMARY,
            ],
            'attributes' => [
                'dni',
                'lastname',
                'firstname',
                'commonname',
                'displayname',
                'mail',
                'personalmail',
                'mobile',
                'title',
                'department',
                [
                    'attribute' => 'uac',
                    'value' => call_user_func(function($model) {
                        if ($model->uac == 512)
                            return "Cuenta activada";
                        if ($model->uac == 514)
                            return "Cuenta desactivada";
                        if ($model->uac == 66048)
                            return "Cuenta activada. Contraseña nunca expira.";
                        if ($model->uac == 66050)
                            return "Cuenta desactivada. Contraseña nunca expira.";
                    }, $model),
                ],

            ]
        ])
        ?>
    </p>
</div>