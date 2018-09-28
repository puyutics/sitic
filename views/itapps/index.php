<?php

use yii\widgets\Pjax;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItAppsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Aplicaciones TI');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inventario TI'), 'url' => ['site/inventory']];
$this->params['breadcrumbs'][] = $this->title;

$searchModelItApps = new app\models\ItAppsSearch();
$dataProviderItApps = $searchModelItApps->search(Yii::$app->request->queryParams);
$dataProviderItApps->sort->defaultOrder = [
    'title' => SORT_ASC,
];

$searchModelItAppsCategory = new app\models\ItAppsCategorySearch();
$dataProviderItAppsCategory = $searchModelItAppsCategory->search(Yii::$app->request->queryParams);
$dataProviderItAppsCategory->sort->defaultOrder = [
    'category' => SORT_ASC,
];
?>

<div class="it-apps-index">

    <?php Pjax::begin(); ?>

    <?php echo TabsX::widget([
        'position' => TabsX::POS_ABOVE,
        'align' => TabsX::ALIGN_LEFT,
        'sideways'=>false,
        'bordered'=>false,
        'encodeLabels'=>false,
        'enableStickyTabs' => true,
        'items' => [
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Aplicaciones',
                'content' => $this->render('_apps', [
                    'searchModel' => $searchModelItApps,
                    'dataProvider' => $dataProviderItApps,
                ])

            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Categorías',
                'content' => $this->render('_category',[
                    'searchModel' => $searchModelItAppsCategory,
                    'dataProvider' => $dataProviderItAppsCategory,
                ])
            ],
        ],
    ]);
    ?>

    <?php Pjax::end(); ?>

</div>
