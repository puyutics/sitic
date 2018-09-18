<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PrintersLogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="printers-logs-index">

    <?php Pjax::begin(); ?>

    <div align="center">
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
                    'content' => '<iframe width="100%" height="700" src="https://app.powerbi.com/view?r=eyJrIjoiNTg2YzIzNTEtMGMyYS00Njk5LWJiNDgtY2Y3MzM4M2UyMGExIiwidCI6IjhlZGUxOGExLWFiNTItNDY1My1iMzY1LWU1YWQxZjAzMDg0NSIsImMiOjR9" frameborder="0" allowFullScreen="true"></iframe>'

                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-list"></i> 2017',
                    'content' => '<iframe width="100%" height="700" src="https://app.powerbi.com/view?r=eyJrIjoiZTY1M2Y1MDctMTJiZS00YmE1LWIwYTktODgyMmUxMzc2NjZhIiwidCI6IjhlZGUxOGExLWFiNTItNDY1My1iMzY1LWU1YWQxZjAzMDg0NSIsImMiOjR9" frameborder="0" allowFullScreen="true"></iframe>'

                ],
                [
                    'label'=>'<i class="glyphicon glyphicon-list"></i> 2016',
                    'content' => '<iframe width="100%" height="700" src="https://app.powerbi.com/view?r=eyJrIjoiZjlkNWUxNjEtMTUxMi00MjdhLTk0ZTUtYTFmY2ZiNmNmNGNmIiwidCI6IjhlZGUxOGExLWFiNTItNDY1My1iMzY1LWU1YWQxZjAzMDg0NSIsImMiOjR9" frameborder="0" allowFullScreen="true"></iframe>'

                ],
            ],
        ]);
        ?>
    </div>

    <?php Pjax::end(); ?>

</div>
