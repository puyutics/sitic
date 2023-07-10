<?php

namespace app\models\eva_pregrado;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\eva_pregrado\MdlAttendanceSessions;

/**
 * MdlAttendanceSessionsSearch represents the model behind the search form of `app\models\eva_pregrado\MdlAttendanceSessions`.
 */
class MdlAttendanceSessionsSearch extends MdlAttendanceSessions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'attendanceid', 'groupid', 'sessdate', 'duration', 'lasttaken', 'lasttakenby', 'timemodified', 'descriptionformat', 'studentscanmark', 'allowupdatestatus', 'studentsearlyopentime', 'autoassignstatus', 'automark', 'automarkcompleted', 'statusset', 'absenteereport', 'preventsharedip', 'preventsharediptime', 'caleventid', 'calendarevent', 'includeqrcode', 'rotateqrcode', 'automarkcmid'], 'integer'],
            [['description', 'studentpassword', 'subnet', 'rotateqrcodesecret'], 'safe'],
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
        $query = MdlAttendanceSessions::find();

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
            'attendanceid' => $this->attendanceid,
            'groupid' => $this->groupid,
            'sessdate' => $this->sessdate,
            'duration' => $this->duration,
            'lasttaken' => $this->lasttaken,
            'lasttakenby' => $this->lasttakenby,
            'timemodified' => $this->timemodified,
            'descriptionformat' => $this->descriptionformat,
            'studentscanmark' => $this->studentscanmark,
            'allowupdatestatus' => $this->allowupdatestatus,
            'studentsearlyopentime' => $this->studentsearlyopentime,
            'autoassignstatus' => $this->autoassignstatus,
            'automark' => $this->automark,
            'automarkcompleted' => $this->automarkcompleted,
            'statusset' => $this->statusset,
            'absenteereport' => $this->absenteereport,
            'preventsharedip' => $this->preventsharedip,
            'preventsharediptime' => $this->preventsharediptime,
            'caleventid' => $this->caleventid,
            'calendarevent' => $this->calendarevent,
            'includeqrcode' => $this->includeqrcode,
            'rotateqrcode' => $this->rotateqrcode,
            'automarkcmid' => $this->automarkcmid,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'studentpassword', $this->studentpassword])
            ->andFilterWhere(['like', 'subnet', $this->subnet])
            ->andFilterWhere(['like', 'rotateqrcodesecret', $this->rotateqrcodesecret]);

        return $dataProvider;
    }
}
