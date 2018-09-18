<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'TELEFONÍA';
?>

<div class="site-index">
        <div align="center">
            <h3><?= 'TELEFONÍA' ?></h3>
            <p>
                <?php //= Html::a(Yii::t('app', 'Agregar Impresora'), ['create'], ['class' => 'btn btn-success']) ?>
                <?= Html::a(Yii::t('app', 'PUYO'),
                    $url='index.php?r=phonesextensions/embedded&url=https://pbx.uea.edu.ec/index.php?menu=control_panel',
                    ['class' => 'btn btn-primary'])
                ?>
                <?= Html::a(Yii::t('app', 'CIPCA'),
                    $url='index.php?r=phonesextensions/embedded&url=https://pbx-cipca.uea.edu.ec/index.php?menu=control_panel',
                    ['class' => 'btn btn-primary'])
                ?>
                <?= Html::a(Yii::t('app', 'LAGO'),
                    $url='index.php?r=phonesextensions/embedded&url=https://pbx-lago.uea.edu.ec/index.php?menu=control_panel',
                    ['class' => 'btn btn-primary'])
                ?>
                <?= Html::a(Yii::t('app', 'PANGUI'),
                    $url='index.php?r=phonesextensions/embedded&url=https://pbx-pangui.uea.edu.ec/index.php?menu=control_panel',
                    ['class' => 'btn btn-primary'])
                ?>
            </p>
            <h4><a href=<?php echo $_GET['url']?> target="_blank"><?php echo $_GET['url']?></a></h4>
            <td><iframe src=<?php echo $_GET['url']?>
                        width=100% height=800></iframe></td>
        </div>
</div>
