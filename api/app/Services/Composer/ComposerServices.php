<?php

namespace App\Services\Composer;

use App\Interfaces\Services\Composer\ComposerInterface;
use App\Services\Shell\ExecServicesShell;
use App\Services\ConfigServices\Composer;

class ComposerServices extends Composer implements ComposerInterface
{
    public function __construct()
    {
        $this->execServicesShell = new ExecServicesShell;
    }

    public function install(string $path): array
    {
        return $this->exec('cd ' . $path . ' && composer install');
    }

    public function update(string $path): array
    {
        return  $this->exec('cd ' . $path . ' && composer update');
    }

    public function remove(string $path): array
    {
        return  $this->exec('cd ' . $path . ' && composer remove');
    }

    private function exec(string $command)
    {
        return $this->execServicesShell->exec($command);
    }
}
