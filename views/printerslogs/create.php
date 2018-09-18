<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PrintersLogs */

$this->title = Yii::t('app', 'Create Printers Logs');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Printers Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="printers-logs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
