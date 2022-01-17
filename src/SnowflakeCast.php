<?php declare(strict_types = 1);

namespace Snowflake;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class SnowflakeCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     */
    public function get($model, string $key, $value, array $attributes) : string
    {
        return (string) $value;
    }

    /**
     * Prepare the given value for storage.
     *
     */
    public function set($model, string $key, $value, array $attributes) : mixed
    {
        return (int) $value;
    }
}
