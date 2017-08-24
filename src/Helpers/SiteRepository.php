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
        $cacheKey = 'bonnier-siterepository';
        $sites = Cache::get($cacheKey);
        if($sites) {
            return $sites;
        }
        $sites = $this->service->all();
        Cache::put($cacheKey, $sites, static::CACHE_EXPIRES);
        return $sites;
    }

    /**
     * Get a site by the given ID.
     *
     * @param  int  $id
     * @return BpSite|null
     */
    public function find($id)
    {
        $cacheKey = hash('md5', 'site-id-'.$id);

        $site = Cache::get($cacheKey);
        if($site) {
            return new BpSite($site);
        }
    	$site = $this->service->find($id);
    	if($site) {
    	    Cache::put($cacheKey, $site, static::CACHE_EXPIRES);
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
        $cacheKey = hash('md5', 'site-domain-'.$brandUrl);
        $site = Cache::get($cacheKey);
        if($site) {
            return new BpSite($site);
        }

        $loginDomainResult = $this->service->findByLoginDomain($brandUrl);
        if($loginDomainResult) {
            Cache::put($cacheKey, $loginDomainResult, static::CACHE_EXPIRES);
            return new BpSite($loginDomainResult);
        }
        $domainResult = $this->service->findByDomain($brandUrl);
        if($domainResult) {
            Cache::put($cacheKey, $domainResult, static::CACHE_EXPIRES);
            return new BpSite($domainResult);
        }
        return null;
    }
}
