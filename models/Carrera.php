<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "carrera".
 *
 * @property string $idCarr
 * @property string $NombCarr
 * @property string $nivelCarr
 * @property integer $StatusCarr
 * @property string $codCarr_senescyt
 * @property integer $mod_id
 * @property string $sau_id
 * @property string $info_adicional
 * @property string $info_sieval
 * @property integer $id_tc
 * @property string $inst_cod
 *
 * @property MallaCurricular[] $mallaCurriculars
 * @property Matricula[] $matriculas
 * @property PracticasPreprof[] $practicasPreprofs
 */
class Carrera extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
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
        return Yii::$app->get('db_siad');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCarr', 'codCarr_senescyt', 'id_tc', 'inst_cod'], 'required'],
            [['StatusCarr', 'mod_id', 'id_tc'], 'integer'],
            [['idCarr'], 'string', 'max' => 6],
            [['NombCarr', 'info_adicional'], 'string', 'max' => 45],
            [['nivelCarr', 'info_sieval'], 'string', 'max' => 20],
            [['codCarr_senescyt'], 'string', 'max' => 8],
            [['sau_id'], 'string', 'max' => 4],
            [['inst_cod'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCarr' => 'Id Carr',
            'NombCarr' => 'Nomb Carr',
            'info_adicional' => 'Informacion',
            'info_sieval' => 'Evaluador Sieval',
            'nivelCarr' => 'Nivel Carr',
            'StatusCarr' => 'Status Carr',
            'codCarr_senescyt' => 'Cod Carr Senescyt',
            'mod_id' => 'Mod ID',
            'sau_id' => 'Sau ID',
            'id_tc' => 'Id Tc',
            'inst_cod' => 'Inst Cod',
        ];
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPracticasPreprofs()
    {
        return $this->hasMany(PracticasPreprof::className(), ['carrera' => 'idCarr']);
    }

    public function getCarreraFull(){
        return $this->idCarr." : ".$this->NombCarr;
    }

    public function getFullname()
    {
        return $this->NombCarr." ".$this->info_adicional;
    }
}

