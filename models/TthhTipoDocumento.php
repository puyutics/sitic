<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tthh_tipo_documento".
 *
 * @property string $id_td
 * @property string $documento
 * @property string $descripcion
 *
 * @property TthhAsistencia[] $tthhAsistencias
 */
class TthhTipoDocumento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tthh_tipo_documento';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_sisges');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_td'], 'required'],
            [['descripcion'], 'string'],
            [['id_td'], 'string', 'max' => 2],
            [['documento'], 'string', 'max' => 20],
            [['id_td'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_td' => 'Id Td',
            'documento' => 'Documento',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTthhAsistencias()
    {
        return $this->hasMany(TthhAsistencia::className(), ['idx_tipodocumento' => 'id_td']);
    }
}
