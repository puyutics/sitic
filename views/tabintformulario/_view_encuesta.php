<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TabIntEncuestas */

$sAMAccountname = Yii::$app->user->identity->username;
$user = Yii::$app->ad->getProvider('default')->search()
    ->findBy('sAMAccountname', $sAMAccountname);
$dni = $user->getAttribute(Yii::$app->params['dni'],0);

$model = \app\models\TabIntEncuestas::findOne(['CedulaPasaporte' => $dni]);

?>

<?php if (isset($model)) { ?>

<div class="tab-int-encuestas-view">

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
            'ID',
            'ObjectID',
            'GlobalID',
            'CreationDate',
            'Creator',
            'EditDate',
            'Editor',
            'CedulaPasaporte',
            'Nombres',
            'Apellidos',
            'Email:email',
            'Campus',
            'Carrera',
            'Telefono',
            'Operadora',
            'Internet',
            'TipoInternet',
            'Computador',
            'TipoComputador',
            'PropiedadComputador',
            'x',
            'y',
            'Beneficio',
        ],
    ]) ?>

</div>

<?php } else { ?>
    <h1 align="center"><?= Html::encode('No existe información') ?></h1>
<?php } ?>