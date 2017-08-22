<?php

namespace Bonnier\ContextService;

use Bonnier\ContextService\Context\Context;
use Bonnier\ContextService\Helpers\SiteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ContextServiceProvider extends ServiceProvider
{
    private $context;
    /**
     * Bootstrap any application services.
     *
     * @param \Illuminate\Http\Request $request
     * @param SiteRepository $siteRepository
     */

    public function boot(Request $request, SiteRepository $siteRepository)
    {
        $site = $siteRepository->findByDomain($request->getHost());
        $this->context = new Context($site);

        $this->app->singleton(Context::class, function () {
            return $this->context;
        });

        $this->prepareView();

        if($site && !defined('PHPUNIT_RUNNING')) {
            config(['app.name' => $site->getName()]);
            config(['session.domain' => $site->getLoginDomain()]);
            config(['app.url' => $site->getDomain()]);
            config(['mail.from.name' => $site->getBrand()->getName(), 'mail.from.address' => $site->getBrand()->getMailFromAddress()]);
            config(['services.facebook.redirect' => ($site->isSecure() ? 'https://' : 'http://') . rtrim($site->getLoginDomain(), '/') . '/facebook/callback']);
            config(['services.facebook.client_id' => $site->getFacebookId()]);
            config(['services.facebook.client_secret' => $site->getFacebookSecret()]);
            app()->setLocale($site->getLocale());
        }
    }

    private function prepareView()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'bpContext');
        View::share('bpContext', $this->context);

        Blade::directive('prod', function () {
            return "<?php if (config('app.env') == 'production'): ?>";
        });

        Blade::directive('endprod', function () {
            return "<?php endif; ?>";
        });
    }
}