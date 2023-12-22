<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <style>
    </style>
</head>
<body>
    @include('header')
    <main>
        <h1>Создать заявку</h1>
        <form action="/request" method="POST" id="request-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div>
                <label for="name">Название</label>
                <input type="text" name="name" id="name" placeholder="" value='' required>
            </div>
            <div>
                @php
                $categories = DB::table('categories')->get();
                @endphp
                <label for="category">Категория</label>
                <select name="category" id="category" >
                    @foreach($categories as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="description">Описание</label>
                <textarea name="description" id="description" required> </textarea>
            </div>
            <div>
                <label for="photo_path">Фото</label>
                <input type="hidden" name="photo_binary" id="photo_binary">
                <input type="file" name="photo_path" id="photo_path" placeholder="" value='' required accept="image/png, image/jpeg">
            </div>

            <button form="request-form">Создать</button>
        </form>

        <h1>Мои заявки</h1>
        <div id="filter-button-container">
            <button class="filter-button filter-active-button" onclick="filterSelection('all')">Все</button>
            <button class="filter-button" onclick="filterSelection('Новая')">Новые</button>
            <button class="filter-button" onclick="filterSelection('Решена')">Решенные</button>
            <button class="filter-button" onclick="filterSelection('Отклонена')">Отклоненные</button>
        </div>
        @php
        $requests = DB::table('requests')->where('user_login', session('login'))->get();
        @endphp
        @foreach($requests as $request)
        <div class="{{ 'request-filter-div'.' '.$request->status }}">
            <article>
                <h2>{{ $request->name }}</h2>
                <p>{{ $request->status }}</p>
                <p>{{ $request->category }}</p>
                <time>{{ $request->created_at }}</time>
                <p>{{ $request->description }}</p>
                @php
                $storage_path = storage_path();
                $data = "";
                $img_path = "{$storage_path}/app/public/images/{$request->photo_path}";
                if(file_exists($img_path)) {
                    $data = file_get_contents($img_path);
                }
                @endphp
                @if ($data != "")
                    <img src="{{ $data }}" width="200" height="200"/>
                @endif

                <form action="/request-delete" method="POST" id="{{ 'form-request-delete'.$request->id }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{ $request->id }}">
                    <button form="{{ 'form-request-delete'.$request->id }}">Удалить заявку</button>
                </form>
            </article>
        </div>
        @endforeach
    </main>
    @include('footer')
</body>
<script>
    filterSelection("all")
    function filterSelection(c) {
        var x, i;
        x = document.getElementsByClassName("request-filter-div");
        if(c == "all") c = "";
        for (i = 0; i < x.length; i++) {
            if (x[i].className.indexOf(c) > -1) w3AddClass(x[i]);
            else w3RemoveClass(x[i]);
        }
    }

    function w3AddClass(element) {
        element.style.display = "block";
    }

    function w3RemoveClass(element) {
        element.style.display = "none";
    }

    var btnContainer = document.getElementById("filter-button-container");
    var btns = btnContainer.getElementsByClassName("filter-button");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("filter-active-button");
            current[0].className = current[0].className.replace(" filter-active-button", "");
            this.className += " filter-active-button";
        });
    }

    const input = document.getElementById('photo_path');
    const binary = document.getElementById('photo_binary');
    input.addEventListener('change', () => {
        const reader = new FileReader();
        reader.onload = () => {
            binary.value = reader.result;
        };
        reader.readAsDataURL(input.files[0]);
    });

    
</script>
</html>