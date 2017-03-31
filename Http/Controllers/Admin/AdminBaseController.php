<?php

namespace Modules\Core\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Core\Foundation\Asset\Manager\AssetManager;
use Modules\Core\Foundation\Asset\Pipeline\AssetPipeline;
use Modules\Core\Foundation\Asset\Types\AssetTypeFactory;
use Carbon\Carbon;

class AdminBaseController extends Controller
{
    /**
     * @var AssetManager
     */
    protected $assetManager;
    /**
     * @var AssetPipeline
     */
    protected $assetPipeline;
    /**
     * @var AssetTypeFactory
     */
    protected $assetFactory;

    public $locale;

    public function __construct()
    {
        $this->assetManager = app(AssetManager::class);
        $this->assetPipeline = app(AssetPipeline::class);
        $this->assetFactory = app(AssetTypeFactory::class);

        $this->addAssets();
        $this->requireDefaultAssets();

        $this->locale = \LaravelLocalization::getCurrentLocale();

        /* Set Locales */
        if(\App::environment()=='local') {
            setlocale(LC_TIME, $this->locale.'-'.strtoupper($this->locale));
        } else {
            setlocale(LC_TIME, $this->locale.'_'.strtoupper($this->locale));
        }
        Carbon::setLocale($this->locale);
    }

    /**
     * Add the assets from the config file on the asset manager.
     */
    private function addAssets()
    {
        foreach (config('asgard.core.core.admin-assets') as $assetName => $path) {
            $path = $this->assetFactory->make($path)->url();
            $this->assetManager->addAsset($assetName, $path);
        }
    }

    /**
     * Require the default assets from config file on the asset pipeline.
     */
    private function requireDefaultAssets()
    {
        $this->assetPipeline->requireCss(config('asgard.core.core.admin-required-assets.css'));
        $this->assetPipeline->requireJs(config('asgard.core.core.admin-required-assets.js'));
    }
}
