<?php

namespace App\Http\Controllers\Auth;

use DB;
use App\User;
use App\TempUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Carbon\Carbon;

use App\Events\Auth\UserRegistered;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'size:0',
            '_name' => 'required|string|in:esquimau',
            'email' => 'required|string|email|max:255|unique:users',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $this->password = str_random(8);

        // Проверяем наличие зарегистрированного пользователя
        if (($user = User::where(['email' => $data['email']])->get()) && $user->get('email')) {
            return $user;
        }

        DB::table('temp_users')->updateOrInsert(['email' => $data['email']], [
        //return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            //'password' => Hash::make($data['password']),
            'password' => Hash::make($this->password),
            'created_at' => Carbon::now()
        ]);

        return TempUser::where('email', $data['email'])->first();
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        //$this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    protected function registered(Request $request, $user)
    {
        event(new UserRegistered($user, $this->password));

        $this->guard()->logout();

        return redirect($this->redirectPath())
            ->withSuccess('Спасибо за регистрацию! Пароль отправлен на указанный адрес электронной почты.');
    }
}
