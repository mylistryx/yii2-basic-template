<?php

namespace app\modules\comments\models;

use app\modules\comments\enums\CommentStatusEnum;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $type_id
 * @property int $type_item_id
 * @property string $text
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Comment extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%comments}}';
    }

    public function behaviors(): array
    {
        return [
          'Timestamp' => [
            'class' => TimestampBehavior::class,
            'value' => date('Y-m-d H:i:s'),
          ],
          'Blameable' => [
            'class' => BlameableBehavior::class,
          ],
        ];
    }

    public static function find(): CommentQuery
    {
        return new CommentQuery(get_called_class());
    }

    public function isActive(): bool
    {
        return $this->status === CommentStatusEnum::Approved->value;
    }
}