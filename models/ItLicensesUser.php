<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "it_licenses_user".
 *
 * @property int $id ID
 * @property int $it_licenses_id LICENCIA
 * @property string $username USUARIO
 * @property string $description DESCRIPCION
 * @property string $date_assigned FEC. ASIGNACION
 * @property string $date_released FEC. LIBERACION
 * @property int $status ESTADO
 *
 * @property User $username0
 * @property ItLicenses $itLicenses
 */
class ItLicensesUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'it_licenses_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['it_licenses_id', 'username', 'description', 'date_assigned', 'date_released', 'status'], 'required'],
            [['it_licenses_id', 'status'], 'integer'],
            [['description'], 'string'],
            [['date_assigned', 'date_released'], 'safe'],
            [['username'], 'string', 'max' => 255],
            [['username'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['username' => 'username']],
            [['it_licenses_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItLicenses::className(), 'targetAttribute' => ['it_licenses_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'it_licenses_id' => Yii::t('app', 'LICENCIA'),
            'username' => Yii::t('app', 'USUARIO'),
            'description' => Yii::t('app', 'DESCRIPCION'),
            'date_assigned' => Yii::t('app', 'FEC. ASIGNACION'),
            'date_released' => Yii::t('app', 'FEC. LIBERACION'),
            'status' => Yii::t('app', 'ESTADO'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsername0()
    {
        return $this->hasOne(User::className(), ['username' => 'username']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItLicenses()
    {
        return $this->hasOne(ItLicenses::className(), ['id' => 'it_licenses_id']);
    }
}
