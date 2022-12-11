<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\TblserverSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tblservers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblserver-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tblserver', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'PR_ID',
            'PR_SE',
            'PR_COD',
            'PR_Log',
            'PR_LHora',
            //'PR_IP',
            //'PR_FINGER',
            //'PR_LD',
            //'PR_LT',
            //'PR_F1',
            //'PR_F2',
            //'PR_F3',
            //'PR_F4',
            //'PR_UCOD',
            //'PR_CODA',
            //'BASE',
            //'PR_DOWNPER',
            //'PR_ANTIPASS',
            //'PR_RANDOM',
            //'VE_IP',
            //'PR_ANTIPASSGEN',
            //'PR_ESCLAVO',
            //'PR_COMIDADIARIA',
            //'PR_HUELLASMATCHER',
            //'PR_RESTRICCION',
            //'PR_KEY_MIFARE',
            //'PR_CANTCOMIDA',
            //'PR_IP_SERVER2',
            //'PR_IP_SERVER3',
            //'PR_IP_SERVER4',
            //'PR_TIPOLOG',
            //'PR_GRABAIMAGENCAMARA',
            //'PR_DELETELOG',
            //'PR_CLAVE_ENCRIPTADA',
            //'PR_CONTROL_TIEMPO',
            //'PR_CONTROL_MARCA',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
