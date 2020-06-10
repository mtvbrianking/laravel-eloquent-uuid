<?php

namespace Bmatovu\Uuid\Traits;

use Bmatovu\Uuid\Support\Util;
use Illuminate\Database\Eloquent\Model;

trait HasUuidKey
{
    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Model $model): void {
            if (! $model->getKey()) {
                $version = config('uuid.version');
                $namespace = config('uuid.namespace');
                $name = config('uuid.name');

                $model->{$model->getKeyName()} = Util::generateUuid($version, $namespace, $name)->toString();
            }
        });
    }
}
