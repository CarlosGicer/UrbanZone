<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('cssMio/styleAdmin.css') }}">
</head>

<body>
    <div class="container-fluid">
        <nav id="nav-3">
            <a class="link-3" href="/zonas"> UrbanZone </a>
            <a class="link-3" href="/zonas">Zonas</a>
            <a class="link-3" href="/profile">Perfil</a>
        </nav>
        <table class="table table-hover">
            <thead>

                <th class="text-center">Nombre</th>
                <th class="text-center">comentario</th>
                <th class="text-center">fecha</th>



            </thead>
            <tbody>
                @foreach ($comentarios as $comentario)
                    @if ($comentario->publicacion_id == $publicacion->id)
                        @foreach ($usuarios as $usuario)
                            @if ($comentario->user_id == $usuario->id)
                                <td class="text-center">{{ $usuario->nombre }}</td>
                                <td class="text-center">{{ $comentario->texto }}</td>
                                <td class="text-center">{{ $comentario->update_at }}</td>
                            @endif
                            <td>
                                <a href="/admin/eliminar/comentario/{{$comentario->id}}">❌</a>
                            </td>
                        @endforeach
                    @endif
                @endforeach
                <div class="pagination justify-content-center">
                    {{ $comentarios->links() }}
                </div>
            </tbody>

        </table>
    </div>

    </div>


    <div class="footer-clean">
        <footer>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-4 col-md-3 item">
                        <h3>Services</h3>
                        <ul>
                            <li><a href="#">Web design</a></li>
                            <li><a href="#">Development</a></li>
                            <li><a href="#">Hosting</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 item">
                        <h3>About</h3>
                        <ul>
                            <li><a href="#">Company</a></li>
                            <li><a href="#">Team</a></li>
                            <li><a href="#">Legacy</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 item">
                        <h3>Careers</h3>
                        <ul>
                            <li><a href="#">Job openings</a></li>
                            <li><a href="#">Employee success</a></li>
                            <li><a href="#">Benefits</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a
                            href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i
                                class="icon ion-social-snapchat"></i></a><a href="#"><i
                                class="icon ion-social-instagram"></i></a>
                        <p class="copyright">Company Name © 2018</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>


<!-- Agrega los enlaces a los archivos JavaScript de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
