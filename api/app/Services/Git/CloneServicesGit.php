<?php

namespace App\Services\Git;

use App\Services\ConfigServices\Git;
use App\Services\InterfacesServices\Git\CloneRepositoryServicesGitInterface;

#require __DIR__ . '/../../../vendor/autoload.php';

class CloneServicesGit extends Git implements CloneRepositoryServicesGitInterface
{


    public function cloneRepository(string $path, string $repository, string $branch): string
    {

        $gitToken = $this->getGitToken();


        return "git clone https://{$gitToken}@github.com/{$repository}.git {$path} --branch {$branch}";

    }
}
