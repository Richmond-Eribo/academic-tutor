<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

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
Route::post('/user/register', [UserController::class, 'store'])->middleware('guest'); // === route to signup
Route::post('/user/login', [AuthController::class, 'login'])->middleware('guest')->name('login'); // route to login

// axios.get('/sanctum/csrf-cookie').then(response => {
//     // Login...
// });

Route::group([
    'middleware' => ['api', 'auth:sanctum'],
    'prefix' => 'user'
    ], function () {
        Route::post('/logout', [AuthController::class, 'logout']); // route to logout
        Route::get('/', [UserController::class, 'showAll']); // route to get all users
        Route::get('/{id}', [UserController::class, 'showOne']); // route to get user by id
        Route::post('/update/{id}', [UserController::class, 'update']); // route to update by id
        Route::get('/download-file/{filename}', [UserController::class, 'downloadFile']); // route to download file by filename
        Route::get('/get-file/{filename}', [UserController::class, 'getFile'] ); // route to get file by filename
    }
);

Route::group([
    'middleware' => ['auth:sanctum', 'is.admin'],
    'prefix' => 'admin'
    ], function () {
        Route::post('delete-user/{id}', [UserController::class, 'destroy']); //route to delete user
        Route::post('verify-teacher/{id}', [TeacherController::class, 'verify']); // route to verify user
        Route::post('unverify-teacher/{id}', [TeacherController::class, 'unverify']); // route to unverify user
    }
);


Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'teacher'
    ], function () {
          Route::get('/', [TeacherController::class, 'showAll']); //route to get all teachers
          Route::get('/verified', [TeacherController::class, 'showAllVerified']); // route to get all verified teachers
          Route::get('/{id}', [TeacherController::class, 'showOne']); // route to get teacher by id
          Route::get('/verified/{id}', [TeacherController::class, 'showOneVerified']); // route to get verified teacher by id
          Route::get('/unverified', [TeacherController::class, 'showAllNotVerified']); // route to get all unverified teachers
          Route::get('/unverified/{id}', [TeacherController::class, 'showOneNotVerified']); // route to get unverified teacher by id
    }
);
Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'parent'
    ], function () {
          Route::get('/', [ParentController::class, 'showAll']); // route to get all parents
          Route::get('/{id}', [ParentController::class, 'showOne']); // route to get parent by id
    }
);





// Reset Password Routes

// this route is used to send the password-reset mail
Route::post('user/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

// this route is for the password reset link sent to the user
Route::get('user/reset-password/{token}', function($token) {
    return ['token' => $token]; 
})->middleware('guest')->name('password.reset');

//this route handles password reset submission
Route::post('user/reset-password', function(Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password) 
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.update');
