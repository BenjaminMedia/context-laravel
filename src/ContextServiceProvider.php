<?php

namespace Bonnier\ContextService;

use Bonnier\ContextService\Context\Context;
use Bonnier\ContextService\Helpers\SiteManager\BrandService;
use Bonnier\ContextService\Helpers\SiteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

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

        $this->app->singleton(BrandService::class, function () {
            $client = new Client([
                'base_uri' => config('services.site_manager.host')
            ]);
            return new BrandService($client);
        });

        $this->prepareView();
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
