<?php

return [
    /*
    |--------------------------------------------------------------------------
    | The prefix that'll be used for the administration
    |--------------------------------------------------------------------------
    */
    'admin-prefix'              => 'backend',

    /*
    |--------------------------------------------------------------------------
    | Location where your themes are located
    |--------------------------------------------------------------------------
    */
    'themes_path'               => base_path() . '/Themes',

    /*
    |--------------------------------------------------------------------------
    | Which administration theme to use for the back end interface
    |--------------------------------------------------------------------------
    */
    'admin-theme'               => 'AdminLTE',

    /*
    |--------------------------------------------------------------------------
    | AdminLTE skin
    |--------------------------------------------------------------------------
    | You can customize the AdminLTE colors with this setting. The following
    | colors are available for you to use: skin-blue, skin-green,
    | skin-black, skin-purple, skin-red and skin-yellow.
    */
    'skin'                      => 'skin-blue',

    /*
    |--------------------------------------------------------------------------
    | WYSIWYG Backend Editor
    |--------------------------------------------------------------------------
    | Define which editor you would like to use for the backend wysiwygs.
    | These classes are event handlers, listening to EditorIsRendering
    | you can define your own handlers and use them here
    | Options:
    | - \Modules\Core\Events\Handlers\LoadCkEditor::class
    | - \Modules\Core\Events\Handlers\LoadSimpleMde::class
    */
    'wysiwyg-handler'           => \Modules\Core\Events\Handlers\LoadCkEditor::class,

    /*
    |--------------------------------------------------------------------------
    | Custom CKeditor configuration file
    |--------------------------------------------------------------------------
    | Define a custom CKeditor configuration file to instead of the one
    | provided by default. This is useful if you wish to customise
    | the toolbar and other possible options.
    */
    'ckeditor-config-file-path' => '',

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    | You can customise the Middleware that should be loaded.
    | The localizationRedirect middleware is automatically loaded for both
    | Backend and Frontend routes.
    */
    'middleware'                => [
        'backend'  => [
            'auth.admin'
        ],
        'frontend' => [
            'minify', 'https'
        ],
        'api'      => [
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Define which assets will be available through the asset manager
    |--------------------------------------------------------------------------
    | These assets are registered on the asset manager
    */
    'admin-assets'              => [
        // Css
        'bootstrap.css'                  => ['theme' => 'vendor/bootstrap/dist/css/bootstrap.min.css'],
        'font-awesome.css'               => ['theme' => 'vendor/font-awesome/css/font-awesome.min.css'],
        'alertify.core.css'              => ['theme' => 'css/vendor/alertify/alertify.core.css'],
        'alertify.default.css'           => ['theme' => 'css/vendor/alertify/alertify.default.css'],
        'dataTables.bootstrap.css'       => ['theme' => 'vendor/datatables.net-bs/css/dataTables.bootstrap.min.css'],
        'icheck.blue.css'                => ['theme' => 'vendor/iCheck/skins/flat/blue.css'],
        'AdminLTE.css'                   => ['theme' => 'vendor/admin-lte/dist/css/AdminLTE.css'],
        'AdminLTE.all.skins.css'         => ['theme' => 'vendor/admin-lte/dist/css/skins/_all-skins.min.css'],
        'asgard.css'                     => ['theme' => 'css/asgard.css'],
        //'gridstack.css' => ['module' => 'dashboard:vendor/gridstack/dist/gridstack.min.css'],
        'gridstack.css'                  => ['module' => 'dashboard:gridstack/gridstack.min.css'],
        'daterangepicker.css'            => ['theme' => 'vendor/admin-lte/plugins/daterangepicker/daterangepicker-bs3.css'],
        'selectize.css'                  => ['module' => 'core:vendor/selectize/dist/css/selectize.css'],
        'selectize-default.css'          => ['module' => 'core:vendor/selectize/dist/css/selectize.default.css'],
        'animate.css'                    => ['theme' => 'vendor/animate.css/animate.min.css'],
        'pace.css'                       => ['theme' => 'vendor/admin-lte/plugins/pace/pace.min.css'],
        'select2.css'                    => ['theme' => 'vendor/select2/select2.min.css'],
        'simplemde.css'                  => ['theme' => 'vendor/simplemde/dist/simplemde.min.css'],
        // Javascript
        'bootstrap.js'                   => ['theme' => 'vendor/bootstrap/dist/js/bootstrap.min.js'],
        'mousetrap.js'                   => ['theme' => 'js/vendor/mousetrap.min.js'],
        'alertify.js'                    => ['theme' => 'js/vendor/alertify/alertify.js'],
        'icheck.js'                      => ['theme' => 'vendor/iCheck/icheck.min.js'],
        'jquery.dataTables.js'           => ['theme' => 'vendor/datatables.net/js/jquery.dataTables.min.js'],
        'dataTables.bootstrap.js'        => ['theme' => 'vendor/datatables.net-bs/js/dataTables.bootstrap.min.js'],
        'jquery.slug.js'                 => ['theme' => 'js/vendor/jquery.slug.js'],
        'app.js'                         => ['theme' => 'vendor/admin-lte/dist/js/app.js'],
        'keypressAction.js'              => ['module' => 'core:js/keypressAction.js'],
        'ckeditor.js'                    => ['theme' => 'js/vendor/ckeditor/ckeditor.js'],
        'lodash.js'                      => ['module' => 'dashboard:vendor/lodash/lodash.min.js'],
        'jquery-ui-core.js'              => ['module' => 'dashboard:vendor/jquery-ui/ui/minified/core.min.js'],
        'jquery-ui-widget.js'            => ['module' => 'dashboard:vendor/jquery-ui/ui/minified/widget.min.js'],
        'jquery-ui-mouse.js'             => ['module' => 'dashboard:vendor/jquery-ui/ui/minified/mouse.min.js'],
        'jquery-ui-draggable.js'         => ['module' => 'dashboard:vendor/jquery-ui/ui/minified/draggable.min.js'],
        'jquery-ui-resizable.js'         => ['module' => 'dashboard:vendor/jquery-ui/ui/minified/resizable.min.js'],
        //'gridstack.js' => ['module' => 'dashboard:vendor/gridstack/dist/gridstack.min.js'],
        'gridstack.js'                   => ['module' => 'dashboard:gridstack/gridstack.min.js'],
        'daterangepicker.js'             => ['theme' => 'vendor/admin-lte/plugins/daterangepicker/daterangepicker.js'],
        'selectize.js'                   => ['module' => 'core:vendor/selectize/dist/js/standalone/selectize.min.js'],
        'main.js'                        => ['theme' => 'js/main.js'],
        'chart.js'                       => ['theme' => 'vendor/admin-lte/plugins/chartjs/Chart.js'],
        'pace.js'                        => ['theme' => 'vendor/admin-lte/plugins/pace/pace.min.js'],
        'moment.js'                      => ['theme' => 'vendor/moment/min/moment-with-locales.min.js'],
        'clipboard.js'                   => ['theme' => 'vendor/clipboard/dist/clipboard.min.js'],
        'sortable.js'                    => ['theme' => 'vendor/jquery-sortable/source/js/jquery-sortable-min.js'],
        'select2.js'                     => ['theme' => 'vendor/select2/select2.min.js'],
        'cookie.js'                      => ['theme' => 'js/vendor/jquery.cookie.js'],
        'semantic.js'                    => ['theme' => 'vendor/semantic/dist/semantic.min.js'],
        'semantic.css'                   => ['theme' => 'vendor/semantic/dist/semantic.min.css'],
        'x-editable.js'                  => ['theme' => 'vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js'],
        'x-editable.css'                 => ['theme' => 'vendor/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css'],
        'bootstrap-wysihtml5.js'         => ['theme' => 'js/vendor/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'],
        'bootstrap-wysihtml5.css'        => ['theme' => 'css/vendor/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'],
        'bootstrap-daterangepicker.js'   => ['theme' => 'vendor/bootstrap-daterangepicker/daterangepicker.js'],
        'bootstrap-daterangepicker.css'  => ['theme' => 'vendor/bootstrap-daterangepicker/daterangepicker.css'],
        'bootstrap-datepicker.js'        => ['theme' => 'vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'],
        'bootstrap-datepicker.css'       => ['theme' => 'vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css'],
        'bootstrap-datetimepicker.js'    => ['theme' => 'vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js'],
        'bootstrap-datetimepicker.css'   => ['theme' => 'vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'],
        'simplemde.js'                   => ['theme' => 'vendor/simplemde/dist/simplemde.min.js'],
        'bootstrap-colorpicker.js'       => ['theme' => 'vendor/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js'],
        'bootstrap-colorpicker.css'      => ['theme' => 'vendor/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css'],
        'jquery.inputmask.js'            => ['theme' => 'vendor/inputmask/dist/inputmask/jquery.inputmask.js'],
        'inputmask.extensions.js'        => ['theme' => 'vendor/inputmask/dist/inputmask/inputmask.extensions.js'],
        'jquery.inputmask.bundle.min.js' => ['theme' => 'vendor/inputmask/dist/min/jquery.inputmask.bundle.min.js'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Define which default assets will always be included in your pages
    | through the asset pipeline
    |--------------------------------------------------------------------------
    */
    'admin-required-assets'     => [
        'css' => [
            'semantic.css',
            'bootstrap.css',
            'font-awesome.css',
            'alertify.core.css',
            'alertify.default.css',
            'dataTables.bootstrap.css',
            'icheck.blue.css',
            'select2.css',
            'AdminLTE.css',
            'AdminLTE.all.skins.css',
            'animate.css',
            'pace.css',
            'selectize-default.css',
            'asgard.css',
            'bootstrap-wysihtml5.css',
            'bootstrap-datetimepicker.css',
        ],
        'js'  => [
            'bootstrap.js',
            'semantic.js',
            'mousetrap.js',
            'alertify.js',
            'icheck.js',
            'jquery.dataTables.js',
            'dataTables.bootstrap.js',
            'jquery.slug.js',
            'keypressAction.js',
            'app.js',
            'pace.js',
            'selectize.js',
            'select2.js',
            'cookie.js',
            'bootstrap-wysihtml5.js',
            'moment.js',
            'bootstrap-datetimepicker.js',
            'main.js',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Enable module view overrides at theme locations
    |--------------------------------------------------------------------------
    */
    'enable-theme-overrides'    => true,
];
