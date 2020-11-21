<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sys_email".
 *
 * @property int $id ID
 * @property string $from DE
 * @property string $replyto RESPONDER A
 * @property string $to PARA
 * @property string $cc CC
 * @property string $cco CCO
 * @property string $subject ASUNTO
 * @property string $body TEXTO
 * @property string $attach ADJUNTO
 * @property string $datetime FECHA
 * @property int $status ESTADO
 */
class SysEmail extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_email';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from', 'replyto', 'to', 'subject', 'body'], 'required'],
            [['from', 'replyto', 'cc', 'cco', 'body', 'attach'], 'string'],
            [['datetime'], 'safe'],
            [['status'], 'integer'],
            [['subject'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from' => 'DE',
            'replyto' => 'RESPONDER A',
            'to' => 'PARA',
            'cc' => 'CC',
            'cco' => 'CCO',
            'subject' => 'ASUNTO',
            'body' => 'TEXTO',
            'attach' => 'ADJUNTO',
            'datetime' => 'FECHA',
            'status' => 'ESTADO',
        ];
    }
}
