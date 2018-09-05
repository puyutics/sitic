<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "it_projects_purchase".
 *
 * @property int $id ID RELACION
 * @property int $it_projects_id ID PROYECTO
 * @property int $inv_purchase_id ID COMPRA
 * @property int $status ESTADO
 *
 * @property InvPurchase $invPurchase
 * @property ItProjects $itProjects
 */
class ItProjectsPurchase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'it_projects_purchase';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['it_projects_id', 'inv_purchase_id', 'status'], 'required'],
            [['it_projects_id', 'inv_purchase_id', 'status'], 'integer'],
            [['inv_purchase_id'], 'exist', 'skipOnError' => true, 'targetClass' => InvPurchase::className(), 'targetAttribute' => ['inv_purchase_id' => 'id']],
            [['it_projects_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItProjects::className(), 'targetAttribute' => ['it_projects_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID RELACION'),
            'it_projects_id' => Yii::t('app', 'ID PROYECTO'),
            'inv_purchase_id' => Yii::t('app', 'ID COMPRA'),
            'status' => Yii::t('app', 'ESTADO'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvPurchase()
    {
        return $this->hasOne(InvPurchase::className(), ['id' => 'inv_purchase_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItProjects()
    {
        return $this->hasOne(ItProjects::className(), ['id' => 'it_projects_id']);
    }
}
