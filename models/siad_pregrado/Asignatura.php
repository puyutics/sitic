<?php

namespace app\models\siad_pregrado;

use Yii;

/**
 * This is the model class for table "asignatura".
 *
 * @property string $IdAsig
 * @property string $NombAsig
 * @property string $ColorAsig
 * @property integer $StatusAsig
 *
 * @property MallaCurricular[] $mallaCurriculars
 */
class Asignatura extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asignatura';
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
            [['IdAsig'], 'required'],
            [['StatusAsig'], 'integer'],
            [['IdAsig', 'ColorAsig'], 'string', 'max' => 10],
            [['NombAsig'], 'string', 'max' => 70],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdAsig' => 'Id Asig',
            'NombAsig' => 'Nomb Asig',
            'ColorAsig' => 'Color Asig',
            'StatusAsig' => 'Status Asig',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMallaCurriculars()
    {
        return $this->hasMany(MallaCurricular::className(), ['idAsig' => 'IdAsig']);
    }
}

