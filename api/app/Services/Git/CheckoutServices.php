<?php

namespace App\Services\Git;

use App\Services\ConfigServices\Git;
use App\Services\InterfacesServices\Git\CheckoutServicesGitInterface;

class CheckoutServicesGit extends Git implements CheckoutServicesGitInterface
{
    public function checkoutRepository(string $path, string $branch): string
    {
        return "cd {$path} && git checkout {$branch}";
    }
}
