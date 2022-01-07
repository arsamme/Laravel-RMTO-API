<?php

namespace Arsam\Rmto\Contracts;

use Exception;

abstract class RmtoService
{
    protected string $username;
    protected string $password;
    protected string $apiKey;

    public function __construct($username, $password, $apiKey)
    {
        $this->username = $username;
        $this->password = $password;
        $this->apiKey = $apiKey;
    }

    /**
     * @throws Exception
     */
    abstract function invoke();
}