<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    @include('header')

        <h1>Заявка № {{$id}}</h1>
        <p>Статус: </p>
        <p>Категория: </p>
        <p>Текст заявки: </p>
    </header>
        
    </main>
    @include('footer')
</body>
</html>