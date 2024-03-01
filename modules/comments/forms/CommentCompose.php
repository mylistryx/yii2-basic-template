<?php

namespace app\modules\comments\forms;

use app\modules\comments\enums\CommentTypeEnum;
use app\modules\comments\models\Comment;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Model;

/**
 * @property string $text
 */
class CommentCompose extends Model
{
    public ?string $text = null;

    /**
     * @param CommentTypeEnum $itemType
     * @param int $itemId
     * @param array $config
     */
    public function __construct(
      private readonly CommentTypeEnum $itemType,
      private readonly int $itemId,
      array $config = []
    ) {
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
          [['text'], 'required'],
          [['text'], 'string', 'min' => 10],
        ];
    }

    /**
     * @param bool $runValidation
     * @param array|null $attributeNames
     * @return bool
     * @throws InvalidConfigException
     */
    public function save(bool $runValidation, ?array $attributeNames = null): bool
    {
        if ($runValidation && !$this->validate($attributeNames)) {
            return false;
        }
        $model = Yii::createObject(Comment::class, [$this->itemType, $this->itemId]);
        $model->setAttributes($this->attributes ?? []);
        return $model->save($runValidation, $attributeNames);
    }
}