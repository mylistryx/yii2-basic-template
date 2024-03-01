<?php

namespace app\modules\comments\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $comment_id
 * @property int $rate
 * @property int|null $created_by
 * @property string $created_at
 */
class CommentVote extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%comment_vote}}';
    }

    public function behaviors(): array
    {
        return [
          'Timestamp' => [
            'class' => TimestampBehavior::class,
            'value' => date('Y-m-d h:i:s'),
            'updatedAtAttribute' => false,
          ]
        ];
    }

    public function rules(): array
    {
        return [];
    }
}