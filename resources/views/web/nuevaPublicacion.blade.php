<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        /*custom font*/
        @import url(https://fonts.googleapis.com/css?family=Montserrat);

        /*basic reset*/
        * {
            margin: 0;
            padding: 0;
        }

        html {
            height: 100%;
            /*Image only BG fallback*/

            /*background = gradient + image pattern combo*/
            background:
            linear-gradient(#e1f6ff, #afe8ff)
        }

        body {
            font-family: montserrat, arial, verdana;
        }

        /*form styles*/
        #msform {
            width: 90%;
            margin: 50px auto;
            text-align: center;
            position: relative;
        }

        #msform fieldset {
            background: white;
            border: 0 none;
            border-radius: 3px;
            box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
            padding: 20px 20px;
            box-sizing: border-box;
            width: 80%;
            margin: 0 10%;
        }


        /*inputs*/
        #msform input,
        #msform textarea {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-bottom: 5px;
            width: 100%;
            box-sizing: border-box;
            font-family: montserrat;
            color: #2C3E50;
            font-size: 13px;
            text-align: center;
        }

        /*buttons*/
        #msform .action-button {
            width: 100px;
            background: #27AE60;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 1px;
            cursor: pointer;
            padding: 10px;
            margin: 10px 5px;
            text-decoration: none;
            font-size: 14px;
        }

        #msform .cancel.action-button {
            width: 100px;
            background: #ae2727;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 1px;
            cursor: pointer;
            padding: 10px;
            margin: 10px 5px;
            text-decoration: none;
            font-size: 14px;
        }

        #msform .action-button:hover,
        #msform .action-button:focus {
            box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
        }

        #msform .cancel.action-button:hover,
        #msform .cancel.action-button:focus {
            box-shadow: 0 0 0 2px white, 0 0 0 3px #ae2727;
        }

        /*headings*/
        .fs-title {
            font-size: 15px;
            text-transform: uppercase;
            color: #2C3E50;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <form action="/zona/publicaciones/crear" method="POST" enctype="multipart/form-data" id="msform">
        @csrf
        <fieldset>
            <h2 class="fs-title">Create your account</h2>
            <label for="user">Creado por: {{ $usuario->nombre }}</label>
            <input type="hidden" id="user" name="user" value="{{ $usuario->id }} " required>
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

            <button class="submit action-button" type='submit' name='enviar' texto=''>Crear</button>
            <button class="cancel action-button" type="button" onclick="window.history.back()">Cancelar</button>
    </form>
    </fieldset>
</body>

</html>
