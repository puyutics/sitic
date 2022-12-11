<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\biometrico\Machines */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Machines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="machines-view">

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
            'MachineAlias',
            'ConnectType',
            'IP',
            'SerialPort',
            'Port',
            'Baudrate',
            'MachineNumber',
            'IsHost',
            'Enabled',
            'CommPassword',
            'UILanguage',
            'DateFormat',
            'InOutRecordWarn',
            'Idle',
            'Voice',
            'managercount',
            'usercount',
            'fingercount',
            'SecretCount',
            'FirmwareVersion',
            'ProductType',
            'LockControl',
            'Purpose',
            'ProduceKind',
            'sn',
            'PhotoStamp',
            'IsIfChangeConfigServer2',
            'SENSORID',
            'SECURITY',
        ],
    ]) ?>

</div>
