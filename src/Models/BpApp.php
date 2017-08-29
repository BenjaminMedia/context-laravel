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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return BpApp
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
     * @return BpApp
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
     * @return BpApp
     */
    public function setCode(string $code)
    {
        $this->code = $code;
        return $this;
    }


}