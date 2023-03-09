<?php

namespace App\Services\ConfigServices;

use App\Services\Shell\ExecServicesShell;

class Composer
{
    protected function setTokenGitHub()
    {
        $token = env('TOKENGIT');

        if ($token) {
            $this->exec('composer config -g github-oauth.github.com ' . $token);
        }
    }

    private function exec(string $command)
    {
        return (new ExecServicesShell())->exec($command);
    }
}
