<?php

namespace app\models\siad_pregrado;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\siad_pregrado\AsistenciaAlumno;

/**
 * AsistenciaAlumnoSearch represents the model behind the search form of `app\models\siad_pregrado\AsistenciaAlumno`.
 */
class AsistenciaAlumnoSearch extends AsistenciaAlumno
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_asist', 'idPer', 'idnaa', 'numsesion_asal', 'presente', 'ausente', 'atraso', 'justificada', 'id_plasig'], 'integer'],
            [['ciinfper', 'fecha_asal', 'hora_asal', 'observacion_asal', 'fecha_creacion', 'fecha_modif', 'observacion', 'fecha_just_asal', 'usu_reg_just_asal'], 'safe'],
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
        $query = AsistenciaAlumno::find();

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
            'id_asist' => $this->id_asist,
            'fecha_asal' => $this->fecha_asal,
            'hora_asal' => $this->hora_asal,
            'idPer' => $this->idPer,
            'idnaa' => $this->idnaa,
            'numsesion_asal' => $this->numsesion_asal,
            'presente' => $this->presente,
            'ausente' => $this->ausente,
            'atraso' => $this->atraso,
            'justificada' => $this->justificada,
            'fecha_creacion' => $this->fecha_creacion,
            'fecha_modif' => $this->fecha_modif,
            'id_plasig' => $this->id_plasig,
            'fecha_just_asal' => $this->fecha_just_asal,
        ]);

        $query->andFilterWhere(['like', 'ciinfper', $this->ciinfper])
            ->andFilterWhere(['like', 'observacion_asal', $this->observacion_asal])
            ->andFilterWhere(['like', 'observacion', $this->observacion])
            ->andFilterWhere(['like', 'usu_reg_just_asal', $this->usu_reg_just_asal]);

        return $dataProvider;
    }
}
