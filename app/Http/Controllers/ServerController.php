<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Http\Request;

class ServerController extends Controller
{
    public  function testingRegistr(Request $request)
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
        $user->save();

        return response()->json([ 'success' => true, 'проверка пройдена успешно' ]);
    }
}
