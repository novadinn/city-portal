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
            <h1>Регистрация</h1>
            <form action="/register" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div>
                    <label for="name">ФИО</label>
                    <input type="text" name="name" id="name" placeholder="" value='' required>
                </div>
                <div>
                    <label for="login">Логин</label>
                    <input type="text" name="login" id="login" placeholder="" value='' required>
                </div>
                <div>
                    <label for="password">Пароль</label>
                    <input type="text" name="password" id="password" placeholder="" value='' required>
                </div>
                <div>
                    <label for="password_confirmation">Подверждение пароля</label>
                    <input type="text" name="password_confirmation" id="password_confirmation" placeholder="" value='' required>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="" value='' required>
                </div>
                <button type="submit">Зарегистрироваться</button>
            </form>
        </section>
    </main>
    @include('footer')
</body>
</html>