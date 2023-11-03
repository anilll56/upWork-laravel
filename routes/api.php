<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserWorkController;
use App\Http\Controllers\EmailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route :: post("freelancerUserlogin",[UserController::class,'freelancerUserlogin']);
Route :: post("freelancerUserRegister",[UserController::class,'freelancerUserRegister']);
Route :: post("clientUserRegister",[UserController::class,'clientUserRegister']);
Route :: post("clienUserLogin",[UserController::class,'clientUserLogin']);
Route :: post("loginUser",[UserController::class,'loginUser']);

Route :: post("OpenClientWork",[UserWorkController::class,'OpenClientWork']);
Route :: post("updateClientWork",[UserWorkController::class,'updateClientWork']);
Route :: get("getTheClientJob",[UserWorkController::class,'getTheClientJob']);
Route :: post("getTheClientJobByEmail",[UserWorkController::class,'getTheClientJobByEmail']);
Route ::post("getTheFreelancerJobByEmail",[UserWorkController::class,'getTheFreelancerJobByEmail']);
Route :: post("deleteClientWork",[UserWorkController::class,'deleteClientWork']);
Route :: post("openFreelancerWork",[UserWorkController::class,'openFreelancerWork']);
Route :: get("getTheFreelancerJob",[UserWorkController::class,'getTheFreelancerJob']);
Route :: post("updateFreelancerWork",[UserWorkController::class,'updateFreelancerWork']);
Route :: post("deleteFreelancerWork",[UserWorkController::class,'deleteFreelancerWork']);

Route :: post("sendEmail",[EmailController::class,'sendEmail']);

Route::post("HireFreelancer",[UserWorkController::class,'HireFreelancer']);
Route::post("applyForTheJob",[UserWorkController::class,'applyForTheJob']);
Route::post("getTheAppliedJob",[UserWorkController::class,'getTheAppliedJob']);
Route::post("pendingJobs",[UserWorkController::class,'pendingJobs']);