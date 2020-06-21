<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TabIntFormulario */

$this->title = Yii::t('app', 'Firmar Contrato');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Consultar'), 'url' => ['beneficiario']];
//$this->params['breadcrumbs'][] = $this->title;

?>
<div class="tab-int-formulario-create">

    <?= $this->render('_create', [
        'model' => $model,
    ]) ?>

</div>
