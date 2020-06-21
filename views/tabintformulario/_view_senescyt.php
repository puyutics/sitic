<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TabIntSenescyt */

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

$model = \app\models\TabIntSenescyt::findOne(['cedula_pasaporte' => $dni]);

?>

<?php if (isset($model)) { ?>

<div class="tab-int-senescyt-view">

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
            'id',
            'fec_inicio',
            'fec_fin',
            'email:email',
            'nombres',
            'cedula_pasaporte',
            'provincia',
            'canton',
            'parroquia',
            'direccion',
            'nivel',
            'carrera',
            'semestre',
            'equipos',
            'computador',
            'portatil',
            'tablet',
            'radio',
            'television',
            'smartphone',
            'mic_computador',
            'cam_computador',
            'par_computador',
            'mic_portatil',
            'cam_portatil',
            'par_portatil',
            'internet',
            'tipo',
            'proveedor',
            'velocidad',
            'teletrabajo',
            'estudios',
            'cant_usuarios',
            'horas',
            'accion',
        ],
    ]) ?>

</div>

<?php } else { ?>
    <h1 align="center"><?= Html::encode('No existe información') ?></h1>
<?php } ?>