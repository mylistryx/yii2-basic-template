<?php

namespace app\repositories;

use app\exceptions\EntityNotFoundException;
use app\models\Identity;

class IdentityRepository
{
    public function findById(int|string $id, bool $thrownExceptionIfNotFound = true): ?Identity
    {
        if ($identity = Identity::findOne(['id' => $id])) {
            return $identity;
        }

        if ($thrownExceptionIfNotFound) {
            throw new EntityNotFoundException();
        }

        return null;
    }

    public function findByEmail(string $email, bool $thrownExceptionIfNotFound = true): ?Identity
    {
        if ($identity = Identity::findOne(['email' => $email])) {
            return $identity;
        }

        if ($thrownExceptionIfNotFound) {
            throw new EntityNotFoundException();
        }

        return null;
    }

    public function findByEmailConfirmationToken(string $token, bool $thrownExceptionIfNotFound = true): ?Identity
    {
        if ($identity = Identity::findOne(['email_confirmation_token' => $token])) {
            return $identity;
        }

        if ($thrownExceptionIfNotFound) {
            throw new EntityNotFoundException();
        }

        return null;
    }

    public function findByPasswordResetToken(string $token, bool $thrownExceptionIfNotFound = true): ?Identity
    {
        if ($identity = Identity::findOne(['password_reset_token' => $token])) {
            return $identity;
        }

        if ($thrownExceptionIfNotFound) {
            throw new EntityNotFoundException();
        }

        return null;
    }

    public function findByAccessToken(string $token, bool $thrownExceptionIfNotFound = true): ?Identity
    {
        if ($identity = Identity::findOne(['access_token' => $token])) {
            return $identity;
        }

        if ($thrownExceptionIfNotFound) {
            throw new EntityNotFoundException();
        }

        return null;
    }
}