<?php

declare(strict_types=1);

namespace Snowflake;

use Godruoyi\Snowflake\Snowflake;

trait HasSnowflakeId
{
    /**
     * Boot the trait and add the creating model event listener
     * to generate a Snowflake ID when creating a new model.
     */
    protected static function bootHasSnowflakeId(): void
    {
        static::creating(function ($model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (int) self::newSnowflakeId();
            }
        });
    }

    /** Get the columns that should receive a unique identifier. */
    public function uniqueIds(): array
    {
        return [$this->getKeyName()];
    }

    /** Generate a new UUID for the model. */
    private static function newSnowflakeId(): int
    {
        return (int) snowflake();
    }

    /**
     * Get the auto-incrementing key type.
     */
    public function getKeyType(): string
    {
        if (in_array($this->getKeyName(), $this->uniqueIds())) {
            return 'int';
        }

        return $this->keyType;
    }

    /** Get the value indicating whether the IDs are incrementing. */
    public function getIncrementing(): bool
    {
        if (in_array($this->getKeyName(), $this->uniqueIds())) {
            return false;
        }

        return $this->incrementing;
    }

    public function isSnowflake($value): bool
    {
        return is_int($value) && $value > 0;
    }
}
