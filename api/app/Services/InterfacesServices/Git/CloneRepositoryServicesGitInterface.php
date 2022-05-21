<?php

namespace App\Services\InterfacesServices\Git;

interface CloneRepositoryServicesGitInterface
{
    public function cloneRepository(string $path, string $repository, string $branch): string;
}
