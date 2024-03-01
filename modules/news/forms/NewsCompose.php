<?php

namespace app\modules\news\forms;

use app\modules\news\models\News;
use yii\base\Model;

class NewsCompose extends Model
{
  public function rules(): array
  {
    return [];
  }

  public function save(bool $runValidation = true, ?array $attributeNames = null): bool
  {
    if (!$this->validate()) {
      return false;
    }

    $model = new News();
    $model->setAttributes($this->attributes);
    return $model->save($runValidation, $attributeNames);
  }
}