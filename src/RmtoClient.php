<?php
namespace Rmto;

use HMD\Core\Kavenegar\Services\SendService;
use HMD\Core\Kavenegar\Services\VerifyLookupService;

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

    public function verifyLookup($receptor, $template): VerifyLookupService
    {
        return (new VerifyLookupService($this->apiKey, $this->insecure))
            ->template($template)
            ->receptor($receptor);
    }

    public function send($receptor, $message): SendService
    {
        return (new SendService($this->apiKey, $this->insecure))
            ->line($this->defaultLine)
            ->receptor($receptor)
            ->message($message);
    }
}