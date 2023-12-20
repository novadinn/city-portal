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
    @if (session('login') == 'admin')
    <main>
    @php
    $request = DB::table('requests')->where('id', $id)->get()->first();
    @endphp
    <article>
        <h2>Заявка №{{ $request->id }}</h2>
        <h2>{{ $request->name }}</h2>
        <p>{{ $request->status }}</p>
        <p>{{ $request->category }}</p>
        <time>{{ $request->created_at }}</time>
        <p>{{ $request->description }}</p>

        @if ($request->status == 'Новая')
        <form action="/request-change-status" method="POST" style="display: contents;" id="{{ 'form-request-delete'.$request->id }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $request->id }}">
            <label for="statuses">Заменить статус</label>
            <select name="statuses" id="statuses" onchange="onSelect(value);">
                <option hidden>Выберите статус</option>
                <option value="solved">Решена</option>
                <option value="declined">Отклонена</option>
            </select>
            <div id="solved-photo" style="display: none">
                <label for="photo_path">Фото</label>
                <input type="file" name="photo_path" id="photo_path" placeholder="" value='' accept="image/png, image/jpeg">
            </div>
            <button form="{{ 'form-request-delete'.$request->id }}" disabled id="request-button">Обновить</button>
        </form>
        @endif
    </article>
    </main>
    @endif
    @include('footer')
</body>
<script>

    function onSelect(value) {

        document.getElementById('request-button').disabled = false;

       if (value === 'solved') {
        document.getElementById('solved-photo').style.display = "block";
        document.getElementById('photo_path').required = true;
       } else {
        document.getElementById('solved-photo').style.display = "none";
        document.getElementById('photo_path').required = false;
       }
    }
</script>
</html>