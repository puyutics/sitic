<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;
use kartik\icons\Icon;
Icon::map($this);

$this->title = 'Sincronizador: SIAD >> EVA Pregrado';
$this->params['breadcrumbs'][] = $this->title;

?>

<h1 align="center" class="alert alert-primary"><?= Html::encode($this->title) ?></h1>

<h3 align="center" class="alert alert-info">
    Logs | Período >> <?= Yii::$app->params['course_code'] ?>
</h3>

<div class="col-sm-offset-0 col-sm-12">
    <?php echo TabsX::widget([
        'position' => TabsX::POS_ABOVE,
        'align' => TabsX::ALIGN_CENTER,
        'sideways'=>false,
        'bordered'=>false,
        'encodeLabels'=>false,
        'enableStickyTabs' => true,
        'items' => [
            [
                'label' => Icon::show('globe').' Web',
                'content' => $this->render('_mdl_enrol_logs_web')
            ],
            [
                'label' => Icon::show('terminal').' Consola',
                'content' => $this->render('_mdl_enrol_logs_console')
            ],
        ],
    ]);
    ?>
</div>