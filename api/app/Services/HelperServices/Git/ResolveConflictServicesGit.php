<?php

namespace App\Services\HelperServices\Git;

use App\Services\InterfacesServices\Git\ResolveConflictServicesGitInterface;

class ResolveConflictServicesGit implements ResolveConflictServicesGitInterface
{
    private $path;
    private $conflict = [];


    public function resolveConflict(bool $commitPreferenceIsTheHEAD = true): bool
    {

        foreach ($this->conflict as $key => $value) {
            $file = $this->path .'/'. $value;

            $content = shell_exec("cd {$this->path} && cat '{$value}'");
            if(!preg_match('@<*\s*HEAD\n(.*?)\n=*\n@is', $content)){
                return false;
            }

            if($commitPreferenceIsTheHEAD){
                $newContent = $this->getContentCommitHead($content);
            }else{
                $newContent = $this->getContentCommitHeadNotHead($content);
            }
            shell_exec("cd {$this->path} && echo '{$newContent}' > '{$value}'");
        }

        return true;
    }

    private function getContentCommitHead(string $content): string
    {

        if(preg_match('@<*\s*HEAD\n(.*?)\n=*\n@is', $content, $matches)){
            return $matches[1];
        }
        return '';
    }

    private function getContentCommitHeadNotHead(string $content): string
    {
        if(preg_match('@<*\s*HEAD\n.*?\n=*\n(.*)\n>*\s@is', $content, $matches)){
            return $matches[1];
        }
        return '';
    }

    public function checkForConflict(string $conflict): void
    {
        $this->conflict = [];
        $rexex = '@CONFLICT\s*?\(content\):\s*?Merge\s*?conflict\s*?in\s*(.*?)\n@is';
        if (preg_match_all($rexex, $conflict, $matches)) {
            $this->conflict = $matches[1];
        }
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getConflict(): array
    {
        return $this->conflict;
    }
}
