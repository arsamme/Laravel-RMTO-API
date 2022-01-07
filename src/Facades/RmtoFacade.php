<?php

namespace Rmto\Facades;

use Illuminate\Support\Facades\Facade;

class RmtoFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'rmto';
    }
}