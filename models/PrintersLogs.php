<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "printers_logs".
 *
 * @property int $id ID LOGS IMPRESION
 * @property string $date FECHA Y HORA IMPRESION
 * @property string $username NOMBRE DE USUARIO
 * @property int $pages NUMERO DE PAGINAS
 * @property int $copies NUMERO DE COPIAS
 * @property string $printer NOMBRE IMPRESORA
 * @property string $document NOMBRE DOCUMENTO
 * @property string $client NOMBRE DISPOSITIVO
 * @property string $paper FORMATO PAPEL
 * @property string $protocol PROTOCOLO IMPRESION
 * @property string $high ALTO HOJA
 * @property string $width ANCHO HOJA
 * @property string $duplex OPCION DUPLEX
 * @property string $grayscale IMPRESION CON ESCALA DE GRISES
 * @property string $size TAMANO DEL ARCHIVO
 */
class PrintersLogs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'printers_logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'pages', 'copies'], 'integer'],
            [['date'], 'safe'],
            [['username', 'printer', 'document'], 'string', 'max' => 255],
            [['client', 'paper', 'protocol', 'high', 'width', 'duplex', 'grayscale', 'size'], 'string', 'max' => 45],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID LOGS IMPRESION'),
            'date' => Yii::t('app', 'FECHA'),
            'username' => Yii::t('app', 'USUARIO'),
            'pages' => Yii::t('app', 'PAGINAS'),
            'copies' => Yii::t('app', 'COPIAS'),
            'printer' => Yii::t('app', 'IMPRESORA'),
            'document' => Yii::t('app', 'DOCUMENTO'),
            'client' => Yii::t('app', 'DISPOSITIVO'),
            'paper' => Yii::t('app', 'FORMATO PAPEL'),
            'protocol' => Yii::t('app', 'PROTOCOLO IMPRESION'),
            'high' => Yii::t('app', 'ALTO HOJA'),
            'width' => Yii::t('app', 'ANCHO HOJA'),
            'duplex' => Yii::t('app', 'OPCION DUPLEX'),
            'grayscale' => Yii::t('app', 'IMPRESION CON ESCALA DE GRISES'),
            'size' => Yii::t('app', 'TAMANO DEL ARCHIVO'),
        ];
    }
}
