<?php

namespace app\models\siad_pregrado;

use Yii;

/**
 * This is the model class for table "malla_curricular".
 *
 * @property double $idMc
 * @property string $idCarr
 * @property string $idAsig
 * @property integer $idAnio
 * @property integer $idSemestre
 * @property string $idef
 * @property integer $num_creditos
 * @property integer $horas_semanales
 * @property string $caracter
 * @property integer $status
 * @property string $org_mallacurr
 * @property string $anio_habilitacion
 * @property string $codigo
 * @property string $fecha_registro
 * @property string $usu_registra
 * @property string $fecha_modif
 * @property string $usu_modif
 * @property integer $imp
 *
 * @property Carrera $idCarr0
 * @property Asignatura $idAsig0
 * @property Mallacurricularperiodo[] $mallacurricularperiodos
 */
class MallaCurricular extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'malla_curricular';
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
            [['idAnio', 'idSemestre', 'num_creditos', 'horas_semanales', 'status', 'imp'], 'integer'],
            [['idef', 'num_creditos', 'horas_semanales', 'caracter', 'org_mallacurr', 'anio_habilitacion', 'codigo', 'fecha_registro', 'usu_registra', 'usu_modif', 'imp'], 'required'],
            [['fecha_registro', 'fecha_modif'], 'safe'],
            [['idCarr'], 'string', 'max' => 6],
            [['idAsig', 'usu_registra', 'usu_modif'], 'string', 'max' => 10],
            [['idef'], 'string', 'max' => 3],
            [['caracter'], 'string', 'max' => 20],
            [['org_mallacurr'], 'string', 'max' => 2],
            [['anio_habilitacion'], 'string', 'max' => 4],
            [['codigo'], 'string', 'max' => 30],
            [['idCarr'], 'exist', 'skipOnError' => true, 'targetClass' => Carrera::className(), 'targetAttribute' => ['idCarr' => 'idCarr']],
            [['idAsig'], 'exist', 'skipOnError' => true, 'targetClass' => Asignatura::className(), 'targetAttribute' => ['idAsig' => 'IdAsig']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idMc' => 'Id Mc',
            'idCarr' => 'Id Carr',
            'idAsig' => 'Id Asig',
            'idAnio' => 'Id Anio',
            'idSemestre' => 'Id Semestre',
            'idef' => 'Idef',
            'num_creditos' => 'Num Creditos',
            'horas_semanales' => 'Horas Semanales',
            'caracter' => 'Caracter',
            'status' => 'Status',
            'org_mallacurr' => 'Org Mallacurr',
            'anio_habilitacion' => 'Anio Habilitacion',
            'codigo' => 'Codigo',
            'fecha_registro' => 'Fecha Registro',
            'usu_registra' => 'Usu Registra',
            'fecha_modif' => 'Fecha Modif',
            'usu_modif' => 'Usu Modif',
            'imp' => 'Imp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCarr0()
    {
        return $this->hasOne(Carrera::className(), ['idCarr' => 'idCarr']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAsig0()
    {
        return $this->hasOne(Asignatura::className(), ['IdAsig' => 'idAsig']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMallacurricularperiodos()
    {
        return $this->hasMany(Mallacurricularperiodo::className(), ['idMc' => 'idMc']);
    }
}

