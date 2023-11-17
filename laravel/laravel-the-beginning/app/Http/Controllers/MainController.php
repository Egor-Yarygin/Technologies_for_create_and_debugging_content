<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    public function showApp()
    {
        return view('layouts/app');
    }

    public function showForm()
    {
        return view('form');
    }

    public function showData()
    {
        $files = Storage::files('/');
        $data = [];

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'json') {
                $data[] = json_decode(Storage::get($file), true);
            }
        }

        return view('data', ['data' => $data]);
    }


    public function post(Request $request)
    {
        // Валидация данных формы
        $validator = Validator::make($request->all(), [
            'login' => 'required|string|min:1|max:50',
            'password' => 'required|string|min:6|max:255',
        ]);

        // Проверка на наличие ошибок валидации
        if ($validator->fails()) {
            return redirect('/form')->with('error', 'Ошибка, недостаточно символов в пароле');
        }

        // Формирование массива данных
        $data = [
            'login' => $request->input('login'),
            'password' => bcrypt($request->input('password')), // Хеширование пароля (рекомендуется)
        ];

        // Сохранение данных в файл с уникальным именем
        $filename = 'data_' . uniqid() . '.json';
        Storage::put($filename, json_encode($data));

        // Возвращаем успешное сообщение с использованием сессии
        return redirect('/form')->with('message', 'Данные успешно отправлены');
    }

}
