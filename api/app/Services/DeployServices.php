<?php

namespace App\Services;

use App\Interfaces\Services\Git\DeployServicesInterface;

class DeployServices implements DeployServicesInterface
{

    private $error='';
    private $backupPath='';
    public function __construct()
    {
        $this->backupPath = getenv('PATH_BACKUP',false);
        $this->pathTemporary = getenv('PATH_TEMPORARY',false);
    }

    public function createTemporaryPath(string $path): array
    {
        $temporaryPath = $path. '/' . '_' . uniqid();
        $result = [
            'temporaryPath' => $temporaryPath,
            'success' => is_null(shell_exec('mkdir ' . $temporaryPath.' 2>&1')) ?   true    :   false
        ];
        return $result;
    }

    public function moveTemporaryPathForEnvironment(string $path, string $temporaryPath): bool
    {

        $backup = $this->createTemporaryPath($this->backupPath);

        if(!$backup['success']){
            $this->error = 'Unable to create backup';
            return false;
        }
        $this->backupPath = $backup['temporaryPath'];

        $cp = is_null(shell_exec('cp -r ' . $path . '/* ' . $backup['temporaryPath'] . ' 2>&1')) ?   true    :   false;

        if(!$cp){
            $this->error = "Unable to copy path {$path} for temporaryPath ".$backup['temporaryPath'];
            return false;
        }
        $rm = is_null(shell_exec('rm -rf ' . $path . '/* 2>&1')) ?   true    :   false;
        if(!$rm){
            $this->error = 'Unable to remove old path '.$path;
            return false;
        }
        $result = is_null(shell_exec('mv ' . $temporaryPath . '/* ' . $path . ' 2>&1')) ?   true    :   false;

        return $result;
    }

    public function getError()
    {
        return $this->error;
    }

    public function getBackupPath()
    {
        return $this->backupPath;
    }
}
