<?php

namespace Bonnier\ContextService\Helpers;

use Bonnier\ContextService\Helpers\SiteManager\SiteService;
use Bonnier\ContextService\Models\BpSite;

class SiteRepository
{
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
        return $this->service->all();
    }

    /**
     * Get a client by the given ID.
     *
     * @param  int  $id
     * @return BpBrand|null
     */
    public function find($id)
    {
        return $this->service->find($id);
    }

    /**
     * Get a client by the given ID.
     *
     * @param $brandUrl
     * @return BpSite|null
     */
    public function findByDomain($brandUrl)
    {
        $loginDomainResult = $this->service->findByLoginDomain($brandUrl);
        if($loginDomainResult) {
            return new BpSite($loginDomainResult);
        }
        $domainResult = $this->service->findByDomain($brandUrl);
        if($domainResult) {
            return new BpSite($domainResult);
        }
        return null;
    }
}
