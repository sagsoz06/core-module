<?php

return [
    'site-name'                   => [
        'description'  => 'core::settings.site-name',
        'view'         => 'text',
        'translatable' => true,
    ],
    'site-name-mini'              => [
        'description'  => 'core::settings.site-name-mini',
        'view'         => 'text',
        'translatable' => true,
    ],
    'site-description'            => [
        'description'  => 'core::settings.site-description',
        'view'         => 'textarea',
        'translatable' => true,
    ],
    'cookie-law'                  => [
        'description'  => 'core::settings.cookie-law',
        'view'         => 'textarea',
        'translatable' => true,
    ],
    'template'                    => [
        'description' => 'core::settings.template',
        'view'        => 'core::fields.select-theme',
    ],
    'analytics-script'            => [
        'description'  => 'core::settings.analytics-script',
        'view'         => 'textarea',
        'translatable' => false,
    ],
    'locales'                     => [
        'description'  => 'core::settings.locales',
        'view'         => 'core::fields.select-locales',
        'translatable' => false,
    ],
    'google-analytics'            => [
        'description'  => 'core::settings.google-analytics',
        'view'         => 'text',
        'translatable' => false,
    ],
    'google-verification-code'    => [
        'description'  => 'core::settings.google-verification-code',
        'view'         => 'text',
        'translatable' => false,
    ],
    'bing-verification-code'      => [
        'description'  => 'core::settings.bing-verification-code',
        'view'         => 'text',
        'translatable' => false,
    ],
    'alexa-verification-code'     => [
        'description'  => 'core::settings.alexa-verification-code',
        'view'         => 'text',
        'translatable' => false,
    ],
    'pinterest-verification-code' => [
        'description'  => 'core::settings.pinterest-verification-code',
        'view'         => 'text',
        'translatable' => false,
    ],
    'yandex-verification-code'    => [
        'description'  => 'core::settings.yandex-verification-code',
        'view'         => 'text',
        'translatable' => false,
    ],
    'geo-position'                => [
        'description'  => 'core::settings.geo-position',
        'view'         => 'text',
        'translatable' => false,
    ],
];
