<?php

namespace App\Interfaces\Http\Controllers\Api;

use App\Http\Requests\Composer\ComposerRequest;
use App\Services\Composer\ComposerServices;

interface ComposerControllerInterface
{
    public function install(ComposerRequest $request): array;

    public function update(ComposerRequest $request): array;

    public function remove(ComposerRequest $request): array;
}
