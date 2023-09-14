<?php

use app\repositories\identity\IdentityRepositoryActiveRecord;
use app\repositories\identity\IdentityRepositoryInterface;

$container = Yii::$container;

$container->set(IdentityRepositoryInterface::class, IdentityRepositoryActiveRecord::class);