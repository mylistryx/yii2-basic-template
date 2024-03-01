<?php

namespace app\modules\comments\forms;

use app\modules\comments\models\CommentVote;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Model;

class CommentVoteCompose extends Model
{
    /**
     * @param int $commentId
     * @param int $identityId
     * @param array $config
     */
    public function __construct(
      private readonly int $commentId,
      private readonly int $identityId,
      array $config = []
    ) {
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
          [['commentId', 'identityId'], 'required'],
        ];
    }

    /**
     * @param bool $runValidation
     * @param array|null $attributeNames
     * @return bool
     * @throws InvalidConfigException
     */
    public function save(bool $runValidation = true, ?array $attributeNames = null): bool
    {
        if ($runValidation && !$this->validate($attributeNames)) {
            return false;
        }

        $model = Yii::createObject(CommentVote::class, [$this->commentId, $this->identityId]);
        $model->setAttributes($attributeNames ?? []);
        return $model->save();
    }
}