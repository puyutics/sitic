<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $model yii\web\View */

$dni = $model->dni;
$mail = $model->mail;

//Sin resultados para Buzones compartidos
if ($dni == '2002' and $mail != 'soporte@uea.edu.ec') {
    $dni = NULL;
}

//Buscar usuario en Onlycontrol
$oc_user = \app\models\onlycontrol\Nomina::find()
    ->where(['NOMINA_COD' => $dni])
    ->one();

if (isset($oc_user)) {
    $oc_user_id = $oc_user->NOMINA_ID;
    $oc_user_admin_bio = $oc_user->NOMINA_ADMIN_BIO;
} else {
    $oc_user_id = NULL;
}

$searchModelNomPuerta = new \app\models\onlycontrol\NomPuertaSearch();
$dataProviderNomPuerta = $searchModelNomPuerta->search(Yii::$app->request->queryParams);
$dataProviderNomPuerta->query->Where(['NOM_ID' => $oc_user_id]);
$dataProviderNomPuerta->sort->defaultOrder = ['PUER_ID' => SORT_ASC,];
$countDataProvider = $dataProviderNomPuerta->getTotalCount();
$dataProviderNomPuerta->pagination = ['pageSize' => $countDataProvider];
?>
<div class="nom-puerta-index">

    <?php if (!isset($oc_user)) { ?>
        <div class="alert alert-info" align="center">
            <h3 align="center">No existe información</h3>
        </div>
    <?php } else { ?>
        <div class="alert alert-info" align="center">
            <h3 align="center"><?= $oc_user->NOMINA_APE .' '. $oc_user->NOMINA_NOM ?></h3>
            <h4 align="center" style="color:palevioletred">Tipo: <?php if ($oc_user_admin_bio == 1) echo 'Administrador'; else echo 'Usuario'; ?></h4>
            <h4 align="center" style="color:palevioletred">Cédula: <?= $oc_user->NOMINA_COD ?></h4>
            <h4 align="center" style="color:palevioletred">Código: <?= $oc_user->NOMINA_ID ?></h4>
            <?= Html::a(Icon::show('eye') . 'Perfil',
                ['onlycontrol/nomina/profile', 'oc_user_id'=>base64_encode($oc_user_id)],
                ['class' => 'btn btn-primary','target' => '_blank']
            ); ?>
            <?= Html::a(Icon::show('fingerprint') . 'Accesos',
                ['onlycontrol/asistnow/indexuser', 'oc_user_id'=>base64_encode($oc_user_id)],
                ['class' => 'btn btn-primary','target' => '_blank']
            ); ?>
        </div>

        <?= GridView::widget([
            'dataProvider' => $dataProviderNomPuerta,
            //'filterModel' => $searchModelNomPuerta,
            'pjax'=>false,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'NOM_ID',
                [
                    'label' => 'Ubicación',
                    'value' => function ($model) {
                        $puerta = \app\models\onlycontrol\Puerta::findOne($model->PUER_ID);
                        return $puerta->PRI_EMPRESA_NOM
                            .'<br>('. $puerta->PRI_AREA1 .')';
                    },
                    'format' => 'html',
                    'group' => true,
                    'hAlign'=>'center',
                    'vAlign'=>'middle',
                ],
                [
                    'label' =>'Puerta',
                    'attribute' =>'PUER_ID',
                    'value' => function ($model) {
                        $puerta = \app\models\onlycontrol\Puerta::findOne($model->PUER_ID);
                        return $puerta->PRI_DES;
                    },
                    'format' => 'html'
                ],
                [
                    'label' =>'Conexión',
                    'value' => function ($model) {
                        $puerta = \app\models\onlycontrol\Puerta::findOne($model->PUER_ID);
                        if ($puerta->PRI_STA == 'OK') {
                            return '<p style="color:darkgreen">'. $puerta->PRI_STA .' '.Icon::show('plug').'</p>';
                        } elseif ($puerta->PRI_STA == 'UNPLUG') {
                            return '<p style="color:darkred">'. $puerta->PRI_STA .' '.Icon::show('plug').'</p>';
                        } else {
                            return '<p style="color:#f4c01a">'. $puerta->PRI_STA .' '.Icon::show('question').'</p>';
                        }
                    },
                    'format' => 'html',
                ],
                [
                    'label' =>'Modelo',
                    'value' => function ($model) {
                        $puerta = \app\models\onlycontrol\Puerta::findOne($model->PUER_ID);
                        return $puerta->PRI_VIRDI;
                    }
                ],
                [
                    'label' =>'Uso',
                    'value' => function ($model) {
                        $puerta = \app\models\onlycontrol\Puerta::findOne($model->PUER_ID);
                        return $puerta->PRI_TI;
                    }
                ],
                [
                    'label' =>'IP Address',
                    'value' => function ($model) {
                        $puerta = \app\models\onlycontrol\Puerta::findOne($model->PUER_ID);
                        return $puerta->PRI_IP;
                    }
                ],
                //'TURN_NOW',
                [
                    'label' => 'Tipo',
                    'attribute' => 'TURN_TCOD',
                ],
                [
                    'label' => 'Estado',
                    'attribute' => 'TURN_ESTADO_UP',
                    'value' => function ($model) {
                        if ($model->TURN_ESTADO_UP == 1) {
                            return '<p style="color:darkgreen">Sincronizado '.Icon::show('sync').'</p>';
                        } elseif ($model->TURN_ESTADO_UP == 0) {
                            return '<p style="color:darkred">Pendiente '.Icon::show('exclamation').'</p>';
                        } else {
                            return '<p style="color:#f4c01a">'. $model->TURN_ESTADO_UP .' '.Icon::show('question').'</p>';
                        }
                    },
                    'format' => 'html'
                ],
                //'TURN_FECHA_UP',
                //'TURN_ID',
                //'TURN_FECI',
                //'TURN_FECF',
                //'TURN_TIPO',
                //'TURN_STA',
                //'TURN_MARCA',
                //'TURN_SEL',
                //'ES_SINCRONIZADO',
                //'ES_UPDATE',
                //'TURN_CONFSIMILAR',

                ['class' => 'kartik\grid\ActionColumn',
                    'template'=>'{access}',
                    'buttons'=>[
                        'access' => function ($url, $model) {
                            $puerta = \app\models\onlycontrol\Puerta::findOne($model->PUER_ID);
                            return Html::a('<span class="btn btn-primary center-block">'.Icon::show('fingerprint') . 'Accesos'.'</span>',
                                Url::to(['onlycontrol/asistnow/indexuser', 'oc_user_id'=>base64_encode($model->NOM_ID), 'oc_zona'=>base64_encode($puerta->PRI_IP)]),
                                ['title' => Yii::t('yii', 'Accesos'),'target' => '_blank']);
                        },
                    ]
                ],

                //['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    <?php } ?>

</div>
