<?php

namespace app\repositories;

use app\exceptions\EntityNotFoundException;
use app\models\Identity;

class IdentityRepository
{
    public function findById(int|string $id): Identity
    {
        return Identity::findOne($id) ?? throw new EntityNotFoundException();
    }

    public function findByEmail(string $email): Identity
    {
        return Identity::findOne(['email' => $email]) ?? throw new EntityNotFoundException();
    }

    public function findByEmailConfirmationToken(string $token): Identity
    {
        return Identity::findOne(['email_confirmation_token' => $token]) ?? throw new EntityNotFoundException();
    }

    public function findByPasswordResetToken(string $token): Identity
    {
        return Identity::findOne(['password_reset_token' => $token]) ?? throw new EntityNotFoundException();
    }

    public function findByAccessToken(string $token): Identity
    {
        return Identity::findOne(['access_token' => $token]) ?? throw new EntityNotFoundException();
    }
}