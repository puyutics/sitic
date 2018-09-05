<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\ipinfo\IpInfo;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'IP info');

?>
<div class="logs-ipaddress">

    <?php Pjax::begin(); ?>

    <?= IpInfo::widget([
            'ip' => $_GET['ipaddress'],
        'showPopover' => false,
        'contentOptions' => [
            'class' => 'table table-bordered table-striped'
        ],
        'flagWrapperOptions' => ['class' => 'kv-flag-center', 'style'=>'width:100px;height:75px;'],
        'flagOptions' => ['class' => 'kv-flag-bordered flag-icon']
    ]); ?>

    <?php Pjax::end(); ?>
</div>
