<?php

namespace App\Http\Controllers\Access;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sistema;
use App\Models\Usuario;
use Illuminate\Encryption\Encrypter;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:access');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $r = $request->all();


        $accessRequest = explode('/',$request->headers->get('referer'));
        $tokenRequest = array_pop($accessRequest);
        $action = array_pop($accessRequest);

        if ($action === 'login' && !empty($tokenRequest)) {
            return redirect()->route('access.redirect', $tokenRequest);
        }

        $user = Auth::user();
        $sistemas = Usuario::find($user->id)->sistemas;
        
        foreach ($sistemas as $sistema) {
            $crypt = new Encrypter(md5($sistema->token_encrypt), 'AES-256-CBC');
            
            $response[$sistema->id] = $crypt->encrypt(json_encode([
                'usuario' => [
                    'email' => $user->email,
                    'cpf' => $user->cpf,
                ],
            ]));
        }

        return view('access.home', compact('user', 'sistemas', 'response'));
    }

    /**
     * [redirect description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function redirect($tokenRequest, Request $request)
    {
        if (!empty($tokenRequest)) {
            $user = Auth::user();   

            $sistema = Usuario::find($user->id)->sistemas()
                            ->where('token_request', '=', $tokenRequest)
                            ->first();

            if (!empty($sistema)) {

                $crypt = new Encrypter(md5($sistema->token_encrypt), 'AES-256-CBC');

                $response = $crypt->encrypt(json_encode([
                    'usuario' => [
                        'email' => $user->email,
                        'cpf' => $user->cpf,
                    ],
                ]));

                Auth::guard('access')->logout();

                return view('access.redirect', compact('sistema', 'response'));
            } 
        } 

        Auth::logout();

        $request->session()->flash(
            'msgError', 
            trans('auth.access-denied')
        );
        return redirect()->route('access.login');

    }
}
