<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Tblserver */

$this->title = $model->PR_ID;
$this->params['breadcrumbs'][] = ['label' => 'Tblservers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tblserver-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->PR_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->PR_ID], [
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
            'PR_ID',
            'PR_SE',
            'PR_COD',
            'PR_Log',
            'PR_LHora',
            'PR_IP',
            'PR_FINGER',
            'PR_LD',
            'PR_LT',
            'PR_F1',
            'PR_F2',
            'PR_F3',
            'PR_F4',
            'PR_UCOD',
            'PR_CODA',
            'BASE',
            'PR_DOWNPER',
            'PR_ANTIPASS',
            'PR_RANDOM',
            'VE_IP',
            'PR_ANTIPASSGEN',
            'PR_ESCLAVO',
            'PR_COMIDADIARIA',
            'PR_HUELLASMATCHER',
            'PR_RESTRICCION',
            'PR_KEY_MIFARE',
            'PR_CANTCOMIDA',
            'PR_IP_SERVER2',
            'PR_IP_SERVER3',
            'PR_IP_SERVER4',
            'PR_TIPOLOG',
            'PR_GRABAIMAGENCAMARA',
            'PR_DELETELOG',
            'PR_CLAVE_ENCRIPTADA',
            'PR_CONTROL_TIEMPO',
            'PR_CONTROL_MARCA',
        ],
    ]) ?>

</div>
