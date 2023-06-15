<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="/zona/publicaciones/crear" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="user">Creado por: {{$usuario->nombre}}</label>
        <input type="hidden" id="user" name="user" value="{{$usuario->id}} " required>
        <br>
        <label for="titulo">Titulo:</label>
        <input type="text" id="titulo" name="titulo" required>
        <br>
        <label for="multimedia">Imagen o Video:</label>
        <input type="file" id="multimedia" name="multimedia" accept="multimedia/*" required>
        <br>

        <label for="texto">Texto:</label>
        <input type="text" id="texto" name="texto" required>
        <br>

        <label for="zona">Zona: {{ $zona->nombre }}</label>
        <input type="hidden" id="zona" name="zona" value="{{ $zona->id }}" required>
        <br>

        <br>

        <button type='submit' name='enviar' texto=''>Crear</button>
    </form>

</body>

</html>
