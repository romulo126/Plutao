<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeployRequest;
use App\Services\NewEnvironmentServices;
use App\Services\DeployServices;
use App\Services\Composer\ComposerServices;

class DeployController extends Controller
{
    public function deploy(DeployRequest $request)
    {
        $NewEnvironmentServices = new NewEnvironmentServices();
        $DeployServices = new DeployServices();
        $ComposerServices = new ComposerServices();
        $outputTemporaryPath = $DeployServices->createTemporaryPath($request->pathTmp);
        if(!$outputTemporaryPath['success']){
            return response()->json($outputTemporaryPath,500);
        }

        $output = $NewEnvironmentServices->newEnvironment(
            $outputTemporaryPath['temporaryPath'],
            $request->repository,
            $request->branche,
            $request->commitPreferenceIsTheHEAD
        );

        if(!$output['success']){
            return response()->json($output,500);
        }

        if($request->composer && is_array($request->composer)){
            foreach($request->composer as $composer){
                if(!is_string($composer)){
                    return response()->json(['success' => false, 'message' => 'path composer must be a string'],500);
                }
                if($composer == '.')
                    $output = $ComposerServices->install($outputTemporaryPath['temporaryPath']);
                else
                    $output = $ComposerServices->install($outputTemporaryPath['temporaryPath'] . '/' . $composer);
                if(!$output['success']){
                    return response()->json($output,500);
                }
            }
        }


        $output = $DeployServices->moveTemporaryPathForEnvironment(
            $request->path,
            $outputTemporaryPath['temporaryPath']
        );

        if(!$output)
        {
            return response()->json($DeployServices->getError(),500);
        }

        return response()->json(['success'=>true,"backupPath"=>$DeployServices->getBackupPath()],200);

    }
}
