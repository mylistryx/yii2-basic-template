<?php

namespace app\search;

use app\models\View;
use yii\data\ActiveDataProvider;

class ViewSearch extends View
{
    public function rules(): array
    {
        return [];
    }

    public function search(?array $params = null, ?string $formName = null): ActiveDataProvider
    {
        $query = View::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}