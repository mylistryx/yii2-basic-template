<?php

namespace app\search;

use app\models\Identity;
use yii\data\ActiveDataProvider;

class IdentitySearch extends Identity
{
    public function rules(): array
    {
        return [
            ['id', 'integer'],
            ['uuid', 'string'],
            ['email', 'string'],
        ];
    }

    public function search(?array $params = null, ?string $formName = null): ActiveDataProvider
    {
        $query = Identity::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['LIKE', 'uuid', $this->uuid]);
        $query->andFilterWhere(['LIKE', 'email', $this->email]);

        return $dataProvider;
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'uuid' => 'Uuid',
            'email' => 'Email',
        ];
    }
}