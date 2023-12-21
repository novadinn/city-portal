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
        <h1>Создать категорию</h1>
        <form action="/category" method="POST" style="display: contents;" id="category-create-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div>
                <label for="name">Имя</label>
                <input type="text" name="name" id="name" placeholder="" value='' required>
            </div>
            <button form="category-create-form">Создать</button>
        </form>
        <h1>Удалить категорию</h1>
        @php
        $categories = DB::table('categories')->get();
        @endphp
        <form action="/category-delete" method="POST" style="display: contents;" id="category-delete-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <select name="categories" id="categories" >
                @foreach($categories as $category)
                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <button form="category-delete-form">Удалить</button>
        </form>
    </main>
    @include('footer')
</body>
</html>