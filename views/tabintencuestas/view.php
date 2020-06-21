<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TabIntEncuestas */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tab Int Encuestas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tab-int-encuestas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->ID], [
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
