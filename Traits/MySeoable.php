<?php namespace Modules\Core\Traits;

use Arcanedev\SeoHelper\Traits\Seoable;

trait MySeoable
{
    use Seoable;

    public function getAlternateLanguages($route) {
        return collect(\LaravelLocalization::getSupportedLocales())->keys()->except(0)->map(function($language) use ($route){
            if($language!=locale()) {
                return ['lang'=>$language, 'url'=>url(\LaravelLocalization::getURLFromRouteNameTranslated($language, $route))];
            }
        })->toArray();
    }
}