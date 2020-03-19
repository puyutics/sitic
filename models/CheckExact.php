<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "CHECKEXACT".
 *
 * @property int $EXACTID
 * @property int $USERID
 * @property string $CHECKTIME
 * @property string $CHECKTYPE
 * @property int $ISADD
 * @property string $YUYIN
 * @property int $ISMODIFY
 * @property int $ISDELETE
 * @property int $INCOUNT
 * @property int $ISCOUNT
 * @property string $MODIFYBY
 * @property string $DATE
 */
class CheckExact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'CHECKEXACT';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_biometrico');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['EXACTID', 'USERID', 'CHECKTIME'], 'required'],
            [['EXACTID', 'USERID', 'ISADD', 'ISMODIFY', 'ISDELETE', 'INCOUNT', 'ISCOUNT'], 'integer'],
            [['CHECKTIME', 'DATE'], 'safe'],
            [['CHECKTYPE'], 'string', 'max' => 2],
            [['YUYIN'], 'string', 'max' => 25],
            [['MODIFYBY'], 'string', 'max' => 20],
            [['EXACTID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'EXACTID' => 'Exactid',
            'USERID' => 'Userid',
            'CHECKTIME' => 'Checktime',
            'CHECKTYPE' => 'Checktype',
            'ISADD' => 'Isadd',
            'YUYIN' => 'Yuyin',
            'ISMODIFY' => 'Ismodify',
            'ISDELETE' => 'Isdelete',
            'INCOUNT' => 'Incount',
            'ISCOUNT' => 'Iscount',
            'MODIFYBY' => 'Modifyby',
            'DATE' => 'Date',
        ];
    }
}
