<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Resource;

/**
 * ChannelGroupsSearch represents the model behind the search form of `common\models\ChannelGroups`.
 */
class ResourceSearch extends Resource
{   

    public $search_term;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['search_term'],'string'],
            [['search_term'], 'trim'],
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
        $query = Resource::find();
       
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5                                                                                                                         ,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

      
        if($this->search_term) {
           $query->andFilterWhere(['like', 'file_path', $this->search_term]);
        }
        return $dataProvider;
    }
}
