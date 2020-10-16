<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ProjectGoalsController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);

});
Route::group([

    'middleware' => 'api',
    'prefix' => 'projects'

], function ($router) {

    Route::post('add_new', [ProjectsController::class, 'add_new']);
    Route::get('list', [ProjectsController::class, 'list']);
    Route::get('details/{id}', [ProjectsController::class, 'details']);
    Route::get('update/{id}', [ProjectsController::class, 'update']);

});
Route::group([

    'middleware' => 'api',
    'prefix' => 'project_goals'

], function ($router) {

    Route::post('add_new', [ProjectGoalsController::class, 'add_new']);
    Route::get('list', [ProjectGoalsController::class, 'list']);
    Route::get('details/{id}', [ProjectGoalsController::class, 'details']);
    Route::get('update/{id}', [ProjectGoalsController::class, 'update']);

});