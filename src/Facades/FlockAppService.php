<?php

/**
 * Created by PhpStorm.
 * User: swapnils
 * Date: 09/02/18
 * Time: 11:38 AM
 */
namespace SwapnilSarwe\LaravelFlockClient\Facades;

use Illuminate\Support\Facades\Facade;

class FlockAppService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'flockappservice';
    }
}