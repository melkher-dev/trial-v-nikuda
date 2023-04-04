<?php

namespace App;

use Illuminate\Support\Str;

trait UuidTrait
{
    /**
     *
     * @return void
     */
    public static function bootUuidTrait()
    {
        static::creating(function ($model) {
            $model->keyType = 'string';
            $model->incrementing = false;

            $model->{$model->getKeyName()} = $model->{$model->getKeyName()} ?: (string) Str::orderedUuid();
        });
    }

    /**
     * Undocumented function
     *
     * @return false
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }
}
