<?php

namespace App\Services\Git;

use App\Services\ConfigServices\Git;
use App\Interfaces\Services\Git\CheckoutServicesGitInterface;

class CheckoutServicesGit extends Git implements CheckoutServicesGitInterface
{
    public function checkoutRepository(string $path, string $branch): string
    {
        return "cd {$path} && git checkout {$branch}";
    }
}
