<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Http\Requests\NewEnvironmentRequest;
use App\Services\NewEnvironmentServices;

class NewEnvironmentController extends Controller
{

    public function new(NewEnvironmentRequest $request)
    {

        $NewEnvironmentServices = new NewEnvironmentServices();
        $output = $NewEnvironmentServices->newEnvironment(
            $request->path,
            $request->repository,
            $request->branche,
            $request->commitPreferenceIsTheHEAD);
        return response()->json($output,200);
    }
}
