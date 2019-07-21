<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user = Auth::user();

        if ('POST' === $request->method()) {
            $data = $request->post();

            // Проверка входных данных
            $validator = Validator::make($data, [
                'email' => 'sometimes|string|email|max:255|unique:users,email,'. $user->id, //
                'phone' => 'sometimes|nullable|phone:RU|unique:users,phone,'. $user->id,
                'passport' => 'sometimes|nullable|array',
                'address' => 'sometimes|nullable|array',
                'password' => 'sometimes|string|min:8|confirmed',
            ]);

            // Если ошибок нет, сохраняем данные
            if (false == $validator->fails() )
            {
                // Проверяем текущий пароль  и шифруем новый
                if (isset($data['password'])) {
                    $data['password'] = Hash::make($data['password']);
                    if (false === Hash::check($data['password_current'], $user->password)) {
                        unset($data['password']);
                    }
                }
                $user->update($data);
            }
        }

        return view('cp.account', ['collection' => $user]);
    }
}
