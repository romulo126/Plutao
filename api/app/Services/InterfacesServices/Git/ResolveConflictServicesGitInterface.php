<?php
namespace App\Services\InterfacesServices\Git;

interface ResolveConflictServicesGitInterface
{
    public function resolveConflict(bool $heder=true): bool;
    public function checkForConflict(string $conflict): void;
    public function setPath(string $path): void;
    public function getPath(): string;
    public function getConflict(): array;
}
