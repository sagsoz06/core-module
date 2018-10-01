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

if (! function_exists('asgard_i18n_editor')) {
    function asgard_i18n_editor($fieldName, $labelName, $content, $lang)
    {
        return view('core::components.i18n.textarea-wrapper', compact('fieldName','labelName', 'content', 'lang'));
    }
}

if (! function_exists('asgard_editor')) {
    function asgard_editor($fieldName, $labelName, $content)
    {
        return view('core::components.textarea-wrapper', compact('fieldName','labelName', 'content'));
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

if (! function_exists('str_sentence')) {
    function str_sentence($body, $sentencesToDisplay=1) {
        $nakedBody = preg_replace('/\s+/',' ',strip_tags($body));
        $sentences = preg_split('/(\.|\?|\!)(\s)/',$nakedBody);

        if (count($sentences) <= $sentencesToDisplay)
            return $nakedBody;

        $stopAt = 0;
        foreach ($sentences as $i => $sentence) {
            $stopAt += strlen($sentence);

            if ($i >= $sentencesToDisplay - 1)
                break;
        }

        $stopAt += ($sentencesToDisplay * 2);
        return trim(substr($nakedBody, 0, $stopAt));
    }
}


if (! function_exists('localize_url')) {
    function localize_url($locale="tr") {
        $currentRoute = Request::route()->getName();
        switch ($currentRoute) {
            case 'page' && isset($page):
                $url = $page->present()->url($locale);
                break;
            case 'news.slug' && isset($post):
            case 'blog.slug' && isset($post):
                $url = $post->present()->url($locale);
                break;
            case 'news.category' && isset($category):
            case 'blog.category' && isset($category):
            case 'store.category.slug' && isset($category):
                $url = $category->present()->url($locale);
                break;
            case 'store.product.slug' && isset($product):
                $url = $product->present()->url($locale);
                break;
            case 'employee.view' && isset($employee):
                $url = $employee->present()->url($locale);
                break;
            default:
                $url = null;
                break;
        }
        $localizedUrl = LaravelLocalization::getLocalizedURL($locale, $url);
        return $localizedUrl;
    }
}