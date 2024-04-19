<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Order Delay Notification Service OpenApi",
 *      description="Order Delay Notification Service OpenApi description",
 *      @OA\Contact(
 *          email="fa.saeedi26@gmail.com"
 *      ),
 *
 * )
 */
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request) {
        Auth::logout();
        session()->forget('authenticated_without_db');
        return redirect('/login');
    }

//    public function username()
//    {
//        return 'mobile';
//    }

    public function login(Request $request)
    {
        if ($request['email'] === @config('setting.api_doc_user') && $request['password'] === @config('setting.api_doc_pass')) {
            Session::put('authenticated_without_db', $request['email']);
            $apiRoute= @config('l5-swagger.documentations.default.routes.api');
            return redirect(($apiRoute));
        }

        return view('auth.login', [
            'message' => 'Provided PIN is invalid. ',
        ]);
        //Or, you can throw an exception here.
    }
}
