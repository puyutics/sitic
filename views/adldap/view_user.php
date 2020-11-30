<?php
/**
 * Created by PhpStorm.
 * User: gfernandez
 * Date: 26/9/18
 * Time: 08:51
 */

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use kartik\detail\DetailView;

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $user = Yii::$app->ad->getProvider('default')->search()->users()->find($search);

    if (isset($user)){
        $sAMAccountname = $user->getAttribute('samaccountname',0);

        $today = strtotime(date('Y-m-d H:i:s'));
        $lastSetPassword = strtotime($user->getPasswordLastSetDate());
        $diff = round(($today - $lastSetPassword)/86400);

        $this->title = Yii::t('app', 'Ver: {nameAttribute}', [
            'nameAttribute' => $sAMAccountname,
        ]);
    }
}

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestión TI'), 'url' => ['site/management']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['adldap/index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Ver');
?>

<?php $form = ActiveForm::begin([
    'method' => 'post',
]); ?>

<div class="search-form">
    <div class="row">
        <div>
            <?php if (Yii::$app->session->hasFlash('successMail')) { ?>
                &nbsp;
                <div class="alert alert-success">
                    Se ha enviado un correo a <code><?= Yii::$app->session->getFlash('successMail') ?></code> con un enlace (RESET TOKEN) para restablecer la contraseña.
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="row">
        <div>
            <?php if (Yii::$app->session->hasFlash('successActivateMail')) { ?>
                &nbsp;
                <div class="alert alert-success">
                    Se ha enviado un correo a <code><?= Yii::$app->session->getFlash('successActivateMail') ?></code> con las instrucciones para activar la cuenta.
                </div>
            <?php } ?>
        </div>
    </div>

        <?php if (!isset($_GET['search'])) { ?>
            <div class="alert alert-warning col-sm-offset-4 col-sm-4" align="center">
            <?= $form->field($model, 'search')->textInput(); ?>
            <?= Html::submitButton('Buscar',['class' => 'btn btn-default',
                'value'=>'searchButton', 'name'=>'searchButton',
                'onClick'=>'buttonClicked']) ?>
            </div>
    <?php } ?>
</div>

<?php
if (isset($_GET['search']) and isset($user)) { ?>

    <?php if ((isset($users)) and (count($users)>1)) { ?>
        <div class="form-group" align="center">
            <?= Html::a(Yii::t('app', 'Reiniciar Búsqueda'),
                Url::toRoute(['adldap/viewuser']), ['class' => 'btn btn-warning'])
            ?>
        </div>

        <div style="font-size: 9pt; text-align: left;">
            <b>Total de resultados: <?= count($users) ?></b>
        </div>
        <br>
        <table width=100% border="1" style="font-size: 9pt;border-collapse:collapse">
            <tr>
                <th bgcolor="#EEEEEE" style="text-align: center">#</th>
                <th bgcolor="#EEEEEE" style="text-align: center">Céd/Pasaporte/Cód</th>
                <th bgcolor="#EEEEEE" style="text-align: center">Usuario</th>
                <th bgcolor="#EEEEEE" style="text-align: center">Nombre Completo</th>
                <th bgcolor="#EEEEEE" style="text-align: center">Email institucional</th>
                <th bgcolor="#EEEEEE" style="text-align: center">Ver</th>
            </tr>
            <?php $i=0 ?>
            <?php foreach ($users as $single_user)  { ?>
                <?php $i=$i+1 ?>
                <tr>
                    <th style="text-align: center"><?= $i ?></th>
                    <th style="text-align: center"><?= $single_user->getAttribute(Yii::$app->params['dni'],0) ?></th>
                    <th style="text-align: center"><?= $single_user->getAttribute('samaccountname',0) ?></th>
                    <th style="text-align: center"><?= $single_user->getAttribute('cn',0) ?></th>
                    <th style="text-align: center"><?= $single_user->getEmail() ?></th>
                    <th style="text-align: center"><?= Html::a('<span class="btn btn-outline-secondary">Ver</span>',
                            Url::to(['/adldap/viewuser',
                                'search' => $_GET['search'],
                                'samaccountname' => $single_user->getAttribute('samaccountname',0)
                            ]),['title' => Yii::t('yii', 'Ver')]);
                        ?></th>


                </tr>
            <?php } ?>
        </table>
        <br>
    <?php } else { ?>
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
                    'dn',
                    [
                        'attribute' => 'groups',
                        'value' => call_user_func(function($model) {
                            $groups = "";
                            foreach($model->groups as $group)
                                $groups = $groups . $group->getName() . ", ";
                            return $groups;
                        }, $model),
                    ],
                    [
                        'label' => 'Último cambio de contraseña:',
                        'value' => $diff . ' días (' . $user->getPasswordLastSetDate() . ')'
                    ],
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

        <div class="form-group" align="center">
            <?= Html::a(Yii::t('app', 'Reiniciar Búsqueda'),
                Url::toRoute(['adldap/viewuser']), ['class' => 'btn btn-warning'])
            ?>
            <?= Html::submitButton('Cuenta nueva',['class' => 'btn btn-primary',
                'value'=>'sendActivate', 'name'=>'sendActivate',
                'onClick'=>'buttonClicked']) ?>
            <?= Html::submitButton('Enviar TOKEN',['class' => 'btn btn-danger',
                'value'=>'sendToken', 'name'=>'sendToken',
                //'onClick'=>'buttonClicked'])
                'onClick'=>'alert("Se enviará un enlace (Reset TOKEN) a su correo personal.")'])
            ?>
        </div>

    <?php } ?>

    <?php } elseif (isset($_GET['search'])) { ?>
        <div class="row"> <div class="alert alert-warning col-sm-offset-4 col-sm-4" align="center">
                <?= $form->field($model, 'search')->textInput(['value' => $_GET['search']]); ?>
                <?= Html::submitButton('Buscar',['class' => 'btn btn-default',
                    'value'=>'searchButton', 'name'=>'searchButton',
                    'onClick'=>'buttonClicked']) ?>
            </div>
        </div>
    <?php }?>
<?php ActiveForm::end(); ?>