<?php

namespace app\domain\services;

use app\forms\IdentityProfileForm;
use app\models\IdentityProfile;

class IdentityProfileService
{
    public function findByIdentityId(int $identityId): ?IdentityProfile
    {
        return IdentityProfile::find()
            ->with(['identityContacts'])
            ->where(['identity_id' => $identityId])
            ->one();
    }

    public function create(IdentityProfileForm $model): IdentityProfile
    {
    }

    public function update(IdentityProfileForm $model, IdentityProfile $profile): IdentityProfile
    {
    }
}