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
            <h2>Заявки</h2>
            @php
            $requests = DB::table('requests')->where('status', 'Решена')->orderBy('created_at', 'desc')->limit(4)->get();
            @endphp
            @foreach($requests as $request)
                <article>
                    <h2>{{ $request->name }}</h2>
                    <p>{{ $request->category }}</p>
                    <p><time>{{ $request->created_at }}</time></p>
                    @php
                    $storage_path = storage_path();
                    $data = "";
                    $img_path = "{$storage_path}/app/public/images/{$request->photo_path}";
                    if(file_exists($img_path)) {
                        $data = file_get_contents($img_path);
                    }
                    @endphp
                    @if ($data != "")
                        <img src="{{ $data }}" width="200" height=400" onmouseover="this.src='/test.png'" onmouseout="this.src='{{ $data }}'"/>
                    @endif
                </article>
            @endforeach
        </section>
    </main>
    @include('footer')
</body>
</html>