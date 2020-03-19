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
use kartik\tabs\TabsX;

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $user = Yii::$app->ad->getProvider('default')->search()->users()->find($search);

    if (isset($user)) {
        $sAMAccountname = $user->getAttribute('samaccountname',0);
        $mail = $user->getAttribute('mail',0);

        $today = strtotime(date('Y-m-d H:i:s'));
        $lastSetPassword = strtotime($user->getPasswordLastSetDate());
        $diff = round(($today - $lastSetPassword)/86400);

        $this->title = Yii::t('app', 'Editar: {nameAttribute}', [
            'nameAttribute' => $sAMAccountname,
        ]);
    }
}

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestión TI'), 'url' => ['site/management']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['adldap/index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');
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
        <div class="row"> <div class="alert alert-warning col-sm-offset-4 col-sm-4" align="center">
            <?= $form->field($model, 'search')->textInput(); ?>
            <?= Html::submitButton('Buscar',['class' => 'btn btn-default',
                'value'=>'searchButton', 'name'=>'searchButton',
                'onClick'=>'buttonClicked']) ?>
        </div> </div>
    <?php } ?>
</div>

<?php
if (isset($_GET['search']) and isset($user)) { ?>

    <?php if (isset($_GET['search'])) { ?>
        <div class="row"> <div class="alert col-sm-offset-4 col-sm-4" align="center">
                <?= Html::a(Yii::t('app', 'Reiniciar Búsqueda'),
                    Url::toRoute(['adldap/edituser']), ['class' => 'btn btn-warning']) ?>
            </div> </div>
    <?php } ?>

    <?php echo TabsX::widget([
        'position' => TabsX::POS_ABOVE,
        'align' => TabsX::ALIGN_CENTER,
        'sideways'=>false,
        'bordered'=>false,
        'encodeLabels'=>false,
        'enableStickyTabs' => true,
        'items' => [
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Perfil',
                'content' => $this->render('edit_user_index', [
                    'model' => $model,
                    'form' => $form,
                    'diff' => $diff,
                    'user' => $user,
                ])

            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Grupos',
                'content' => $this->render('edit_user_groups', [
                    'model' => $model,
                    'form' => $form,
                ])

            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Historial',
                'content' => $this->render('edit_user_logs', [
                    'model' => $model,
                ])

            ],
        ],
    ]);
    ?>

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
