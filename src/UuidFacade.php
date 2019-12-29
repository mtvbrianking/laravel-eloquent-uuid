<?php

namespace Bmatovu\Uuid;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Bmatovu\Uuid\Uuid
 */
class UuidFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'uuid';
    }
}
