<?php namespace Modules\Core\Traits;

use Arcanedev\SeoHelper\Traits\Seoable;

trait MySeoable
{
    use Seoable;

    public function getAlternateLanguages($route) {
        return collect(\LaravelLocalization::getSupportedLocales())->keys()->map(function($language) use ($route){
            return ['lang'=>$language, 'url'=>url(\LaravelLocalization::getURLFromRouteNameTranslated($language, $route))];
        })->toArray();
    }
}