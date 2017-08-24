<?php

namespace Bonnier\ContextService\Helpers;

use Bonnier\ContextService\Helpers\SiteManager\SiteService;
use Bonnier\ContextService\Models\BpSite;
use Illuminate\Support\Facades\Cache;

class SiteRepository
{
    const CACHE_EXPIRES = 1440; // 24 hours in minutes
    protected $service;

    function __construct()
    {
        $this->service = new SiteService(config('services.site_manager.host'));
    }

    /**
     * Get all brands
     *
     * @return array|null
     */
    public function all()
    {
        return Cache::remember('bonnier-siterepository', static::CACHE_EXPIRES, function(){
            return $this->service->all();
        });
    }

    /**
     * Get a site by the given ID.
     *
     * @param  int  $id
     * @return BpSite|null
     */
    public function find($id)
    {
        $site = Cache::remember(hash('md5', 'site-id-'.$id), static::CACHE_EXPIRES, function() use($id) {
            return $this->service->find($id);
        });

        if($site) {
            return new BpSite($site);
        }

        return null;
    }

    /**
     * Get a client by the given ID.
     *
     * @param $brandUrl
     * @return BpSite|null
     */
    public function findByDomain($brandUrl)
    {
        $site = Cache::remember(hash('md5', 'site-domain-'.$brandUrl), static::CACHE_EXPIRES, function() use($brandUrl) {
            $loginDomainResult = $this->service->findByLoginDomain($brandUrl);
            if($loginDomainResult) {
                return $loginDomainResult;
            }
            return $this->service->findByDomain($brandUrl);
        });

        if($site) {
            return new BpSite($site);
        }

        return null;
    }
}
