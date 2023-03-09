<?php

namespace App\Services;

use App\Interfaces\Services\Git\NewEnvironmentServicesInterface;
use App\Services\Git\CloneServicesGit;
use App\Services\Git\PullServicesGit;
use App\Services\HelperServices\Git\ResolveConflictServicesGit;
use App\Services\Shell\ExecServicesShell;


class NewEnvironmentServices implements NewEnvironmentServicesInterface
{

    public function __construct()
    {

        $this->CloneServicesGit = new CloneServicesGit();
        $this->PullServicesGit = new PullServicesGit();
        $this->ResolveConflictServicesGit = new ResolveConflictServicesGit();
        $this->ExecServicesShell = new ExecServicesShell();
    }

    public function newEnvironment(
        string $path,
        string $repository,
        array $branchs,
        bool $commitPreferenceIsTheHEAD): array
    {
        $conflictArray = [];
        $command = $this->CloneServicesGit->cloneRepository($path, $repository, $branchs[0]);
        $output = $this->ExecServicesShell->exec($command);

        if(!$output['success']) {
            return $output;
        }
        array_shift($branchs);
        $this->ResolveConflictServicesGit->setPath($path);

        foreach ($branchs as $branchName) {
            $command =    $this->PullServicesGit->pullRepository($path, $repository, $branchName);
            $output = $this->ExecServicesShell->exec($command);

            if(!$output['success']) {
                return $output;
            }

            $this->ResolveConflictServicesGit->checkForConflict($output['output']);
            if(!$this->ResolveConflictServicesGit->resolveConflict($commitPreferenceIsTheHEAD)){
                return [
                    'success' => false,
                    'error' => 'Unable to resolve conflict',
                    'output' => $this->ResolveConflictServicesGit->getConflict()
                ];
            };
            if($this->ResolveConflictServicesGit->getConflict() != []){
                $conflictArray = array_merge($conflictArray, $this->ResolveConflictServicesGit->getConflict());
            }
        }
        return ['success' => true, 'output' => $conflictArray];
    }
}
