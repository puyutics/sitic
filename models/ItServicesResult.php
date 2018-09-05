<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "it_services_result".
 *
 * @property int $id ID RESULTADO
 * @property int $it_services_id ID SERVICIO
 * @property int $year AÑO
 * @property string $description DETALLE
 * @property int $percent PORCENTAJE
 * @property string $date FECHA
 * @property string $username
 *
 * @property ItServices $itServices
 */
class ItServicesResult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'it_services_result';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['it_services_id', 'year', 'description', 'percent', 'date', 'username'], 'required'],
            [['it_services_id', 'year'], 'integer'],
            [['description'], 'string'],
            [['date'], 'safe'],
            [['percent'], 'double','max' => '100','min' => '0','numberPattern' => '/^[0-9]{1,3}(\.([0-9]{0,2})){0,1}$/'],
            [['username'], 'string', 'max' => 255],
            [['it_services_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItServices::className(), 'targetAttribute' => ['it_services_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID RESULTADO'),
            'it_services_id' => Yii::t('app', 'ID SERVICIO'),
            'year' => Yii::t('app', 'AÑO'),
            'description' => Yii::t('app', 'DETALLE'),
            'percent' => Yii::t('app', 'PORCENTAJE'),
            'date' => Yii::t('app', 'FECHA'),
            'username' => Yii::t('app', 'USUARIO'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItServices()
    {
        return $this->hasOne(ItServices::className(), ['id' => 'it_services_id']);
    }
}
