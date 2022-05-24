<?php

namespace App\Interfaces\Services\Git;

interface NewEnvironmentServicesInterface
{
    public function newEnvironment(string $path, string $repository, array $branch, bool $commitPreferenceIsTheHEAD): array;
}
