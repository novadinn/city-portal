<header>
    <a href="/">Главная</a>
    @if (session('logged_in'))
    @if (session('login') == 'admin')
    <a href="/requests">Заявки пользователей</a>
    <a href="/categories">Категории</a>
    @else
    <a href="/profile">Личный кабинет</a>
    @endif
    <form action="/logout" method="POST" style="display: contents;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button>Выход</button>
    </form>
    @else
    <a href="/login">Вход</a>
    @endif
</header>