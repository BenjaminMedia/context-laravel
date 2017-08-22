<?php


namespace Bonnier\ContextService\Models;


class BpApp
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $code;

    public function __construct($app = null)
    {
        if($app) {
            $this->id = $app->id ?? null;
            $this->name = $app->name ?? null;
            $this->code = $app->app_code ?? null;
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return BpApp
     */
    public function setId(int $id): BpApp
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return BpApp
     */
    public function setName(string $name): BpApp
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return BpApp
     */
    public function setCode(string $code): BpApp
    {
        $this->code = $code;
        return $this;
    }


}