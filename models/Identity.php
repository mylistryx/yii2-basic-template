<?php

namespace app\models;

use yii\base\BaseObject;
use yii\web\IdentityInterface;

class Identity extends BaseObject implements IdentityInterface
{
    public null|int|string $id = null;
    public ?string $username = null;
    public ?string $password = null;
    public ?string $authKey = null;
    public ?string $accessToken = null;

    private static array $identityList = [
        '100' => [
            'id'          => '100',
            'username'    => 'admin',
            'password'    => 'admin',
            'authKey'     => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id'          => '101',
            'username'    => 'demo',
            'password'    => 'demo',
            'authKey'     => 'test101key',
            'accessToken' => '101-token',
        ],
    ];

    public static function findIdentity($id): ?static
    {
        return isset(self::$identityList[$id]) ? new static(self::$identityList[$id]) : null;
    }

    public static function findIdentityByAccessToken($token, $type = null): ?static
    {
        foreach (self::$identityList as $identity) {
            if ($identity['accessToken'] === $token) {
                return new static($identity);
            }
        }

        return null;
    }

    public static function findByUsername($username): ?static
    {
        foreach (self::$identityList as $identity) {
            if (strcasecmp($identity['username'], $username) === 0) {
                return new static($identity);
            }
        }

        return null;
    }

    public function getId(): int|string
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey(): ?string
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword(string $password): bool
    {
        return $this->password === $password;
    }
}
