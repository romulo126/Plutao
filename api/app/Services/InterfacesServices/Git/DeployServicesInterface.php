<?php

namespace App\Services\InterfacesServices\Git;

interface DeployServicesInterface
{
    public function createTemporaryPath(string $path): array;
    public function moveTemporaryPathForEnvironment(string $path, string $temporaryPath): bool;
}
