<?php

namespace Arsam\Rmto;

use Arsam\Rmto\Services\GetCarBySmartNumber;
use Arsam\Rmto\Services\GetDriverByNationalCodeService;

class RmtoClient
{
    private string $apiKey;
    private string $username;
    private string $password;

    /**
     * RmtoClient constructor.
     */
    public function __construct()
    {
        $this->apiKey = config('rmto.api_key');
        $this->username = config('rmto.username');
        $this->password = config('rmto.password');
    }

    public function apiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    public function credentials(string $username, string $password): self
    {
        $this->username = $username;
        $this->password = $password;
        return $this;
    }

    public function getDriverByNationalCode($nationalCode): GetDriverByNationalCodeService
    {
        return (new GetDriverByNationalCodeService(
            $this->username,
            $this->password,
            $this->apiKey)
        )->nationalCode($nationalCode);
    }

    public function getCarBySmartNumber($smartNumber): GetCarBySmartNumber
    {
        return (new GetCarBySmartNumber(
            $this->username,
            $this->password,
            $this->apiKey)
        )->smartNumber($smartNumber);
    }
}