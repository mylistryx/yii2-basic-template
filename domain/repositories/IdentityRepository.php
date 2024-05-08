<?php

namespace app\domain\repositories;

use app\domain\exceptions\EntityNotFoundException;
use app\models\Identity;

class IdentityRepository
{
    public function findById(int|string $id, bool $thrownExceptionIfNotFound = true): ?Identity
    {
        return $this->findByCondition(['id' => $id], $thrownExceptionIfNotFound);
    }

    public function findByEmail(string $email, bool $thrownExceptionIfNotFound = true): ?Identity
    {
        return $this->findByCondition(['email' => $email], $thrownExceptionIfNotFound);
    }

    public function findByEmailConfirmationToken(string $token, bool $thrownExceptionIfNotFound = true): ?Identity
    {
        return $this->findByCondition(['email_confirmation_token' => $token], $thrownExceptionIfNotFound);
    }

    public function findByPasswordResetToken(string $token, bool $thrownExceptionIfNotFound = true): ?Identity
    {
        return $this->findByCondition(['password_reset_token' => $token], $thrownExceptionIfNotFound);
    }

    public function findByAccessToken(string $token, bool $thrownExceptionIfNotFound = true): ?Identity
    {
        return $this->findByCondition(['access_token' => $token], $thrownExceptionIfNotFound);
    }

    private function findByCondition($condition, bool $thrownExceptionIfNotFound = true): ?Identity
    {
        if ($identity = Identity::findOne($condition)) {
            return $identity;
        }

        if ($thrownExceptionIfNotFound) {
            throw new EntityNotFoundException(Identity::class, 'Identity not found');
        }

        return null;
    }
}