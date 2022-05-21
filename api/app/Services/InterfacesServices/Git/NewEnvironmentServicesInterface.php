<?php

namespace App\Services\InterfacesServices\Git;

interface NewEnvironmentServicesInterface
{
    public function newEnvironment(string $path, string $repository, array $branch, bool $commitPreferenceIsTheHEAD): array;
}
