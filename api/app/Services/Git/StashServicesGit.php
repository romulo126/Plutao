<?php

namespace App\Services\Git;

use App\Services\ConfigServices\Git;
use App\Interfaces\Services\Git\StashServicesGitInterface;

class StashServicesGit extends Git implements StashServicesGitInterface
{

    public function stash(string $path, string $repository, string $branch): string
    {
        return "cd {$path} && git stash --all --keep-index";
    }

    public function stashPop(string $path, string $repository, string $branch): string
    {
        return "cd {$path} && git stash pop";
    }
}
