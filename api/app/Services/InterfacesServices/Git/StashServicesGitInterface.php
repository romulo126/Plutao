<?php

namespace App\Services\InterfacesServices\Git;

interface StashServicesGitInterface
{
    public function stash(string $path, string $repository, string $branch): string;

    public function stashPop(string $path, string $repository, string $branch): string;
}
