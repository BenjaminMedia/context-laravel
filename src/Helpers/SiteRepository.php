<?php

namespace Bonnier\ContextService\Helpers;

use Bonnier\ContextService\Helpers\SiteManager\SiteService;
use Bonnier\ContextService\Models\BpSite;
use Illuminate\Support\Facades\Cache;

class SiteRepository
{
    const CACHE_TAG = 'bonnier.context';
    private $cache_expires;
    protected $service;

    function __construct()
    {
        $this->cache_expires = 1440; // 24 hours in minutes
        $this->service = new SiteService(config('services.site_manager.host'));
    }

    /**
     * Get all brands
     *
     * @return array|null
     */
    public function all()
    {
        return Cache::tags(static::CACHE_TAG)->remember('bonnier-siterepository', $this->cache_expires, function(){
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
        $site = Cache::tags(static::CACHE_TAG)->remember(hash('md5', 'site-id-'.$id), $this->cache_expires, function() use($id) {
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
        $site = Cache::tags(static::CACHE_TAG)->remember(hash('md5', 'site-domain-'.$brandUrl), $this->cache_expires, function() use($brandUrl) {
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
