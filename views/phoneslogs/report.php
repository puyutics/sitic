<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PhonesLogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="phones-logs-reports-index">

    <?php Pjax::begin(); ?>

    <?php echo TabsX::widget([
        'position' => TabsX::POS_LEFT,
        'align' => TabsX::ALIGN_CENTER,
        'encodeLabels'=>false,
        'enableStickyTabs' => true,
        'stickyTabsOptions' => [
            'selectorAttribute' => "data-target",
            'backToTop' => true,
        ],
        'items' => [
            [
                'label'=>'<i class="glyphicon glyphicon-list"></i> 2018',
                'content' => '<iframe width="100%" height="700" src="https://app.powerbi.com/view?r=eyJrIjoiZWI2NWFhOTYtZTVjMS00MmJhLWI0MzctNjBjNGVlZmM5NWVhIiwidCI6IjhlZGUxOGExLWFiNTItNDY1My1iMzY1LWU1YWQxZjAzMDg0NSIsImMiOjR9" frameborder="0" allowFullScreen="true"></iframe>'

            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list"></i> 2017',
                'content' => '<iframe width="100%" height="700" src="https://app.powerbi.com/view?r=eyJrIjoiNWEyMmYyMjMtMzI3Yy00ZDg0LThjYTQtYzNlNzE4ZjNjMDA5IiwidCI6IjhlZGUxOGExLWFiNTItNDY1My1iMzY1LWU1YWQxZjAzMDg0NSIsImMiOjR9" frameborder="0" allowFullScreen="true"></iframe>'

            ],
        ],
    ]);
    ?>

    <?php Pjax::end(); ?>

</div>
