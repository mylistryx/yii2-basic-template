<?php

namespace app\forms;

use app\components\model\CompositeForm;

/**
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $birthday
 */
class IdentityProfileForm extends CompositeForm
{
    public ?string $name = null;
    public ?string $surname = null;
    public ?string $patronymic = null;
    public ?string $birthday = null;
    public array $contacts = [];

    public function __construct(
        public readonly int $identity_id,
        array               $config = [],
    ) {
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['name', 'surname', 'patronymic', 'birthday'], 'required'],
            [['name', 'surname', 'patronymic'], 'string', 'max' => 32],
            ['birthday', 'date', 'format' => 'php:Y-m-d'],
            ['contacts', 'safe'],
        ];
    }
}