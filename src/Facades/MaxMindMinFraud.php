<?php

namespace IC\Laravel\MaxMindMinFraud\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the minFraud facade class.
 */
class MaxMindMinFraud extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'maxmind.minfraud';
    }
}
