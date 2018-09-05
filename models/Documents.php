<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for table "documents".
 *
 * @property int $id ID DOCUMENTO
 * @property string $filename NOMBRE DOCUMENTO
 * @property string $filetype TIPO DOCUMENTO
 * @property string $description DETALLE DOCUMENTO
 * @property string $date FECHA
 * @property int $external_id ID RELACION
 * @property string $external_type TIPO RELACION
 * @property string $username NOMBRE USUARIO
 * @property int $status ESTADO
 */
class Documents extends \yii\db\ActiveRecord
{
    public $attachment;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'documents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['filename', 'filetype', 'description', 'date', 'external_id', 'external_type', 'username', 'status'], 'required'],
            [['attachment'], 'file', 'extensions' => 'pdf'],
            [['description'], 'string'],
            [['date'], 'safe'],
            [['external_id', 'status'], 'integer'],
            [['filename', 'username'], 'string', 'max' => 255],
            [['filetype', 'external_type'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID DOCUMENTO'),
            'attachment' => Yii::t('app', 'DOCUMENTO ADJUNTO'),
            'filename' => Yii::t('app', 'NOMBRE DOCUMENTO'),
            'filetype' => Yii::t('app', 'TIPO DOCUMENTO'),
            'description' => Yii::t('app', 'DETALLE DOCUMENTO'),
            'date' => Yii::t('app', 'FECHA'),
            'external_id' => Yii::t('app', 'ID RELACION'),
            'external_type' => Yii::t('app', 'TIPO RELACION'),
            'username' => Yii::t('app', 'NOMBRE USUARIO'),
            'status' => Yii::t('app', 'ESTADO'),
        ];
        }

        //Función Subir Archivos
        //https://www.yiiframework.com/doc/guide/2.0/en/input-file-upload

        public function upload($model)
        {
            if ($this->validate()) {
                $this->attachment->saveAs('uploads/documents/' . $model->filename . '.' . $model->filetype);
                return true;
            } else {
                return false;
            }
        }
}
