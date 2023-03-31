<?php

namespace app\models\siad_pregrado;

use Yii;

/**
 * This is the model class for table "perlec_carr_est_nivel".
 *
 * @property int $plcen_id
 * @property int|null $idper
 * @property string|null $idcarr
 * @property string|null $ciinfper
 * @property int|null $creditos_aprob
 * @property int|null $creditos_perlec
 * @property int|null $nivel
 *
 * @property Estudiantes $ciinfper0
 * @property Carrera $idcarr0
 * @property Periodo $idper0
 */
class PerlecCarrEstNivel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perlec_carr_est_nivel';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_siad');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idper', 'creditos_aprob', 'creditos_perlec', 'nivel'], 'integer'],
            [['idcarr'], 'string', 'max' => 6],
            [['ciinfper'], 'string', 'max' => 20],
            [['ciinfper'], 'exist', 'skipOnError' => true, 'targetClass' => Estudiantes::className(), 'targetAttribute' => ['ciinfper' => 'CIInfPer']],
            [['idper'], 'exist', 'skipOnError' => true, 'targetClass' => Periodo::className(), 'targetAttribute' => ['idper' => 'idper']],
            [['idcarr'], 'exist', 'skipOnError' => true, 'targetClass' => Carrera::className(), 'targetAttribute' => ['idcarr' => 'idCarr']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'plcen_id' => 'Plcen ID',
            'idper' => 'Idper',
            'idcarr' => 'Idcarr',
            'ciinfper' => 'Ciinfper',
            'creditos_aprob' => 'Creditos Aprob',
            'creditos_perlec' => 'Creditos Perlec',
            'nivel' => 'Nivel',
        ];
    }

    /**
     * Gets query for [[Ciinfper0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCiinfper0()
    {
        return $this->hasOne(Estudiantes::className(), ['CIInfPer' => 'ciinfper']);
    }

    /**
     * Gets query for [[Idcarr0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdcarr0()
    {
        return $this->hasOne(Carrera::className(), ['idCarr' => 'idcarr']);
    }

    /**
     * Gets query for [[Idper0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdper0()
    {
        return $this->hasOne(Periodo::className(), ['idper' => 'idper']);
    }
}
