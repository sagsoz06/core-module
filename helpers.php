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

if(! function_exists('localize_trans_url')) {
    function localize_trans_url($locale, $transKeyName, $attributes = array()) {
        return LaravelLocalization::getURLFromRouteNameTranslated($locale, $transKeyName, $attributes);
    }
}

if(! function_exists('localize_url')) {
    /**
     * Returns an URL adapted to $locale
     *
     * @param  string|boolean 	$locale	   	Locale to adapt, false to remove locale
     * @param  string|false		$url		URL to adapt in the current language. If not passed, the current url would be taken.
     * @param  array 		$attributes	Attributes to add to the route, if empty, the system would try to extract them from the url.
     *
     * @return string|false				URL translated, False if url does not exist
     */
    function localize_url($locale=null, $url=null, $attributes=array()) {
        return LaravelLocalization::getLocalizedURL($locale, $url, $attributes);
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
