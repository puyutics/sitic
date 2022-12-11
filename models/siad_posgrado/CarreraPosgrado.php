<?php

namespace app\models\siad_posgrado;

use Yii;

/**
 * This is the model class for table "carrera".
 *
 * @property string $idCarr
 * @property string $NombCarr
 * @property string $nivelCarr
 * @property int $StatusCarr
 * @property string $codCarr_senescyt codigo oferta senescyt 
 * @property int $mod_id
 * @property string $sau_id
 * @property int $id_tc
 * @property string $inst_cod codigo de la institucion a la cual pertenece la carrera
 * @property string $info_adicional
 *
 * @property Cupoxcarrera[] $cupoxcarreras
 * @property Docenteperasig[] $docenteperasigs
 * @property MaestriaCarrera[] $maestriaCarreras
 * @property MallaCurricular[] $mallaCurriculars
 * @property Matricula[] $matriculas
 */
class CarreraPosgrado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carrera';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_siad_posgrado');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idCarr', 'codCarr_senescyt', 'id_tc', 'inst_cod'], 'required'],
            [['StatusCarr', 'mod_id', 'id_tc'], 'integer'],
            [['idCarr'], 'string', 'max' => 6],
            [['NombCarr'], 'string', 'max' => 100],
            [['nivelCarr'], 'string', 'max' => 20],
            [['codCarr_senescyt'], 'string', 'max' => 8],
            [['sau_id'], 'string', 'max' => 4],
            [['inst_cod'], 'string', 'max' => 12],
            [['info_adicional'], 'string', 'max' => 45],
            [['idCarr'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idCarr' => 'Id Carr',
            'NombCarr' => 'Nomb Carr',
            'nivelCarr' => 'Nivel Carr',
            'StatusCarr' => 'Status Carr',
            'codCarr_senescyt' => 'Cod Carr Senescyt',
            'mod_id' => 'Mod ID',
            'sau_id' => 'Sau ID',
            'id_tc' => 'Id Tc',
            'inst_cod' => 'Inst Cod',
            'info_adicional' => 'Info Adicional',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCupoxcarreras()
    {
        return $this->hasMany(Cupoxcarrera::className(), ['idcarr' => 'idCarr']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocenteperasigs()
    {
        return $this->hasMany(Docenteperasig::className(), ['idCarr' => 'idCarr']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaestriaCarreras()
    {
        return $this->hasMany(MaestriaCarrera::className(), ['idcarr' => 'idCarr']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMallaCurriculars()
    {
        return $this->hasMany(MallaCurricular::className(), ['idCarr' => 'idCarr']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatriculas()
    {
        return $this->hasMany(Matricula::className(), ['idCarr' => 'idCarr']);
    }

    public function getFullname()
    {
        return $this->info_adicional." - ".$this->NombCarr;
    }
}
