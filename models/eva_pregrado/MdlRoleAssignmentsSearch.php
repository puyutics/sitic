<?php

namespace app\models\eva_pregrado;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\eva_pregrado\MdlRoleAssignments;

/**
 * MdlRoleAssignmentsSearch represents the model behind the search form of `app\models\eva_pregrado\MdlRoleAssignments`.
 */
class MdlRoleAssignmentsSearch extends MdlRoleAssignments
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'roleid', 'contextid', 'userid', 'timemodified', 'modifierid', 'itemid', 'sortorder'], 'integer'],
            [['component'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = MdlRoleAssignments::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'roleid' => $this->roleid,
            'contextid' => $this->contextid,
            'userid' => $this->userid,
            'timemodified' => $this->timemodified,
            'modifierid' => $this->modifierid,
            'itemid' => $this->itemid,
            'sortorder' => $this->sortorder,
        ]);

        $query->andFilterWhere(['like', 'component', $this->component]);

        return $dataProvider;
    }
}
