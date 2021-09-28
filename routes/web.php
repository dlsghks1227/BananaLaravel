<?php

use App\Events\ConnectMessage;
use App\Events\IncreaseMessage;
use App\Events\SendMessage;
use App\Models\Players;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
<<<<<<< Updated upstream
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Redirect;
=======
>>>>>>> Stashed changes

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

<<<<<<< Updated upstream
Route::get('/', function() {
    return Redirect(route('test.store'));
=======
Route::get('/', function (Request $request) {
    // echo "${Request::ip2long($request->ip())}";
    $address = ip2long($request->ip());
    $hasData = Players::where('address', $address)->first();
    $data = Players::select(['address', 'counter'])->firstOrCreate([
        'address' => $address
    ]);
    //$other_players = DB::select("SELECT address, counter FROM players WHERE address NOT IN (?)", [$address]);
    $other_players = Players::select(['address', 'counter'])->get();
    if ($hasData == false) {
        broadcast(new ConnectMessage($data));
    }
    $data['players'] = $other_players;
    return view('app')->with('players_data', $data);
>>>>>>> Stashed changes
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