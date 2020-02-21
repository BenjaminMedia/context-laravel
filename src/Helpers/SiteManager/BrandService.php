<?php

namespace Bonnier\ContextService\Helpers\SiteManager;

use GuzzleHttp\Client;

/**
 * Class BrandService
 *
 * @package \App\Helpers\BrandService
 */
class BrandService
{
    protected $client;

    function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function all() {
        return $this->get('/api/v1/brands');
    }

    public function find($id) {
        return $this->get('/api/v1/brands/' . $id);
    }

    private function get($uri) {
        try {
            return json_decode($this->client->get($uri)->getBody());
        } catch (\Exception $e) {
            return null;
        }
    }
}
