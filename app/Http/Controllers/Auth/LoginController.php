<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Get username field
     */
    public function username()
    {
        return 'code';
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')
             ->except('logout');
    }

    /**
     * Send the response after the user was authenticated.
     */
    protected function sendLoginResponse(Request $request)
    {
        $data = [
            'status' => 1
        ];

        $request->session()->regenerate();

        $this->clearLoginAttempts($request);


        $user = $this->guard()
                    ->user();

        $result = $this->authenticated($request,
                                       $user);
        $result = $result ?: $data;

        return $result;
    }

    /**
     * Send the response after the user was authenticated.
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $data = [
            'status' => 0
        ];

        return $data;
    }


    /**
     * Save user login history
     *
     * @param      \Illuminate\Http\Request  $request  The request
     * @param      <type>                    $user     The user
     */
    function authenticated(Request $request,
                          $user)
    {
        $date = \Carbon\Carbon::now();
        $date->setTimeZone('Asia/Tehran');
        $date = $date->toDateTimeString();

        $ip = $request->getClientIp();

        $user->setLastLoginInfo($date,
                                $ip);
    }
}

