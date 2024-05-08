<?php

use app\models\Identity;
use yii\caching\ArrayCache;
use yii\caching\FileCache;
use yii\console\Application as ConsoleApplication;
use yii\rbac\DbManager;
use yii\web\Application as WebApplication;
use yii\web\User;

class Yii
{
    public static ConsoleApplication|__Application|WebApplication $app;
}

/**
 * @property DbManager $authManager
 * @property User|__WebUser $user
 * @property ArrayCache $arrayCache
 * @property FileCache $cache
 *
 */
class __Application
{
}

/**
 * @property Identity $identity
 */
class __WebUser
{
}
