<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GitController;
use App\Http\Controllers\Api\NewEnvironmentController;
use App\Http\Controllers\Api\DeployController;
use App\Http\Controllers\Api\ComposerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::prefix('git')->group(
    function(){
        Route::post('/deploy', [DeployController::class, 'deploy']);
        Route::post('/new-enviroment', [NewEnvironmentController::class, 'new']);
        Route::post('/clone', [GitController::class, 'clone']);
        Route::post('/pull', [GitController::class, 'pull']);
        Route::post('/checkout', [GitController::class, 'checkout']);
        Route::post('/stash', [GitController::class, 'stash']);
        Route::post('/stashpop', [GitController::class, 'stashPop']);

    }
);
Route::post('/composer', [ComposerController::class, 'install']);
