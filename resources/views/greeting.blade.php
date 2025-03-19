<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello {{ $name }}, you're welcome</h1>
    <h1>You are {{ $age }} years old</h1>

    <button><a href={{ url('greeting3') }}>Click here for url()</a></button>
    <br>
    <button><a href={{ route('greet') }}>Click here for route()</a></button>
</body>
</html>