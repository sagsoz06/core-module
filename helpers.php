<?php

if (! function_exists('on_route')) {
    function on_route($route)
    {
        return Route::current() ? Route::is($route) : false;
    }
}

if (! function_exists('locale')) {
    function locale($locale = null)
    {
        if (is_null($locale)) {
            return app()->getLocale();
        }

        app()->setLocale($locale);

        return app()->getLocale();
    }
}

if (! function_exists('is_module_enabled')) {
    function is_module_enabled($module)
    {
        return array_key_exists($module, app('modules')->enabled());
    }
}

if (! function_exists('is_core_module')) {
    function is_core_module($module)
    {
        return in_array(strtolower($module), app('asgard.ModulesList'));
    }
}

if (! function_exists('formatMilliseconds')) {
    function formatMilliseconds($seconds)
    {
        $hours = 0;
        $milliseconds = str_replace( "0.", '', $seconds - floor( $seconds ) );
        if ( $seconds > 3600 )
        {
            $hours = floor( $seconds / 3600 );
        }
        $seconds = $seconds % 3600;
        return str_pad( $hours, 2, '0', STR_PAD_LEFT )
        . gmdate( ':i:s', $seconds )
        . ($milliseconds ? ".$milliseconds" : '');
    }
}

if(! function_exists('getTranslations')) {
    function getTranslations($translations, $route=null, $url=null)
    {
        if(count($translations)>0) {
            $locales = [];
            foreach ($translations as $translation) {
                if ($translation->locale == LaravelLocalization::getCurrentLocale()) continue;
                $url = !empty($route) ? route($route, [$translation->slug]) : !empty($url) ? url($translation->locale.$url.$translation->slug) : '';
                $locales[] = ['language' => $translation->locale, 'url' => $url];
            }
            return $locales;
        }
        return null;
    }
}

if(! function_exists('getURLFromRouteNameTranslated')) {
    function getURLFromRouteNameTranslated($locale, $transKeyName, $attributes = []) {
        return LaravelLocalization::getURLFromRouteNameTranslated($locale, $transKeyName, $attributes);
    }
}

if (! function_exists('placeholdit'))
{
    function placeholdit($width = 100, $height = '', $text = '', $colors = '')
    {
        $dimentions = 'w='.$width.( !empty($height) ? 'x='.$height : '');
        //$text = !empty($text) ? '&text='.urlencode($text) : '';
        $colors = !empty($colors) ? explode(' ', $colors) : '';
        $colors = !empty($colors) ? '/'.$colors[0].'/'.$colors[1] : '';
        return "https://placeholdit.imgix.net/~text?txtsize=16&txt=$text&w=$width&h=$height";
    }
}
