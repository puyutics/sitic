<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "it_projects_parents".
 *
 * @property int $id ID RELACION
 * @property int $it_projects_id CODIGO PROYECTO
 * @property int $parent_id PROYECTO RELACIONADO
 * @property string $status ESTADO RELACION
 *
 * @property ItProjects $parent
 * @property ItProjects $itProjects
 */
class ItProjectsParents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'it_projects_parents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['it_projects_id', 'parent_id', 'status'], 'required'],
            [['it_projects_id', 'parent_id'], 'integer'],
            [['status'], 'string', 'max' => 45],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItProjects::className(), 'targetAttribute' => ['parent_id' => 'id']],
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
            'it_projects_id' => Yii::t('app', 'CODIGO PROYECTO'),
            'parent_id' => Yii::t('app', 'PROYECTO RELACIONADO'),
            'status' => Yii::t('app', 'ESTADO RELACION'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(ItProjects::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItProjects()
    {
        return $this->hasOne(ItProjects::className(), ['id' => 'it_projects_id']);
    }
}
