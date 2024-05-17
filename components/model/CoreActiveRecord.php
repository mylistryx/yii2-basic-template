<?php

namespace app\components\model;

use app\components\helpers\DateTimeHelper;
use app\exceptions\ModelSaveException;
use app\exceptions\TimeoutException;
use app\exceptions\ValidationException;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Schema as SchemaAlias;

class CoreActiveRecord extends ActiveRecord
{
    public const string TIMEOUT_IN_SECONDS = 'asSeconds';
    public const string TIMEOUT_IN_MINUTES = 'asMinutes';
    public const string TIMEOUT_IN_HOURS = 'asHours';
    public const string TIMEOUT_IN_DAYS = 'asDays';
    protected static string $customUuidAttribute = 'id';
    protected static string $customCreatedAtAttribute = 'created_at';
    protected static string $customUpdatedAtAttribute = 'updated_at';
    protected static string $customCreatedByAttribute = 'created_by';
    protected static string $customUpdatedByAttribute = 'updated_by';
    protected static string $customDeletedAtAttribute = 'deleted_at';
    protected static string $customDeletedByAttribute = 'deleted_by';

    public function __construct($config = [])
    {
        parent::__construct($config);
        if ($this->hasUuidColumn()) {
            $uuidAttribute = self::$customUuidAttribute;
            if (empty($this->$uuidAttribute)) {
                $this->$uuidAttribute = Uuid::uuid7();
            }
        }
    }

    public function hasUuidColumn(): bool
    {
        return isset(Yii::$app->db->schema->getTableSchema(static::tableName())->columns[self::$customUuidAttribute]);
    }

    public function saveOrPanic($runValidation = true, $attributeNames = null): bool
    {
        if (!parent::save($runValidation, $attributeNames)) {
            if ($this->hasErrors()) {
                throw new ValidationException($this);
            }

            throw new ModelSaveException($this);
        }

        return true;
    }

    public function checkTimeout(string $paramValue, DateTimeImmutable $attributeValue, $method = self::TIMEOUT_IN_SECONDS): static
    {
        $timeout = Yii::$app->params[$paramValue];

        $now = new DateTimeImmutable('now');
        $diffInSeconds = DateTimeHelper::$method($now->diff($attributeValue, true));

        if ($diffInSeconds < $timeout) {
            throw new TimeoutException($timeout - $diffInSeconds);
        }

        return $this;
    }

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        if ($this->hasCreatedAtColumn() || $this->hasUpdatedAtColumn()) {
            $columnIsDateTime = Yii::$app->db->schema
                    ->getTableSchema(static::tableName())
                    ->columns[$this->hasCreatedAtColumn() ? self::$customCreatedAtAttribute : self::$customUpdatedAtAttribute]->type === SchemaAlias::TYPE_DATETIME;

            $behaviors['timestamp'] = [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => $this->hasCreatedAtColumn() ? self::$customCreatedAtAttribute : false,
                'updatedAtAttribute' => $this->hasUpdatedAtColumn() ? self::$customUpdatedAtAttribute : false,
                'value' => $columnIsDateTime ? date('Y-m-d H:i:s') : time(),
            ];
        }

        if ($this->hasCreatedByColumn() || $this->hasCreatedByColumn()) {
            $behaviors['blameable'] = [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => $this->hasCreatedByColumn() ? self::$customCreatedByAttribute : false,
                'updatedByAttribute' => $this->hasUpdatedByColumn() ? self::$customUpdatedByAttribute : false,
            ];
        }

        return $behaviors;
    }

    public function hasCreatedAtColumn(): bool
    {
        return isset(Yii::$app->db->schema->getTableSchema(static::tableName())->columns[self::$customCreatedAtAttribute]);
    }

    public function hasUpdatedAtColumn(): bool
    {
        return isset(Yii::$app->db->schema->getTableSchema(static::tableName())->columns[self::$customUpdatedAtAttribute]);
    }

    public function hasCreatedByColumn(): bool
    {
        return isset(Yii::$app->db->schema->getTableSchema(static::tableName())->columns[self::$customCreatedByAttribute]);
    }

    public function hasUpdatedByColumn(): bool
    {
        return isset(Yii::$app->db->schema->getTableSchema(static::tableName())->columns[self::$customUpdatedByAttribute]);
    }

    public function hasDeletedAtAttribute(): bool
    {
        return isset(Yii::$app->db->schema->getTableSchema(static::tableName())->columns[self::$customDeletedAtAttribute]);
    }

    public function hasDeletedByAttribute(): bool
    {
        return isset(Yii::$app->db->schema->getTableSchema(static::tableName())->columns[self::$customDeletedByAttribute]);
    }

    public function stringToDateTime(string $value, string $format = 'Y-m-d H:i:s'): DateTimeImmutable
    {
        return DateTimeImmutable::createFromFormat($format, $value);
    }

    public function delete(string $format = 'Y-m-d H:i:s'): false|int
    {
        if ($this->hasDeletedAtAttribute()) {
            $deletedAtAttribute = self::$customDeletedAtAttribute;
            $columnIsDateTime = Yii::$app->db->schema
                    ->getTableSchema(static::tableName())
                    ->columns[self::$customDeletedAtAttribute]
                    ->type === SchemaAlias::TYPE_DATETIME;
            $this->$deletedAtAttribute = $columnIsDateTime ? date($format) : time();

            if ($this->hasDeletedByAttribute()) {
                $deleteBbyAttribute = self::$customDeletedByAttribute;
                $this->$deleteBbyAttribute = Yii::$app->user->isGuest ? null : Yii::$app->user->identity->getId();
            }

            return (int)$this->saveOrPanic();
        }

        return parent::delete();
    }
}