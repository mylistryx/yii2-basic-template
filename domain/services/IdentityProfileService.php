<?php

namespace app\domain\services;

use app\forms\IdentityProfileForm;
use app\records\IdentityProfileAr;

class IdentityProfileService
{
    public function findByIdentityId(int $identityId): ?IdentityProfileAr
    {
        return IdentityProfileAr::find()
            ->with(['identityContacts'])
            ->where(['identity_id' => $identityId])
            ->one();
    }

    public function create(IdentityProfileForm $model): IdentityProfileAr
    {
    }

    public function update(IdentityProfileForm $model, IdentityProfileAr $profile): IdentityProfileAr
    {
    }
}