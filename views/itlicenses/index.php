<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItLicensesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Licencias');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inventario TI'), 'url' => ['site/inventory']];
$this->params['breadcrumbs'][] = $this->title;

$searchModelItLicenses = new app\models\ItLicensesSearch();
$dataProviderItLicenses = $searchModelItLicenses->search(Yii::$app->request->queryParams);
$dataProviderItLicenses->sort->defaultOrder = [
    'license' => SORT_ASC,
];

$searchModelInvManufacturers = new app\models\InvManufacturersSearch();
$dataProviderInvManufacturers = $searchModelInvManufacturers->search(Yii::$app->request->queryParams);
$dataProviderInvManufacturers->sort->defaultOrder = [
    'manufacturer' => SORT_ASC,
];
?>
<div class="it-licenses-index">

    <h1><?php //= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php echo TabsX::widget([
        'position' => TabsX::POS_ABOVE,
        'align' => TabsX::ALIGN_LEFT,
        'sideways'=>false,
        'bordered'=>false,
        'encodeLabels'=>false,
        'enableStickyTabs' => true,
        'items' => [
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Licencias',
                'content' => $this->render('_licenses', [
                    'searchModel' => $searchModelItLicenses,
                    'dataProvider' => $dataProviderItLicenses,
                ])

            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Fabricantes',
                'content' => $this->render('_manufacturers',[
                    'searchModel' => $searchModelInvManufacturers,
                    'dataProvider' => $dataProviderInvManufacturers,
                ])
            ],
        ],
    ]);
    ?>

    <?php Pjax::end(); ?>
</div>
