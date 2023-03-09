<?php

namespace App\Interfaces\Services\Git;

interface CloneRepositoryServicesGitInterface
{
    public function cloneRepository(string $path, string $repository, string $branch): string;
}
