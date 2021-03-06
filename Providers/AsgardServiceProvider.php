<?php

namespace Modules\Core\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Database\Mariadb\MariaDBServiceProvider;
use Modules\Translation\Providers\TranslationServiceProvider;
use Nwidart\Modules\Facades\Module;
use Nwidart\Modules\LaravelModulesServiceProvider;

class AsgardServiceProvider extends ServiceProvider
{
    public function register()
    {
        if ($this->app->runningInConsole() === false && class_exists(TranslationServiceProvider::class)) {
            $this->app->register(TranslationServiceProvider::class);
        }
        $this->app->register(MariaDBServiceProvider::class);
        $this->app->register(LaravelModulesServiceProvider::class);

        $loader = AliasLoader::getInstance();
        $loader->alias('Module', Module::class);
    }
}
