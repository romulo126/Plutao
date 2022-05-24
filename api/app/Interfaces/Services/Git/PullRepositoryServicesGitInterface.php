<?php

namespace App\Interfaces\Services\Git;

interface PullRepositoryServicesGitInterface{
    public function pullRepository(string $path, string $repository, string $branch): string;
}
