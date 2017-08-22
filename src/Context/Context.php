<?php

namespace Bonnier\ContextService\Context;

use Bonnier\ContextService\Models\BpApp;
use Bonnier\ContextService\Models\BpBrand;
use Bonnier\ContextService\Models\BpSite;

class Context
{
    /** @var BpSite|null */
    protected $site;

    /**
     * Context constructor.
     *
     * @param BpSite|null $site
     */
    public function __construct(BpSite $site = null)
    {
        $this->site = $site;
    }

    public function setSite(BpSite $site)
    {
        $this->site = $site;
    }

    /**
     * @return BpApp
     */
    public function getApp()
    {
        return $this->site->getApp();
    }

    /**
     * @return BpBrand
     */
    public function getBrand()
    {
        return $this->site->getBrand();
    }

    /**
     * @return mixed
     */
    public function getDomain() {
        return $this->site->getDomain();
    }

    public function getLocale() {
        return $this->site->getLocale();
    }

    public function getBrandCode() {
        return $this->getBrand()->getCode();
    }

    public function getAppCode() {
        return $this->getApp()->getCode();
    }

    public function getDomainUrl() {
        return $this->addHttpToUrlWhenMissing(
            $this->getDomain(),
            $this->site->isSecure()
        );
    }

    public function getPrimaryColor() {
        return $this->getBrand()->getPrimaryColor();
    }

    public function getSecondaryColor() {
        return $this->getBrand()->getSecondaryColor();
    }

    public function getTertiaryColor() {
        return $this->getBrand()->getTertiaryColor();
    }

    public function getLogo() {
        return $this->getBrand()->getLogoUrl();
    }

    public function whiteLogoBackground() {
        return $this->getBrand()->isLogoBgColorWhite();
    }

    public function usesFacebook() {
        return $this->site->getFacebookId() && $this->site->getFacebookSecret();
    }

    public function getSignUpPermission() {
        return $this->site->getSignupLeadPermission();
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