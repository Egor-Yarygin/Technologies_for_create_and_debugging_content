@extends('layouts.app_for_task1')

@section('title', 'Данные')

@section('content')
    <h1>Данные</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Логин</th>
                <th>Пароль</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item['login'] }}</td>
                    <td>{{ $item['password'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
