<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Мое Laravel приложение')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <header>
        @section('header')
        <img src="{{ asset('images/logo.svg') }}" alt="Логотип">
        <h1>Laravel: Начало</h1>
            <nav>
                <ul>
                    <li><h3><a href="/form_for_task1">Форма</a></h3></li>
                    <li><h3><a href="/data_for_task1">Таблица</a></h3></li>
                    <!-- Добавьте другие пункты меню по мере необходимости -->
                </ul>
            </nav>
        @show
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        @section('footer')
            <p>&copy; 2023 Laravel приложение</p>
        @show
    </footer>
</body>
</html>
