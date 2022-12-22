<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\posts;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function Registr(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|min:4|max:10',
            'password' => 'required|min:4|max:10',
        ], [
            'login.required' => 'Поле обязательно к заполнению',
            'login.min' => 'Логин пользователя слишком короткий.',
            'login.max' => 'Логин пользователя слишком длинный.',
            'password.required' => 'Пароль является обязательным',
            'password.min' => 'Пароль слишком короткий.',
            'password.max' => 'Пароль слишком длинный.',
        ]);

        if ($validator->fails()) {
            return response()->json([ 'errors' => $validator->errors() ], 400);
        }

        $user = new User();
        $user->Login = $request->login;
        $user->Password = Hash::make($request->password);
        $user->username = ' ';
        $user->save();

        return response()->json([ 'success' => true, 'user'=>$user ]);
    }

    public function teach(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|min:4|max:30|filled',
            'password' => 'required|min:4|max:30|filled',
        ], [
            'login.required' => 'Поле является обязательным к заполнению.',
            'login.min' => 'Имя пользователя слишком короткое.',
            'login.max' => 'Имя пользователя слишком длинное.',
            'login.filled' => 'Поле не может быть отправлено пустым.',
            'password.required' => 'Поле является обязательным к заполнению.',
            'password.filled' => 'Поле не может быть отправлено пустым.'
        ]);

        if ($validator->fails()) {
            return response()->json([ 'errors' => $validator->errors() ], 400);
        }

        $user = User::where('Login', '=', $request->login)->first();
        if (Hash::check($request->password, $user->Password))
        {
            return response()->json([ 'success' => true, 'user' => $user ]);

        } else
        {
            return response()->json([ 'success' => false ]);
        }

    }

    public function learn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|min:4|max:30|filled',
            'password' => 'required|min:4|max:30|filled',
        ], [
            'login.required' => 'Поле является обязательным к заполнению.',
            'login.min' => 'Имя пользователя слишком короткое.',
            'login.max' => 'Имя пользователя слишком длинное.',
            'login.filled' => 'Поле не может быть отправлено пустым.',
            'password.required' => 'Поле является обязательным к заполнению.',
            'password.filled' => 'Поле не может быть отправлено пустым.'
        ]);

        if ($validator->fails()) {
            return response()->json([ 'errors' => $validator->errors() ], 400);
        }

        $user = User::where('Login', '=', $request->login)->first();
        if (Hash::check($request->password, $user->Password))
        {
            return response()->json([ 'success' => true, 'user' => $user ]);

        } else
        {
            return response()->json([ 'success' => false ]);
        }

    }
}
