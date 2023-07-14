<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    public static bool $withoutAppends = false;

    public function scopeWithoutAppends($query)
    {
        self::$withoutAppends = true;
        return $query;
    }

    protected function getArrayableAppends(): array
    {
        if (self::$withoutAppends) {
            return [];
        }
        return parent::getArrayableAppends();
    }
}
