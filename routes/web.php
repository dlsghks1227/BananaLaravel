<?php

use App\Events\ConnectMessage;
use App\Events\IncreaseMessage;
use App\Events\SendMessage;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Models\Players;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 인증된 사용자만 접근 가능
Route::middleware('auth')->group(function () {
    Route::get('/', function (Request $request) {
        $user = Auth::user();
        $user['other'] = User::orderBy('counter', 'desc')->get();
        return view('home')->with('users', $user);
    });

    Route::post('increase', function (Request $request) {
        if (Auth::check())
        {
            $user = Auth::user();
            $user->increment('counter');
            broadcast(new IncreaseMessage($user));
            return ['response' => 'ok'];
        }
        else
        {
            return ['response' => 'fail'];
        }
    });

});
Route::get('admin', [AdminController::class, 'index']);

// 인증되지 않은 사용자만 접근 가능
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'signin'])->name('signin');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
