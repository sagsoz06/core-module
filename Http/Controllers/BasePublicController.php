<?php

namespace Modules\Core\Http\Controllers;

use Arcanedev\SeoHelper\Entities\Analytics;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\MySeoable;
use Modules\Page\Repositories\PageRepository;
use Modules\User\Contracts\Authentication;
use Carbon\Carbon;
use Breadcrumbs;

abstract class BasePublicController extends Controller
{
    use MySeoable;
    /**
     * @var Authentication
     */
    protected $auth;
    public $locale;

    public function __construct()
    {
        $this->locale = \LaravelLocalization::getCurrentLocale();
        $this->auth = app(Authentication::class);

        /* Set Locales */
        setlocale(LC_TIME,
            $this->locale.'_'.strtoupper($this->locale).'.UTF-8'
        );
        Carbon::setLocale($this->locale);

        /* Set Domain for Assets */
        \Asset::setDomain('//');

        /* Default Breadcrumbs */
        $homepage = app(PageRepository::class)->findHomepage();

        Breadcrumbs::setView('partials.breadcrumbs');
        if(!app()->runningInConsole()) {
            Breadcrumbs::register('home', function($breadcrumbs) use ($homepage)
            {
                $breadcrumbs->push($homepage->title, route('homepage'));
            });
        }

        /* Default Seo Meta */
        $this->seo()->setSiteName(setting('core::site-name-mini') ? setting('core::site-name-mini') : setting('core::site-name'));

        $this->seoMeta()->addWebmaster('google', setting('core::google-verification-code'))
                        ->addWebmaster('bing', setting('core::bing-verification-code'))
                        ->addWebmaster('alexa', setting('core::alexa-verification-code'))
                        ->addWebmaster('pinterest', setting('core::pinterest-verification-code'))
                        ->addWebmaster('yandex', setting('core::yandex-verification-code'))
                        ->addMeta('charset', 'utf-8')
                        ->addMeta('geo-region', 'TR-06')
                        ->addMeta('geo-position', setting('core::geo-position'))
                        ->addMeta('ICBM', setting('core::geo-position'))
                        ->addMeta('author', 'http://www.qbicom.com.tr')
                        ->addMeta('copyrights', 'Qbicom Digital')
                        ->addMeta('robots', 'index,follow');

        $this->seoGraph()->setTitle(setting('core::site-name'))
             ->setDescription(setting('core::site-description'));

        if(preg_match('/[^\/]+$/', setting('theme::twitter'), $matches))
        $this->seoCard()->setSite("@$matches[0]");

        /* Analytics Code */
        $analytics = new Analytics();
        $analytics->setGoogle(setting('core::google-analytics'));
        view()->share('googleAnalytics', $analytics->render());
    }
}
