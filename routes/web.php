<?php

use App\Events\ConnectMessage;
use App\Events\IncreaseMessage;
use App\Events\SendMessage;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Models\Players;
use Illuminate\Http\Request;
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

Route::get('/', function (Request $request) {
    // echo "${Request::ip2long($request->ip())}";
    $address = ip2long($request->ip());
    $hasData = Players::where('address', $address)->first();
    $data = Players::select(['address', 'counter'])->firstOrCreate([
        'address' => $address
    ]);
    //$other_players = DB::select("SELECT address, counter FROM players WHERE address NOT IN (?)", [$address]);
    $other_players = Players::select(['address', 'counter'])->orderBy('counter')->get();
    if ($hasData == false) {
        broadcast(new ConnectMessage($data));
    }
    $data['players'] = $other_players;
    return view('home')->with('players_data', $data);
});

Route::post('increase', function (Request $request) {
    $player = Players::where('address', ip2long($request->ip()))->first();
    if ($player)
    {
        $player->increment('counter');

        broadcast(new IncreaseMessage($player));
        return ['response' => 'ok'];
    }
    else
    {
        return ['response' => 'fail'];
    }
});

// 인증된 사용자만 접근 가능
Route::middleware('auth')->group(function () {
    Route::get('admin', [AdminController::class, 'index']);
});

// 인증되지 않은 사용자만 접근 가능
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login');
});