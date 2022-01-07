<?php

namespace Rmto\Services;

use Exception;
use Rmto\Contracts\RmtoService;

class VerifyLookupService extends RmtoService
{
    private string $receptor;
    private string $template;
    private string $token;
    private ?string $token2 = null;
    private ?string $token3 = null;
    private ?string $token10 = null;
    private ?string $token20 = null;

    public function template($template): self
    {
        $this->template = $template;
        return $this;
    }

    public function receptor($receptor): self
    {
        $this->receptor = $receptor;
        return $this;
    }

    public function token($token): self
    {
        $this->token = $token;
        return $this;
    }

    public function token2($token2): self
    {
        $this->token2 = $token2;
        return $this;
    }

    public function token3($token3): self
    {
        $this->token3 = $token3;
        return $this;
    }

    public function token10($token10): self
    {
        $this->token10 = $token10;
        return $this;
    }

    public function token20($token20): self
    {
        $this->token20 = $token20;
        return $this;
    }

    public function getMethod(): string
    {
        return 'lookup';
    }

    public function getBase(): string
    {
        return 'verify';
    }

    /**
     * @throws Exception
     */
    function invoke()
    {
        $data = [
            'receptor' => $this->receptor,
            'template' => $this->template,
            'token' => $this->token,
        ];
        if ($this->token2 != null) {
            $data['token2'] = $this->token2;
        }
        if ($this->token3 != null) {
            $data['token3'] = $this->token3;
        }
        if ($this->token10 != null) {
            $data['token10'] = $this->token10;
        }
        if ($this->token20 != null) {
            $data['token20'] = $this->token20;
        }

        return $this->execute($data);
    }
}