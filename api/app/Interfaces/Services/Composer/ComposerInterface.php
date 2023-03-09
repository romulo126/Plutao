<?php

namespace App\Interfaces\Services\Composer;


interface ComposerInterface
{
    public function install(string $path): array;

    public function update(string $path): array;

    public function remove(string $path): array;


}
