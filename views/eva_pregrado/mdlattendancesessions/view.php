<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\eva_pregrado\MdlAttendanceSessions */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mdl Attendance Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mdl-attendance-sessions-view">

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
            'attendanceid',
            'groupid',
            'sessdate',
            'duration',
            'lasttaken',
            'lasttakenby',
            'timemodified:datetime',
            'description:ntext',
            'descriptionformat',
            'studentscanmark',
            'allowupdatestatus',
            'studentsearlyopentime:datetime',
            'autoassignstatus',
            'studentpassword',
            'subnet',
            'automark',
            'automarkcompleted',
            'statusset',
            'absenteereport',
            'preventsharedip',
            'preventsharediptime:datetime',
            'caleventid',
            'calendarevent',
            'includeqrcode',
            'rotateqrcode',
            'rotateqrcodesecret',
            'automarkcmid',
        ],
    ]) ?>

</div>
