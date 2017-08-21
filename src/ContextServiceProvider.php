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
            config(['app.name' => $site->name]);
            config(['session.domain' => $site->login_domain]);
            config(['app.url' => $site->domain]);
            config(['mail.from.name' => $site->brand->name, 'mail.from.address' => $site->brand->mail_from_address]);
            config(['services.facebook.redirect' => ($site->is_secure ? 'https://' : 'http://') . rtrim($site->login_domain, '/') . '/facebook/callback']);
            config(['services.facebook.client_id' => $site->facebook_id]);
            config(['services.facebook.client_secret' => $site->facebook_secret]);
            app()->setLocale($site->locale);
        }

    }
}