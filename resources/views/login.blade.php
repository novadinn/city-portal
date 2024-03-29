<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сделаем лучше вместе!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    @include('header')
    <main>
        <section>
            <h1>Логин</h1>
        
            <form action="/login" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div>
                    <label for="login">Логин</label>
                    <input type="text" name="login" id="login" placeholder="" value='' required>
                </div>
                <div>
                    <label for="password">Пароль</label>
                    <input type="text" name="password" id="password" placeholder="" value='' required>
                </div>
                <button>Войти</button>

                @if($errors->has('no_such_user'))
                <p>{{ $errors->first('no_such_user') }}</p>
                @endif
            </form>

            <h2>Не зарегестрированы?</h2>
            <a href="/register">Регистрация</a>
        </section>
    </main>
    @include('footer')
</body>
</html>