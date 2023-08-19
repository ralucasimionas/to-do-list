<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskListController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", function () {
    return view("welcome");
});

Route::get("/dashboard", function () {
    return view("dashboard");
})
    ->middleware(["auth", "verified"])
    ->name("dashboard");

### LOGGED IN ROUTES
Route::middleware("auth")->group(function () {
    Route::get("/profile", [ProfileController::class, "edit"])->name(
        "profile.edit"
    );
    Route::patch("/profile", [ProfileController::class, "update"])->name(
        "profile.update"
    );
    Route::delete("/profile", [ProfileController::class, "destroy"])->name(
        "profile.destroy"
    );
    route::resource("/tasks", TaskController::class);
});

### ADMIN ROUTES
Route::middleware(["auth", "admin"])
    ->prefix("/admin")
    ->group(function () {
        Route::resource("/users", ProfileController::class);
    });

### USER ROUTES
Route::middleware(["auth", "user"])
    ->prefix("/user")
    ->group(function () {
        Route::resource("/tasklists", TaskListController::class);

        Route::get("/tasks/list", [TaskController::class, "list"])->name(
            "tasks.list"
        );
    });

require __DIR__ . "/auth.php";
