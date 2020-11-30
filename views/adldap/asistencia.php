<?php

use kartik\tabs\TabsX;
use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\daterange\DateRangePicker;
use kartik\form\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\UserInfo */

if (isset($dni)) {
    $searchModelUserInfo = new \app\models\UserInfoSearch();
    $searchModelUserInfo->SSN = $dni;
    $dataProviderUserInfo = $searchModelUserInfo->search(Yii::$app->request->queryParams);

    $totalCount = $dataProviderUserInfo->getTotalCount();

    if ($totalCount == 0) { ?>

        <h1 align="center"><?= Html::encode('No existe información') ?></h1>

    <?php } else {
        $models = $dataProviderUserInfo->getModels();
        $model = $models[0];

        $department = $model->getDepartments()->one();
        $department = $department['DEPTNAME'];

        ?>

        <div class="user-info-view">

            <h1><?php //= Html::encode($this->title) ?></h1>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'BADGENUMBER',
                    'SSN',
                    'sca_Nombre',
                    'sca_Apellido',
                    'sca_Correo',
                    [
                        'attribute' => 'DEFAULTDEPTID',
                        'value' => $department,
                    ],

                ],
            ]) ?>

            <?php echo TabsX::widget([
                'position' => TabsX::POS_ABOVE,
                'align' => TabsX::ALIGN_LEFT,
                'encodeLabels'=>false,
                'enableStickyTabs' => true,
                'stickyTabsOptions' => [
                    'selectorAttribute' => "data-target",
                    'backToTop' => true,
                ],
                'items' => [
                    [
                        'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Marcaciones',
                        'content' => $this->render('../userinfo/_checkinout', [
                            'model' => $model
                        ])

                    ],
                    [
                        'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Permisos',
                        'content' => $this->render('../userinfo/_permisos', [
                            'model' => $model,
                        ])

                    ],
                ],
            ]);
            ?>

        </div>

<?php
    }
}
?>

