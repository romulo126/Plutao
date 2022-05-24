<?php

namespace App\Interfaces\Services\Git;

interface DeployServicesInterface
{
    public function createTemporaryPath(string $path): array;
    public function moveTemporaryPathForEnvironment(string $path, string $temporaryPath): bool;
}
