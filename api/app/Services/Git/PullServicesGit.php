<?php

namespace App\Services\Git;

use App\Services\ConfigServices\Git;
use App\Interfaces\Services\Git\PullRepositoryServicesGitInterface;

class PullServicesGit  extends Git implements PullRepositoryServicesGitInterface
{

    public function pullRepository(string $path, string $repository, string $branch): string
    {
        return "cd {$path} && git pull origin {$branch}";
    }
}
