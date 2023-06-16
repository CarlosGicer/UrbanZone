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
    <link rel="stylesheet" href="{{ asset('cssMio/stylesMio.css') }}">
    <style>
    </style>
</head>

<body>
    <nav>
        <ul class="menu nav-menu">
            <a href="https://fontmeme.com/shadow-effect/" id="este"><img
                    src="https://fontmeme.com/permalink/230612/02a9c006e8f5fe9bee2b8a725e9948e6.png" alt="shadow-effect"
                    border="0"></a>
            <li><a href="/Inicio">Mapa</a></li>
            <li><a href="/zonas">Zonas</a></li>
            <li><a href="/zona/nueva">Nueva Zona</a></li>
            <li style="z-index:9999">
                <a href="#">Deportes</a>
                <ul class="menu-item">
                    @foreach ($deportes as $deporte)
                        <li><a href="/Inicio/{{ $deporte->id }}">{{ $deporte->nombre }}</a></li>
                    @endforeach
                </ul>

            </li>

            <li> {{-- @auth --}}
                <a class="nav-link active" href="/profile">Perfil</a>
                {{-- @else
                        <li style="list-style: none">
                            <a id="login-register-button" href="{{ route('login') }}" id="login-register-button">LOGIN</a>
                            @if (Route::has('register')) --}}
            </li>
        </ul>

    </nav>
    <div class="main">
        <ul class="cards">
            @foreach ($zonas as $zona)
                @if ($deporte_id == $zona->deporte_id)
                    <li class="cards_item">
                        <div class="card">
                            <div class="card_image"><img class="foto" src="{{ asset($zona->imagen) }}"></div>
                            <div class="card_content">
                                <h2 class="card_title">{{ $zona->nombre }}</h2>
                                @foreach ($deportes as $deporte)
                                    @if ($deporte->id == $zona->deporte_id)
                                        <p class="card_text">Deporte: {{ $deporte->nombre }} </p>
                                    @endif
                                @endforeach
                              
                                    <a href="/zonas/publicaciones/{{ $zona->id }}"><button class="btn card_btn"> Ver </button></a>
                               
                            </div>
                        </div>
                    </li>
                @elseif ($deporte_id == null)
                    <li class="cards_item">
                        <div class="card">
                            <div class="card_image"><img class="foto" src="{{ asset($zona->imagen) }}"></div>
                            <div class="card_content">
                                <h2 class="card_title">{{ $zona->nombre }}</h2>
                                @foreach ($deportes as $deporte)
                                    @if ($deporte->id == $zona->deporte_id)
                                        <p class="card-text">Deporte: {{ $deporte->nombre }} </p>
                                    @endif
                                @endforeach
                                <a href="/zonas/publicaciones/{{ $zona->id }}"><button class="btn card_btn"> Ver </button></a>
                               
                            </div>
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>
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
