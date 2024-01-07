@extends('layouts.app_for_task1')

@section('title', 'Форма')

@section('content')
    <h1>Форма</h1>

    

    <form action="{{ url('/post') }}" method="post">
        @csrf
            <label for="login">Логин:</label>
            <input type="text" name="login" required>
        <br>
        <br>
            <label for="password">Пароль:</label>
            <input type="password" name="password" required>
        <br>
        <br>
            <button type="submit" onclick="submitForm()">Отправить</button>
    </form>

    @if(session('message'))
        <p class="success-message">{{ session('message') }}</p>
    @else(session('error'))
        <p class="error-message">{{ session('error') }}</p>
    @endif
@endsection

