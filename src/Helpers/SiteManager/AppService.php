<?php

namespace Bonnier\ContextService\Helpers\SiteManager;

use GuzzleHttp\Client;

/**
 * Class BrandService
 *
 * @package \App\Helpers\BrandService
 */
class AppService
{
    protected $client;

    function __construct($baseUri)
    {
        $this->client = new Client([
            'base_uri' => $baseUri
        ]);
    }

    public function all() {
        return $this->get('/api/v1/apps');
    }

    public function find($id) {
        return $this->get('/api/v1/apps/' . $id);
    }

    private function get($uri) {
        try {
            return json_decode($this->client->get($uri)->getBody());
        } catch (\Exception $e) {
            return null;
        }
    }
}
