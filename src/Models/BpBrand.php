<?php


namespace Bonnier\ContextService\Models;


class BpBrand
{
    /** @var int */
    private $id;

    /** @var  string */
    private $name;

    /** @var string */
    private $code;

    /** @var string */
    private $mailFromAddress;

    /** @var string */
    private $contentHubId;

    /** @var string|null */
    private $primaryColor;

    /** @var string|null */
    private $secondaryColor;

    /** @var string|null */
    private $tertiaryColor;

    /** @var string|null */
    private $logoUrl;

    /** @var bool */
    private $logoBgColorWhite;

    /** @var int */
    private $issuesPerYear;

    public function __construct($brand = null)
    {
        if($brand) {
            $this->id = $brand->id ?? null;
            $this->name = $brand->name ?? null;
            $this->code = $brand->brand_code ?? null;
            $this->mailFromAddress = $brand->mail_from_address ?? null;
            $this->contentHubId = $brand->content_hub_id ?? null;
            $this->primaryColor = $brand->primary_color ?? null;
            $this->secondaryColor = $brand->secondary_color ?? null;
            $this->tertiaryColor = $brand->tertiary_color ?? null;
            $this->logoUrl = $brand->logo_path ?? $brand->logo_url ?? null;
            $this->logoBgColorWhite = boolval($brand->logo_bg_color_white ?? null);
            $this->issuesPerYear = $brand->issues_per_year ?? 0;
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
     * @return BpBrand
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
     * @return BpBrand
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return BpBrand
     */
    public function setCode(string $code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getMailFromAddress()
    {
        return $this->mailFromAddress;
    }

    /**
     * @param string $mailFromAddress
     *
     * @return BpBrand
     */
    public function setMailFromAddress(string $mailFromAddress)
    {
        $this->mailFromAddress = $mailFromAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getContentHubId()
    {
        return $this->contentHubId;
    }

    /**
     * @param string $contentHubId
     *
     * @return BpBrand
     */
    public function setContentHubId(string $contentHubId)
    {
        $this->contentHubId = $contentHubId;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPrimaryColor()
    {
        return $this->primaryColor;
    }

    /**
     * @param null|string $primaryColor
     *
     * @return BpBrand
     */
    public function setPrimaryColor($primaryColor)
    {
        $this->primaryColor = $primaryColor;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getSecondaryColor()
    {
        return $this->secondaryColor;
    }

    /**
     * @param null|string $secondaryColor
     *
     * @return BpBrand
     */
    public function setSecondaryColor($secondaryColor)
    {
        $this->secondaryColor = $secondaryColor;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getTertiaryColor()
    {
        return $this->tertiaryColor;
    }

    /**
     * @param null|string $tertiaryColor
     *
     * @return BpBrand
     */
    public function setTertiaryColor($tertiaryColor)
    {
        $this->tertiaryColor = $tertiaryColor;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLogoUrl()
    {
        return $this->logoUrl;
    }

    /**
     * @param null|string $logoUrl
     *
     * @return BpBrand
     */
    public function setLogoUrl($logoUrl)
    {
        $this->logoUrl = $logoUrl;
        return $this;
    }

    /**
     * @return bool
     */
    public function isLogoBgColorWhite()
    {
        return $this->logoBgColorWhite;
    }

    /**
     * @param bool $logoBgColorWhite
     *
     * @return BpBrand
     */
    public function setLogoBgColorWhite(bool $logoBgColorWhite)
    {
        $this->logoBgColorWhite = $logoBgColorWhite;
        return $this;
    }

    /**
     * @return int
     */
    public function getIssuesPerYear()
    {
        return $this->issuesPerYear;
    }

    /**
     * @param int $issuesPerYear
     *
     * @return BpBrand
     */
    public function setIssuesPerYear(int $issuesPerYear)
    {
        $this->issuesPerYear = $issuesPerYear;
        return $this;
    }


}