<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\NomPuertalog */

$this->title = 'Create Nom Puertalog';
$this->params['breadcrumbs'][] = ['label' => 'Nom Puertalogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nom-puertalog-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
