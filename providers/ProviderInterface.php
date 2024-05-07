<?php

namespace app\providers;

use yii\base\Component;

interface ProviderInterface
{
    /**
     * @return Component
     */
    public function provide(): Component;
}