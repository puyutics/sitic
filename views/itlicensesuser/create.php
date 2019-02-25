<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItLicensesUser */

$this->title = Yii::t('app', 'Create It Licenses User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'It Licenses Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-licenses-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
