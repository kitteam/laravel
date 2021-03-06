<?php

namespace App\Http\Controllers\Auth;

use DB;
use Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Events\Auth\UserConfirmation;

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
    protected $redirectTo = '/cp';

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
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);
        if ($object = DB::table('temp_users')->where('email', $credentials['email'])->first()) {
            if (($data = json_decode(json_encode($object), true)) && Hash::check($credentials['password'], $data['password'])) {
                unset($data['id']);
                if ($user = User::create($data)) {
                    DB::table('temp_users')->where('email', $credentials['email'])->delete();

                    event(new UserConfirmation($user, $user->password));
                    //$user->markEmailAsVerified();
                }
            }
        }
        return $this->guard()->attempt(
            $credentials, $request->filled('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        if ($id = $request->session()->pull('admin')) {
            // авторизуемся под текущим администратором
            if (Auth::loginUsingId($id)) {
                $uri = route('mc.index');

                return redirect($uri);
            }
        }
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
