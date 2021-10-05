<?php

namespace App\Http\Controllers;

use App\Events\ConnectMessage;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function signin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // 인증 데이터
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials))
        {
            // intended 메소드
            // 사용자가 인증 필터에 접근하기 전에 액세스하려고 시도했던 URL로 사용자를 Redirect 시킨다.
            // 해당 경로로 접근이 불가능한 경우 입력한 대체 URI를 메소드에 지정할 수 있다.
            return redirect()->intended()->withSuccess('Signed in');
        }
        else
        {
            return $this->signup($request);
        }

        // return redirect("login")->withErrors(['message' => 'Login field in required.']);
    }

    public function signup(Request $request)
    {
        Validator::make($request->only('username', 'password'), [
            'username' => 'required|unique:users',
            'password' => 'required'
        ])->validate();

        $user_info = $request->all();
        $user_info['address'] = $request->ip();
        $user = User::create($user_info);

        Auth::login($user);

        broadcast(new ConnectMessage($user));

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }

    public function dashboard()
    {
        
    }
}
