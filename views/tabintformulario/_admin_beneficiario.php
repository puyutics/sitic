<?php
use kartik\tabs\TabsX;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Buscar - Beneficiario');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Identidad'), 'url' => ['site/identity']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Buscar - Beneficiario');

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $user = Yii::$app->ad->getProvider('default')->search()->users()->find($search);

    if (isset($user)) {
        $sAMAccountname = $user->getAttribute('samaccountname',0);
        $mail = $user->getAttribute('mail',0);
        $dni = $user->getAttribute(Yii::$app->params['dni'],0);

        $today = strtotime(date('Y-m-d H:i:s'));
        $lastSetPassword = strtotime($user->getPasswordLastSetDate());
        $diff = round(($today - $lastSetPassword)/86400);

        $this->title = Yii::t('app', 'Beneficiario: {nameAttribute}', [
            'nameAttribute' => $dni,
        ]);
    }
}

?>

<?php $form = ActiveForm::begin([
    'method' => 'post',
]); ?>

<?php if (!isset($_GET['search'])) { ?>
    <div class="search-form">
        <div class="row"> <div class="alert alert-warning col-sm-offset-4 col-sm-4" align="center">
                <?= $form->field($model, 'search')->textInput(); ?>
                <?= Html::submitButton('Buscar',['class' => 'btn btn-default',
                    'value'=>'searchButton', 'name'=>'searchButton',
                    'onClick'=>'buttonClicked']) ?>
            </div> </div>
    </div>
<?php } ?>

<?php if (isset($_GET['search']) and isset($user)) { ?>

    <?php if (isset($_GET['search'])) { ?>
        <div class="row"> <div class="alert col-sm-offset-4 col-sm-4" align="center">
                <?= Html::a(Yii::t('app', 'Reiniciar Búsqueda'),
                    Url::toRoute(['tabintformulario/beneficiarioadmin']), ['class' => 'btn btn-warning']) ?>
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
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Resumen Ejecutivo',
                'content' => $this->render('_resultado'),
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Perfil',
                'content' => $this->render('_view_user', [
                    'model' => $model,
                ]),
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Encuesta UEA',
                'content' => $this->render('_index_encuesta'),
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Encuesta SENESCYT',
                'content' => $this->render('_view_senescyt'),
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Estudiante SIAD',
                'content' => $this->render('_view_estudiante'),
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Matricula SIAD',
                'content' => $this->render('_index_matricula'),
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Ficha Estratificación',
                'content' => $this->render('_index_festrat'),
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

