<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class upload extends Controller
{
    public function handle(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'image' => 'image|nullable',
            'image' => 'mimetypes:image/jpeg,image/png',
        ], [
            'image.mimetypes' => 'Загружаемое изображение может быть лишь формата jpeg или png'
        ]);

        if ($validator->fails()) {
            return response()->json([ 'success' => false, 'errors' => $validator->errors() ], 400);
        }

        $filenameWithExt = $request->file('image')->getClientOriginalName();

        // Только оригинальное имя файла
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Расширение
        $extention = $request->file('image')->getClientOriginalExtension();
        // Путь для сохранения
        $fileNameToStore = "images/".$filename."_".time().".".$extention;
        // Сохраняем файл
        $path = $request->file('image')->storeAs('public/', $fileNameToStore);

        $link = Storage::url($path);

        // return $link;
        $avatar = User::where('Login', '=', $request->login)->update([ 'image' => $link ]);


        return response()->json([ 'success' => true, 'answer' => $link ]);

    }
}
