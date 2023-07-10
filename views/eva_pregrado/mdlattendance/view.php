<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\eva_pregrado\MdlAttendance */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mdl Attendances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mdl-attendance-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'course',
            'name',
            'grade',
            'timemodified:datetime',
            'intro:ntext',
            'introformat',
            'subnet',
            'sessiondetailspos',
            'showsessiondetails',
            'showextrauserdetails',
        ],
    ]) ?>

</div>
