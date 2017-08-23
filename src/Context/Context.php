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
        return $this->site->getApp() ?? null;
    }

    /**
     * @return BpBrand
     */
    public function getBrand()
    {
        return $this->site->getBrand() ?? null;
    }

    /**
     * @return mixed
     */
    public function getDomain() {
        return $this->site->getDomain() ?? null;
    }

    public function getLanguage()
    {
        return $this->site->getLanguage() ?? null;
    }

    public function getLocale() {
        return $this->site->getLocale() ?? null;
    }

    public function getBrandCode() {
        return $this->getBrand()->getCode() ?? null;
    }

    public function getAppCode() {
        return $this->getApp()->getCode() ?? null;
    }

    public function getDomainUrl() {
        if($this->getDomain()) {
            return $this->addHttpToUrlWhenMissing(
                $this->getDomain(),
                $this->site->isSecure()
            );
        }

        return null;
    }

    public function getTranslationNamespace()
    {
        if($this->getAppCode() && $this->getBrandCode()) {
            return 'bonnier::'.$this->getAppCode().'/'.$this->getBrandCode().'/messages.';
        }

        return null;
    }

    public function getPrimaryColor() {
        return $this->getBrand()->getPrimaryColor() ?? null;
    }

    public function getSecondaryColor() {
        return $this->getBrand()->getSecondaryColor() ?? null;
    }

    public function getTertiaryColor() {
        return $this->getBrand()->getTertiaryColor() ?? null;
    }

    public function getLogo() {
        return $this->getBrand()->getLogoUrl() ?? null;
    }

    public function whiteLogoBackground() {
        return $this->getBrand()->isLogoBgColorWhite() ?? null;
    }

    public function usesFacebook() {
        return $this->site->getFacebookId() && $this->site->getFacebookSecret();
    }

    public function getSignUpPermission() {
        return $this->site->getSignupLeadPermission() ?? null;
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