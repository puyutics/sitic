<?php

use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItReportsPowerbiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$html_iframe = print_r(\app\models\ItReportsPowerbi::find()
    ->where(['id' => $_GET['id']])
    ->one()->html_iframe,1);
$title = print_r(\app\models\ItReportsPowerbi::find()
    ->where(['id' => $_GET['id']])
    ->one()->description,1);

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reportes (Power BI)'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="it-reports-powerbi-index">

    <div align="center">
        <h3><?= 'LOGIN: powerbi@uea.edu.ec' ?></h3>
        <h4><a href=https://app.powerbi.com target="_blank">https://app.powerbi.com</a></h4>
    </div>

    <p>
        <?php Pjax::begin(); ?>

        <div align="center">
            <?php print_r($html_iframe) ?>
        </div>

        <?php Pjax::end(); ?>
    </p>

</div>
