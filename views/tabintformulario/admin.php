<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TabIntFormulario */

$this->title = 'Contrato: ' . $model->cedula;
$this->params['breadcrumbs'][] = ['label' => 'Contratos Recursos Académicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tab-int-formulario-view">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode($this->title) ?></h3>
    </div>
    <br>
    <div class="form-group" align="center">
        <?php
        echo Html::a('Perfil Completo Estudiante', 'index.php?r=tabintformulario/beneficiarioadmin&search='. $model->cedula, [
            'class'=>'btn btn-primary',
            'target'=>'_blank',
            'data-toggle'=>'tooltip',
            'title'=>'Ver perfil del estudiante'
        ]);
        ?>
        <?php
        echo Html::a('Imprimir Contrato PDF', '@web/uploads/tabintformulario/contrato/'. $model->doc_contrato, [
            'class'=>'btn btn-danger',
            'target'=>'_blank',
            'data-toggle'=>'tooltip',
            'title'=>'Abrir archivo PDF en una nueva pestaña'
        ]);
        ?>
        <?php
        echo Html::a('Cédula / Pasaporte', '@web/uploads/tabintformulario/cedula_pasaporte/'. $model->doc_cedula_pasaporte, [
            'class'=>'btn btn-primary',
            'target'=>'_blank',
            'data-toggle'=>'tooltip',
            'title'=>'Abrir Cédula / Pasaporte'
        ]);
        ?>
        <?php
        echo Html::a('Servicio Básico', '@web/uploads/tabintformulario/servicio_basico/'. $model->doc_servicio_basico, [
            'class'=>'btn btn-primary',
            'target'=>'_blank',
            'data-toggle'=>'tooltip',
            'title'=>'Abrir Servicio Básico'
        ]);
        ?>
        <?php
        echo Html::a('Foto Vivienda', '@web/uploads/tabintformulario/referencia_foto/'. $model->referencia_foto, [
            'class'=>'btn btn-primary',
            'target'=>'_blank',
            'data-toggle'=>'tooltip',
            'title'=>'Abrir Foto Vivienda'
        ]);
        ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'fec_registro',
            'cedula',
            'username',
            'email:email',
            'nombres',
            'apellidos',
            'codigo_postal',
            'provincia',
            'canton',
            'parroquia',
            'calle_principal',
            'calle_secundaria',
            'referencia_texto',
            //'referencia_foto',
            'cel_contacto',
            'tel_contacto',
            'siad_matriculado',
            'siad_semestre',
            'siad_carrera',
            'ficha_escasos_recursos',
            'encuesta_beneficiario',
            [
                'attribute' => 'cobertura',
                'value' => function($model) {
                    if ($model->cobertura == 1) {
                        return 'Acepto haber verificado que cuento con cobertura 3G o 4G para acceder al beneficio otorgado.';
                    } else {
                        return '-';
                    }
                }

            ],
            [
                'attribute' => 'smartphone',
                'value' => function($model) {
                    if ($model->smartphone == 1) {
                        return 'Cuento con un Dispositivo Móvil o Teléfono Inteligente (Smartphone), para utilizar la Tarjeta SIM con Internet Educativo Ilimitado.';
                    } else {
                        return '-';
                    }
                }

            ],
            [
                'attribute' => 'responsabilidad_uso',
                'value' => function($model) {
                    if ($model->responsabilidad_uso == 1) {
                        return 'Acepto haber leído en su totalidad y a entera satisfacción la Declaración de Responsabilidad para el uso de medios y servicios electrónicos que la Universidad Estatal Amazónica provee a través de su portal web.';
                    } else {
                        return '-';
                    }
                }

            ],
            [
                'attribute' => 'condiciones',
                'value' => function($model) {
                    if ($model->condiciones == 1) {
                        return 'Acepto haber leído en su totalidad y a entera satisfacción todos los términos y condiciones de la Universidad Estatal Amazónica. La información ingresada en este formulario es verdadera. Me responsabilizo de los recursos académicos a ser entregados. Acepto someterme a las leyes civiles, judiciales o penales, en caso de no cumplir con los términos y condiciones del contrato.';
                    } else {
                        return '-';
                    }
                }

            ],
            //'doc_cedula_pasaporte',
            //'doc_servicio_basico',
            //'doc_responsabilidad_uso',
            //'doc_contrato',
            //'qrcode',
            //'status',

        ],
    ]) ?>

</div>

<div align="center">
    <?php
    echo Html::a('Volver a Generar PDF', 'index.php?r=tabintformulario/contrato&id='. $model->id, [
        'class'=>'btn btn-danger',
        'target'=>'_blank',
        'data-toggle'=>'tooltip',
        'title'=>'Abrir archivo PDF en una nueva pestaña'
    ]);
    ?>
</div>