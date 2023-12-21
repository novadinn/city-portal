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
    @if (session('login') == 'admin')
    <h1>Заявки пользователей</h1>
    @php
    $requests = DB::table('requests')->get();
    @endphp
    @foreach($requests as $request)
    <article>
        <h2>{{ $request->name }}</h2>
        <p>{{ $request->status }}</p>
        <p>{{ $request->category }}</p>
        <time>{{ $request->created_at }}</time>
        <p>{{ $request->description }}</p>

        <form action="/request-status" method="get" style="display: contents;" id="{{ 'form-request-delete'.$request->id }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $request->id }}">
            <button form="{{ 'form-request-delete'.$request->id }}">Изменить статус</button>
        </form>
    </article>
    @endforeach
    @endif
    </main>
    @include('footer')
</body>
</html>