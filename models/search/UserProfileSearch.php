<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserProfile;

/**
 * UserProfileSearch represents the model behind the search form about `app\models\UserProfile`.
 */
class UserProfileSearch extends UserProfile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'country', 'city', 'gender'], 'integer'],
            [['firstname', 'middlename', 'lastname', 'avatar_path', 'avatar_base_url', 'tel', 'locale'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = UserProfile::find();

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
            'user_id' => $this->user_id,
            'country' => $this->country,
            'city' => $this->city,
            'gender' => $this->gender,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'middlename', $this->middlename])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'avatar_path', $this->avatar_path])
            ->andFilterWhere(['like', 'avatar_base_url', $this->avatar_base_url])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'locale', $this->locale]);

        return $dataProvider;
    }
}
