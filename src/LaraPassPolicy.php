<?php

namespace Afiqiqmal\LaraPassPolicy;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Afiqiqmal\LaraPassPolicy\LaraPassPolicy
 */
class LaraPassPolicy extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'lara-pass';
    }
}
