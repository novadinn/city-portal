<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сделаем лучше вместе!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <header>
        <a href="/">Главная</a>
        @if (session('logged_in'))
        <a href="/profile">Личный кабинет</a>
        <form action="/logout" method="POST" style="display: contents;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button>Выход</button>
        </form>
        @else
        <a href="/login">Вход</a>
        @endif
    </header>
    <main>
        <section>
            <h2>Заявки</h2>
        </section>
    </main>
    @include('footer')
</body>
</html>