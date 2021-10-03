<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');    
    }

    public function index()
    {
        return view('login');
    }

    public function checkNickname(Request $request)
    {
        $this->validate($request, [
            'nickname' => 'required'
        ]);

        $player_data = array(
            'nickname' => $request->get('nickname')
        );

        if (Auth::attempt($player_data))
        {
            return redirect('/');
        }
        else
        {
            return back()->with('error', '중복된 닉네임 입니다 !');
        }
    }
}
