<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\AcUser */

$this->title = $model->AC_USER;
$this->params['breadcrumbs'][] = ['label' => 'Ac Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ac-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->AC_USER], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->AC_USER], [
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
            'AC_USER',
            'AC_P1',
            'AC_P2',
            'AC_P3',
            'AC_P4',
            'AC_P5',
            'AC_P6',
            'AC_P7',
            'AC_P8',
            'AC_P9',
            'AC_P10',
            'AC_P11',
            'AC_P12',
            'AC_P13',
            'AC_P14',
            'AC_P15',
            'AC_P16',
            'AC_P17',
            'AC_P18',
            'AC_P19',
            'AC_P20',
            'AC_UCREA',
            'AC_FCREA',
        ],
    ]) ?>

</div>
