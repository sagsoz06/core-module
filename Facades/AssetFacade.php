<?php namespace Modules\Core\Facades;

use Illuminate\Support\Facades\Facade;
use Roumen\Asset\Asset;

class AssetFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Asset::class;
    }
}