<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PhonesLogs */

$this->title = Yii::t('app', 'Create Phones Logs');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Phones Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phones-logs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
