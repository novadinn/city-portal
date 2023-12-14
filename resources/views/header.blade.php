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