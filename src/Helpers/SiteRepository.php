<?php

namespace Bonnier\ContextService\Helpers;

use Bonnier\ContextService\Helpers\SiteManager\SiteService;

class SiteRepository
{
    protected $service;

    function __construct()
    {
        // Todo: move this implementation to Bonnier PHP SDK
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
     * @return \stdClass|null
     */
    public function findByLoginDomain($brandUrl)
    {
        return $this->service->findByLoginDomain($brandUrl);
    }
}
