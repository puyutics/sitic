<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Dpto */

$this->title = $model->DEP_ID;
$this->params['breadcrumbs'][] = ['label' => 'Dptos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="dpto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'DEP_ID' => $model->DEP_ID, 'DEP_NOM' => $model->DEP_NOM], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'DEP_ID' => $model->DEP_ID, 'DEP_NOM' => $model->DEP_NOM], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'DEP_ID',
            'DEP_ARE',
            'DEP_NOM',
            'DEP_DESC',
            'DEP_OBS',
            'DEP_EM',
        ],
    ]) ?>

</div>
