<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_PERMISOEMP".
 *
 * @property string $NOMINA_ID
 * @property int $P_CAPTURAH
 * @property int $P_CAPTURAF
 * @property int $P_PERMISOS
 * @property int $P_NOTIFICACION
 * @property int $P_DOCUMENTOS
 * @property int $P_CREDENCIAL
 * @property int $P_MUEVEUSER
 * @property int $P_EXPORTA
 * @property int $P_CAMBIOMASIVO
 * @property int $P_LISTOCONTROL
 * @property int $P_IMPORTAVIRDI
 * @property int $P_RESTRICCION
 * @property int $P_REPORTE
 * @property int $P_CAPTURAR
 */
class TblPermisoemp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_PERMISOEMP';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_onlycontrol');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NOMINA_ID'], 'required'],
            [['P_CAPTURAH', 'P_CAPTURAF', 'P_PERMISOS', 'P_NOTIFICACION', 'P_DOCUMENTOS', 'P_CREDENCIAL', 'P_MUEVEUSER', 'P_EXPORTA', 'P_CAMBIOMASIVO', 'P_LISTOCONTROL', 'P_IMPORTAVIRDI', 'P_RESTRICCION', 'P_REPORTE', 'P_CAPTURAR'], 'integer'],
            [['NOMINA_ID'], 'string', 'max' => 10],
            [['NOMINA_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'NOMINA_ID' => 'Nomina ID',
            'P_CAPTURAH' => 'P Capturah',
            'P_CAPTURAF' => 'P Capturaf',
            'P_PERMISOS' => 'P Permisos',
            'P_NOTIFICACION' => 'P Notificacion',
            'P_DOCUMENTOS' => 'P Documentos',
            'P_CREDENCIAL' => 'P Credencial',
            'P_MUEVEUSER' => 'P Mueveuser',
            'P_EXPORTA' => 'P Exporta',
            'P_CAMBIOMASIVO' => 'P Cambiomasivo',
            'P_LISTOCONTROL' => 'P Listocontrol',
            'P_IMPORTAVIRDI' => 'P Importavirdi',
            'P_RESTRICCION' => 'P Restriccion',
            'P_REPORTE' => 'P Reporte',
            'P_CAPTURAR' => 'P Capturar',
        ];
    }
}
