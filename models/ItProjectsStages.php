<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "it_projects_stages".
 *
 * @property int $id CODIGO ETAPA
 * @property string $project_stage ETAPA
 * @property string $description DETALLE
 * @property int $percent PORCENTAJE
 * @property int $it_projects_id ID PROYECTO
 *
 * @property ItProjects $itProjects
 */
class ItProjectsStages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'it_projects_stages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_stage', 'description', 'percent', 'it_projects_id'], 'required'],
            [['description'], 'string'],
            [['it_projects_id'], 'integer'],
            [['percent'], 'double','max' => '100','min' => '0','numberPattern' => '/^[0-9]{1,3}(\.([0-9]{0,2})){0,1}$/'],
            [['project_stage'], 'string', 'max' => 255],
            [['it_projects_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItProjects::className(), 'targetAttribute' => ['it_projects_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'CODIGO ETAPA'),
            'project_stage' => Yii::t('app', 'ETAPA'),
            'description' => Yii::t('app', 'DETALLE'),
            'percent' => Yii::t('app', 'PORCENTAJE'),
            'it_projects_id' => Yii::t('app', 'ID PROYECTO'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItProjects()
    {
        return $this->hasOne(ItProjects::className(), ['id' => 'it_projects_id']);
    }
}
