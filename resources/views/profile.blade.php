<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    @include('header')
    <main>
        <h1>Создать заявку</h1>
        <form action="/request" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div>
                <label for="name">Название</label>
                <input type="text" name="name" id="name" placeholder="" value='' required>
            </div>
            <div>
                <label for="category">Категория</label>
                <input type="text" name="category" id="category" placeholder="" value='' required>
            </div>
            <div>
                <label for="description">Описание</label>
                <textarea name="description" id="description" required> </textarea>
            </div>
            <div>
                <label for="photo">Фото</label>
                <input type="file" name="photo" id="photo" placeholder="" value='' required accept="image/png, image/jpeg">
            </div>
        <h1>Мои заявки</h1>
    </main>
    @include('footer')
</body>
</html>