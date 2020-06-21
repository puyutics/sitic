<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BecasFestrat */

$this->title = $model->idficha_sa;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Becas Festrats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="becas-festrat-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idficha_sa], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idficha_sa], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idficha_sa',
            'cedula',
            'nombres_comp',
            'periodo',
            'p11',
            'p12',
            'p13',
            'p14',
            'p15',
            'p21',
            'p22',
            'p23',
            'p24',
            'p31',
            'p32',
            'p33',
            'p34',
            'p35',
            'p36',
            'p37',
            'p41',
            'p42',
            'p43',
            'p44',
            'p45',
            'p51',
            'p61',
            'p62',
            'p63',
            'total',
            'valoracion',
            'Grupo',
            'fecha_reg',
            'status',
        ],
    ]) ?>

</div>
