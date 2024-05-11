<?php

namespace app\widgets\commentWidget\forms;

use app\components\model\Form;

class CommentForm extends Form
{
    public ?string $message = null;

    public function __construct(
        private readonly Identity $identity,
                                  $config = [],
    ) {
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['message'], 'required'],
            [['message'], 'string', 'length' => [1, 255]],
        ];
    }

    public function save(): bool
    {
        return
    }
}