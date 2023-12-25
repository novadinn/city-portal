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

                    $data_solved = "";
                    $img_path_solved = "{$storage_path}/app/public/images/{$request->photo_path_solved}";
                    if(file_exists($img_path_solved)) {
                        $data_solved = file_get_contents($img_path_solved);
                    }
                    @endphp
                    @if ($data != "")
                        @if ($data_solved != "") 
                            <img src="{{ $data }}" width="200" height="400" onmouseover="this.src='{{ $data_solved }}'" onmouseout="this.src='{{ $data }}'"/>
                        @else
                            <img src="{{ $data }}" width="200" height="400">
                        @endif
                    @endif
                </article>
            @endforeach
        </section>
    </main>
    @include('footer')
</body>
</html>