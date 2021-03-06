<?php

namespace Bonnier\ContextService\Helpers\SiteManager;

use GuzzleHttp\Client;

/**
 * Class BrandService
 *
 * @package \App\Helpers\BrandService
 */
class SiteService
{
    protected $client;

    function __construct($baseUri)
    {
        $this->client = new Client([
            'base_uri' => $baseUri
        ]);
    }

    public function all()
    {
        return $this->get('/api/v1/sites');
    }

    public function find($id)
    {
        return $this->get('/api/v1/sites/' . $id);
    }

    public function findByDomain($domain)
    {
        return $this->get('/api/v1/sites/domain/'.$domain);
    }

    public function findByLoginDomain($loginDomain)
    {
        return $this->get('/api/v1/sites/login-domain/'.$loginDomain);
    }

    private function get($uri)
    {
        try {
            return json_decode($this->client->get($uri)->getBody());
        } catch (\Exception $e) {
            return null;
        }
    }
}
