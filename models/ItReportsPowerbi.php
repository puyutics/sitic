<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "it_reports_powerbi".
 *
 * @property int $id ID REPORTE
 * @property string $description DETALLE
 * @property string $url URL
 * @property string $html_iframe HTML IFRAME
 * @property string $username USUARIO
 * @property int $status ESTADO
 */
class ItReportsPowerbi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'it_reports_powerbi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'url', 'html_iframe', 'username', 'status'], 'required'],
            [['description', 'url', 'html_iframe'], 'string'],
            [['status'], 'integer'],
            [['username'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID REPORTE'),
            'description' => Yii::t('app', 'DETALLE'),
            'url' => Yii::t('app', 'URL'),
            'html_iframe' => Yii::t('app', 'HTML IFRAME'),
            'username' => Yii::t('app', 'USUARIO'),
            'status' => Yii::t('app', 'ESTADO'),
        ];
    }
}
