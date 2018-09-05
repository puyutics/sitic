<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "it_processes_purchase".
 *
 * @property int $id ID RELACION
 * @property int $it_processes_id ID PROCESO
 * @property int $inv_purchase_id ID COMPRA
 * @property int $status ESTADO
 *
 * @property InvPurchase $invPurchase
 * @property ItProcesses $itProcesses
 */
class ItProcessesPurchase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'it_processes_purchase';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['it_processes_id', 'inv_purchase_id', 'status'], 'required'],
            [['it_processes_id', 'inv_purchase_id', 'status'], 'integer'],
            [['inv_purchase_id'], 'exist', 'skipOnError' => true, 'targetClass' => InvPurchase::className(), 'targetAttribute' => ['inv_purchase_id' => 'id']],
            [['it_processes_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItProcesses::className(), 'targetAttribute' => ['it_processes_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID RELACION'),
            'it_processes_id' => Yii::t('app', 'ID PROCESO'),
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
    public function getItProcesses()
    {
        return $this->hasOne(ItProcesses::className(), ['id' => 'it_processes_id']);
    }
}
