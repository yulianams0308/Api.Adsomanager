<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ResultController;
use App\Http\Controllers\Api\InstructorController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CompetenceController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\DatasheetController;
use App\Http\Controllers\Api\SessionController;
use App\Http\Controllers\Api\ApprenticeController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\RoleController;


//Route::post('register', [RegisterController::class,'store'])->name('api.v1.registrer');


//php artisan make:controller Api\InstructorsController --api 

//Route::apiResource('categories',CategoryController::class)->names('api.v1.categories');


Route::get('rooms', [RoomController::class, 'index'])->name('api.v1.rooms.index');
Route::post('rooms', [RoomController::class, 'store'])->name('api.v1.rooms.store');
Route::delete('rooms/{room}', [RoomController::class, 'destroy'])->name('api.v1.rooms.destroy');
Route::put('rooms/{room}', [RoomController::class,'update'])->name('api.v1.rooms.update');
Route::get('rooms/{room}', [RoomController::class, 'show'])->name('api.v1.rooms.show');

Route::get('competences', [CompetenceController::class, 'index'])->name('api.v1.competences.index');
Route::post('competences', [CompetenceController::class, 'store'])->name('api.v1.competences.store');
Route::delete('competences/{competence}', [CompetenceController::class, 'destroy'])->name('api.v1.competences.destroy');
Route::put('competences/{competence}', [CompetenceController::class,'update'])->name('api.v1.competences.update');
Route::get('competences/{competence}', [CompetenceController::class, 'show'])->name('api.v1.competences.show');

Route::get('results', [ResultController::class, 'index'])->name('api.v1.results.index');
Route::post('results', [ResultController::class, 'store'])->name('api.v1.results.store');
Route::delete('results/{result}', [ResultController::class, 'destroy'])->name('api.v1.results.destroy');
Route::put('results/{result}', [ResultController::class,'update'])->name('api.v1.results.update');
Route::get('results/{result}', [ResultController::class, 'show'])->name('api.v1.results.show');

Route::get('datasheets', [DatasheetController::class, 'index'])->name('api.v1.datasheets.index');
Route::post('datasheets', [DatasheetController::class, 'store'])->name('api.v1.datasheets.store');
Route::delete('datasheets/{datasheet}', [DatasheetController::class, 'destroy'])->name('api.v1.datasheets.destroy');
Route::put('datasheets/{datasheet}', [DatasheetController::class,'update'])->name('api.v1.datasheets.update');
Route::get('datasheets/{datasheet}', [DatasheetController::class, 'show'])->name('api.v1.datasheets.show');

Route::get('roles', [RoleController::class, 'index'])->name('api.v1.roles.index');
Route::post('roles', [RoleController::class, 'store'])->name('api.v1.roles.store');
Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('api.v1.roles.destroy');
Route::put('roles/{role}', [RoleController::class,'update'])->name('api.v1.roles.update');
Route::get('roles/{role}', [RoleController::class, 'show'])->name('api.v1.roles.show');

Route::get('users', [UserController::class, 'index'])->name('api.v1.users.index');
Route::post('users', [UserController::class, 'store'])->name('api.v1.users.store');
Route::delete('users/{user}', [UserController::class, 'destroy'])->name('api.v1.users.destroy');
Route::put('users/{user}', [UserController::class,'update'])->name('api.v1.apprentices.update');
Route::get('users/{user}', [UserController::class, 'show'])->name('api.v1.users.show');
///
Route::get('apprentices', [ApprenticeController::class, 'index'])->name('api.v1.apprentices.index');
Route::post('apprentices', [ApprenticeController::class, 'store'])->name('api.v1.apprentices.store');
Route::delete('apprentices/{apprentice}', [ApprenticeController::class, 'destroy'])->name('api.v1.apprentices.destroy');
Route::put('apprentices/{apprentice}', [ApprenticeController::class,'update'])->name('api.v1.apprentices.update');
Route::get('apprentices/{apprentice}', [ApprenticeController::class, 'show'])->name('api.v1.apprentices.show');

Route::get('instructors', [InstructorController::class, 'index'])->name('api.v1.instructors.index');
Route::post('instructors', [InstructorController::class, 'store'])->name('api.v1.instructors.store');
Route::delete('instructors/{instructor}', [InstructorController::class, 'destroy'])->name('api.v1.instructors.destroy');
Route::put('instructors/{instructor}', [InstructorController::class,'update'])->name('api.v1.instructors.update');
Route::get('instructors/{instructor}', [InstructorController::class, 'show'])->name('api.v1.instructors.show');

Route::get('sessions', [SessionController::class, 'index'])->name('api.v1.sessions.index');
Route::post('sessions', [SessionController::class, 'store'])->name('api.v1.sessions.store');
Route::delete('sessions/{session}', [SessionController::class, 'destroy'])->name('api.v1.sessions.destroy');
Route::put('sessions/{session}', [SessionController::class,'update'])->name('api.v1.sessions.update');
Route::get('sessions/{session}', [SessionController::class, 'show'])->name('api.v1.sessions.show');

Route::get('attendances', [AttendanceController::class, 'index'])->name('api.v1.attendances.index');
Route::post('attendances', [AttendanceController::class, 'store'])->name('api.v1.attendances.store');
Route::get('attendances/{attendance}', [AttendanceController::class, 'show'])->name('api.v1.attendances.show');
Route::put('attendances/{attendance}', [AttendanceController::class,'update'])->name('api.v1.attendances.update');
Route::delete('attendances/{attendance}', [AttendanceController::class, 'destroy'])->name('api.v1.attendances.delete');


Route::get('images', [ImageController::class, 'index'])->name('api.v1.images.index');
Route::post('images', [ImageController::class, 'store'])->name('api.v1.images.store');
Route::get('images/{image}', [ImageController::class, 'show'])->name('api.v1.images.show');
Route::put('images/{image}', [ImageController::class,'update'])->name('api.v1.images.update');
Route::delete('images/{image}', [ImageController::class, 'destroy'])->name('api.v1.images.delete');
