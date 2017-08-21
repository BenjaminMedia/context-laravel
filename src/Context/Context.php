<?php

namespace Bonnier\ContextService\Context;

use App\BpApp;
use App\BpBrand;
use Bonnier\Shell\ShellResponse;

class Context
{
    protected $site;

    /**
     * Context constructor.
     *
     * @param null          $site
     * @param ShellResponse $shell
     */
    public function __construct($site = null)
    {
        $this->site = $site;
    }

    public function setSite($site)
    {
        $this->site = $site;
    }

    /**
     * @return BpApp
     */
    public function getApp()
    {
        return $this->site->app ?? null;
    }

    /**
     * @return BpBrand
     */
    public function getBrand()
    {
        return $this->site->brand ?? null;
    }

    /**
     * @return ShellResponse
     */
    public function getShell()
    {
        return $this->shell ?? null;
    }

    /**
     * @return mixed
     */
    public function getDomain() {
        return $this->site->domain ?? null;
    }

    public function getLocale() {
        return $this->site->locale ?? null;
    }

    public function getBrandCode() {
        return $this->getBrand()->brand_code ?? null;
    }

    public function getAppCode() {
        return $this->getApp()->app_code ?? null;
    }

    public function getDomainUrl() {
        return $this->addHttpToUrlWhenMissing(
            $this->getDomain(),
            $this->site->is_secure ?? false
        );
    }

    public function getPrimaryColor() {
        return $this->getBrand()->primary_color ?? null;
    }

    public function getSecondaryColor() {
        return $this->getBrand()->secondary_color ?? null;
    }

    public function getTertiaryColor() {
        return $this->getBrand()->tertiary_color ?? null;
    }

    public function getLogo() {
        return $this->getBrand()->logo_url ?? null;
    }

    public function whiteLogoBackground() {
        return $this->getBrand()->logo_bg_color_white ?? null;
    }

    public function usesFacebook() {
        return isset($this->site->facebook_id, $this->site->facebook_secret);
    }

    public function getSignUpPermission() {
        return $this->site->signup_lead_permission ?? null;
    }

    /**
     * http://stackoverflow.com/questions/6240414/add-http-prefix-to-url-when-missing
     *
     * @param $url
     * @param $secure
     * @return string
     */
    private function addHttpToUrlWhenMissing($url, $secure = false) {
        if  ($ret = parse_url($url)) {
            if (!isset($ret["scheme"])) { $url = "http" . ($secure ? "s" : "") . "://{$url}"; }
        }
        return $url;
    }
}

class NullShellResponse extends ShellResponse {

    public function __construct()
    {
    }

    /**
     * @inheritDoc
     */
    public function getStartTag()
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function getHead()
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function getBody()
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function getHeader()
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function getFooter()
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function getEndTag()
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function getBanners()
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function getHttpResponse()
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function getLogos()
    {
        $logos = new \stdClass();
        $logos->logo_standard = '';
        $logos->logo_unicolor_white = '';
        return '';
    }
}
