<?php
    namespace App\Services\InterfacesServices\Git;

interface CheckoutServicesGitInterface
{
    public function checkoutRepository(string $path, string $branch): string;
}
