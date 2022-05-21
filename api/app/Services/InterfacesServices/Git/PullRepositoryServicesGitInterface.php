<?php

namespace App\Services\InterfacesServices\Git;

interface PullRepositoryServicesGitInterface{
    public function pullRepository(string $path, string $repository, string $branch): string;
}
