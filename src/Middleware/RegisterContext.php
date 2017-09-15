<?php

namespace Bonnier\ContextService\Middleware;

use Bonnier\ContextService\Context\Context;
use Bonnier\ContextService\Models\BpSite;
use Bonnier\ContextService\Helpers\SiteRepository;
use Illuminate\Http\Request;

class RegisterContext
{
    public function handle(Request $request, \Closure $next)
    {
        $site = app(SiteRepository::class)->findByDomain($request->getHost());
        if ($site && !defined('PHPUNIT_RUNNING')) {
            config(['app.name' => $site->getName()]);
            config(['session.domain' => $site->getLoginDomain()]);
            config(['app.url' => $site->getDomain()]);
            config(['mail.from.name' => $site->getBrand()->getName(), 'mail.from.address' => $site->getBrand()->getMailFromAddress()]);
            config(['services.facebook.redirect' => ($site->isSecure() ? 'https://' : 'http://') . rtrim($site->getLoginDomain(), '/') . '/facebook/callback']);
            config(['services.facebook.client_id' => $site->getFacebookId()]);
            config(['services.facebook.client_secret' => $site->getFacebookSecret()]);
            app()->setLocale($site->getLanguage());
        }
        return $next($request);
    }
}