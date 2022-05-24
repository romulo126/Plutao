<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Composer\ComposerRequest;
use App\Services\Composer\ComposerServices;

use App\Interfaces\Http\Controllers\Api\ComposerControllerInterface;

class ComposerController  extends Controller implements ComposerControllerInterface
{

    public function __construct(ComposerServices $composerServices)
    {
        $this->composerServices = $composerServices;
    }

    public function install(ComposerRequest $request): array
    {
        return $this->composerServices->install($request->path);
    }

    public function update(ComposerRequest $request): array
    {
        return $this->composerServices->update($request->path);
    }

    public function remove(ComposerRequest $request): array
    {
        return $this->composerServices->remove($request->path);
    }


}
