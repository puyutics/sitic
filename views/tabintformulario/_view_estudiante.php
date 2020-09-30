<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Estudiantes */

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $user = Yii::$app->ad->getProvider('default')->search()->users()->find($search);
    $dni = $user->getAttribute(Yii::$app->params['dni'],0);

} else {
    $sAMAccountname = Yii::$app->user->identity->username;
    $user = Yii::$app->ad->getProvider('default')->search()
        ->findBy('sAMAccountname', $sAMAccountname);
    $dni = $user->getAttribute(Yii::$app->params['dni'],0);
}

$model = \app\models\Estudiantes::findOne(['CIInfPer' => $dni]);

?>

<?php if (isset($model)) { ?>

<div class="estudiantes-view">

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
            'CIInfPer',
            'num_expediente',
            'cedula_pasaporte',
            'TipoDocInfPer',
            'ApellInfPer',
            'ApellMatInfPer',
            'NombInfPer',
            'NacionalidadPer',
            'EtniaPer',
            'FechNacimPer',
            'LugarNacimientoPer',
            'GeneroPer',
            'EstadoCivilPer',
            'CiudadPer',
            'DirecDomicilioPer',
            'Telf1InfPer',
            'CelularInfPer',
            'TipoInfPer',
            'statusper',
            'mailPer',
            'mailInst',
            'GrupoSanguineo',
            'tipo_discapacidad',
            'carnet_conadis',
            'num_carnet_conadis',
            'porcentaje_discapacidad',
            'lateralidad',
            //'fotografia',
            'codigo_dactilar',
            'hd_posicion',
            'huella_dactilar',
            'ultima_actualizacion',
            'codigo_verificacion',
            'deshabilita_edicion',
            'archivo',
        ],
    ]) ?>

</div>

<?php } else { ?>
    <h1 align="center"><?= Html::encode('No existe información') ?></h1>
<?php } ?>