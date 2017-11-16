<?php


namespace Bonnier\ContextService\Models;


class BpSite
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $domain;

    /** @var string */
    private $loginDomain;

    /** @var string */
    private $language;

    /** @var string */
    private $locale;

    /** @var string */
    private $shellUrl;

    /** @var \DateTime */
    private $createdAt;

    /** @var \DateTime */
    private $updatedAt;

    /** @var bool */
    private $isSecure;

    /** @var string */
    private $cxenseSiteId;

    /** @var string */
    private $facebookId;

    /** @var string */
    private $facebookSecret;

    /** @var string|null  */
    private $signupLeadPermission;

    /** @var BpApp */
    private $app;

    /** @var BpBrand */
    private $brand;

    public function __construct($site = null)
    {
        if($site) {
            $this->id = $site->id ?? null;
            $this->name = $site->name ?? null;
            $this->domain = $site->domain ?? null;
            $this->loginDomain = $site->login_domain ?? null;
            $this->language = $site->language ?? null;
            $this->locale = $site->locale ?? null;
            $this->shellUrl = $site->shell_url ?? null;
            if(isset($site->created_at) && $site->created_at) {
                $createdAt = new \DateTime($site->created_at);
                if($createdAt) {
                    $this->createdAt = $createdAt;
                }
            }
            if(isset($site->updated_at) && $site->updated_at) {
                $updatedAt = new \DateTime($site->updated_at);
                if($updatedAt) {
                    $this->updatedAt = $updatedAt;
                }
            }
            $this->isSecure = boolval($site->is_secure ?? null);
            $this->cxenseSiteId = $site->cxense_site_id ?? null;
            $this->facebookId = $site->facebook_id ?? null;
            $this->facebookSecret = $site->facebook_secret ?? null;
            $this->signupLeadPermission = $site->signup_lead_permission ?? null;
            $this->app = new BpApp($site->app ?? null);
            $this->brand = new BpBrand($site->brand ?? null);
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return BpSite
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return BpSite
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     *
     * @return BpSite
     */
    public function setDomain(string $domain)
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * @return string
     */
    public function getLoginDomain()
    {
        return $this->loginDomain;
    }

    /**
     * @param string $loginDomain
     *
     * @return BpSite
     */
    public function setLoginDomain(string $loginDomain)
    {
        $this->loginDomain = $loginDomain;
        return $this;
    }

    /**
     * @return string
     */
    public function getSessionDomain()
    {
        $domain = $this->getLoginDomain() ?? 'bonnier.cloud';
        return '.' . implode('.', array_slice(explode('.', $domain), -2, 2));
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     *
     * @return BpSite
     */
    public function setLanguage(string $language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     *
     * @return BpSite
     */
    public function setLocale(string $locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * @return string
     */
    public function getShellUrl()
    {
        return $this->shellUrl;
    }

    /**
     * @param string $shellUrl
     *
     * @return BpSite
     */
    public function setShellUrl(string $shellUrl)
    {
        $this->shellUrl = $shellUrl;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return BpSite
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     *
     * @return BpSite
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSecure()
    {
        return $this->isSecure;
    }

    /**
     * @param bool $isSecure
     *
     * @return BpSite
     */
    public function setIsSecure(bool $isSecure)
    {
        $this->isSecure = $isSecure;
        return $this;
    }

    /**
     * @return string
     */
    public function getCxenseSiteId()
    {
        return $this->cxenseSiteId;
    }

    /**
     * @param string $cxenseSiteId
     *
     * @return BpSite
     */
    public function setCxenseSiteId(string $cxenseSiteId)
    {
        $this->cxenseSiteId = $cxenseSiteId;
        return $this;
    }

    /**
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * @param string $facebookId
     *
     * @return BpSite
     */
    public function setFacebookId(string $facebookId)
    {
        $this->facebookId = $facebookId;
        return $this;
    }

    /**
     * @return string
     */
    public function getFacebookSecret()
    {
        return $this->facebookSecret;
    }

    /**
     * @param string $facebookSecret
     *
     * @return BpSite
     */
    public function setFacebookSecret(string $facebookSecret)
    {
        $this->facebookSecret = $facebookSecret;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getSignupLeadPermission()
    {
        return $this->signupLeadPermission;
    }

    /**
     * @param null|string $signupLeadPermission
     *
     * @return BpSite
     */
    public function setSignupLeadPermission($signupLeadPermission)
    {
        $this->signupLeadPermission = $signupLeadPermission;
        return $this;
    }

    /**
     * @return BpApp
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param BpApp $app
     *
     * @return BpSite
     */
    public function setApp(BpApp $app)
    {
        $this->app = $app;
        return $this;
    }

    /**
     * @return BpBrand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param BpBrand $brand
     *
     * @return BpSite
     */
    public function setBrand(BpBrand $brand)
    {
        $this->brand = $brand;
        return $this;
    }


}
