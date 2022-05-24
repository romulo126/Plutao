<?php

namespace App\Services\Shell;

use App\Interfaces\Services\Shell\ExecServicesShellInterface;

class ExecServicesShell implements ExecServicesShellInterface
{

    public function exec(string $command)
    {
        try {
            $output = shell_exec($command . ' 2>&1');
            $result = ['success' => $this->validateOutput($output), 'output' => $output];
        } catch (\Exception $e) {
            $result = ['success' => false, 'output' => $e->getMessage()];
        }

        return $result;
    }

    private function validateOutput(string $output)
    {
        switch ($output) {
            case str_contains($output, 'fatal'):
                return false;
            case str_contains($output, 'error'):
                return false;
            default:
                return true;
        }
    }
}
