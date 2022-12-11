<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\TblZonaequipo */

$this->title = 'Create Tbl Zonaequipo';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Zonaequipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-zonaequipo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
