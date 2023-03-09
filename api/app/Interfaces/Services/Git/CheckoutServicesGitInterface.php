<?php
    namespace App\Interfaces\Services\Git;

interface CheckoutServicesGitInterface
{
    public function checkoutRepository(string $path, string $branch): string;
}
