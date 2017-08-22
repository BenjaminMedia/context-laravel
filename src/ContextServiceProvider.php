<?php

namespace Bonnier\ContextService;

use Bonnier\ContextService\Context\Context;
use Bonnier\ContextService\Helpers\SiteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ContextServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @param \Illuminate\Http\Request $request
     * @param SiteRepository $siteRepository
     */
    public function boot(Request $request, SiteRepository $siteRepository)
    {
        $site = $siteRepository->findByLoginDomain($request->getHost());
        $context = new Context($site);

        $this->app->singleton(Context::class, function () use($context) {
            return $context;
        });

        View::share('context', $context);

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
}