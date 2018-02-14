<?php

namespace App\Http\Controllers\Access\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Sistema;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/access';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * [showLoginForm description]
     * @return [type] [description]
     */
    public function showLoginForm($tokenRequest = null)
    {
        $sistema = null;

        if (!empty($tokenRequest)) {
            $sistema = Sistema::get()
                        ->where('token_request', '=', $tokenRequest)
                        ->first();
        } 
        
        return view('access.auth.login', compact('sistema'));
    }

    /**
     * [logout description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        return redirect('/access/login');
    }

    /**
     * [guard description]
     * @return [type] [description]
     */
    protected function guard()
    {
        return Auth::guard('access');
    }
}
