<?php

namespace app\modules\comments\models;

use yii\data\ActiveDataProvider;

class CommentSearch extends Comment
{
  public function rules(): array
  {
    return [];
  }

  public function search(array $params = []): ActiveDataProvider
  {
    $query = Comment::find();
    $dataProvider = new ActiveDataProvider([
      'query' => $query,
    ]);

    $this->load($params);
    if (!$this->validate()) {
      return $dataProvider;
    }
  }
}