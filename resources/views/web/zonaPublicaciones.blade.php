<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarjeta Bootstrap</title>
    <!-- Agrega los enlaces a los archivos CSS de Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('cssMio/stylesMio.css') }}">
</head>

<body>
    <nav class="sticky-top">
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

    <div id="top">
        <h1>{{ $zona->nombre }}</h1>
         @foreach ($deportes as $deporte)
            @if ($zona->deporte_id == $deporte->id) 
                <h3>{{ $deporte->nombre }}</h3>
            @endif
        @endforeach 
        <img class="FotoZona" src="{{ asset($zona->imagen) }}" alt="..." width="30%" height="30%">

        <!-- Agrega los enlaces a los archivos JavaScript de Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>


        <div
            style="width: 55%; margin:20px;   box-shadow: 0 0 20px rgba(0, 0, 0, 0.9);  border: 1px solid black; border-radius: 20px;  float: right;  margin-right: 5%;">

            <div id="map" style="height: 65vh; color: black; border-radius: 20px;"></div>

        </div>


    </div>






    <div class="principal">
        <a class="bt" href="/zonas/publicaciones/{{ $zona->id }}/nueva">Nueva publicacion</a>
        <span></span>
        @foreach ($publicaciones as $publicacion)
            @php
                $extension = pathinfo($publicacion->multimedia, PATHINFO_EXTENSION);
            @endphp

            <div class="publicacion">
                <div class="content">
                    @if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif')
                        <img src="{{ asset($publicacion->multimedia) }}" alt="Imagen de la publicación"
                            class="publicacion-img">
                    @elseif ($extension == 'mp4' || $extension == 'avi' || $extension == 'mov')
                        <video src="{{ asset($publicacion->multimedia) }}" controls class="publicacion-img"></video>
                    @endif
                    <div class="Box_Comentarios">
                        <h2>{{ $publicacion->titulo }}</h2>
                        @foreach ($usuarios as $usuario)
                            @if ($publicacion->user_id == $usuario->id)
                                <p>Creador: {{ $usuario->nombre }}</p>
                            @endif
                        @endforeach

                        <form action="/publicaciones/comentario/crear" method="POST" enctype="multipart/form-data"
                            id="msform">
                            @csrf
                            <input type="hidden" id="user_id" name="user_id" value="{{ $usuario->id }} " required>
                            <input type="hidden" id="zona" name="zona" value="{{ $zona->id }} " required>
                            <input type="hidden" id="publicacion_id" name="publicacion_id"
                                value="{{ $publicacion->id }} " required>
                            <label for="Comentario">Comentario:</label>
                            <input type="text" id="texto" name="texto" required>
                            <button class="submit action-button" type='submit' name='enviar'
                                texto=''>Comentar</button>
                        </form>
                        <br>

                        @foreach ($comentarios as $comentario)
                            @if ($comentario->publicacion_id == $publicacion->id)
                                @foreach ($usuarios as $usuario)
                                    @if ($comentario->user_id == $usuario->id)
                                        <p style="color:black">
                                            <img class="img-perfil" src="{{ asset($usuario->imagen) }}" alt="">
                                            {{ $usuario->nombre }} :{{ $comentario->texto }}
                                        </p>
                                        <span></span>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</body>

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


</html>
<script src="https://api.mapbox.com/mapbox-gl-js/v2.5.0/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v2.5.0/mapbox-gl.css" rel="stylesheet" />
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.3/mapbox-gl-geocoder.min.js"></script>
<link rel="stylesheet"
    href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.3/mapbox-gl-geocoder.css"
    type="text/css" />


<script>
    mapboxgl.accessToken =
        'pk.eyJ1IjoiY2FybG9zZ2ljZXIiLCJhIjoiY2xobnBjaGh5MW9tbjNkcDE0OHUyMjU3ZyJ9.VmS8t445rgyEO8N6Nmqjvg';

    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/outdoors-v12',
        zoom: 10
    });

    // Obtener la ubicación actual del usuario
    navigator.geolocation.getCurrentPosition(function(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        // Establecer el centro del mapa en la ubicación actual del usuario
        map.setCenter([longitude, latitude]);
    });

    var markers = [{
        type: 'Feature',
        properties: {
            title: "{{ $zona->nombre }}",
            description: '<img src="{{ asset($zona->imagen) }}" alt="{{ $zona->nombre }}" width="200px">'
        },
        geometry: {
            type: 'Point',
            coordinates: [{{ $zona->longitud }}, {{ $zona->latitud }}]
        }
    }, ];


    map.on('load', function() {
        map.addSource('markers', {
            type: 'geojson',
            data: {
                type: 'FeatureCollection',
                features: markers
            },
            cluster: true,
            clusterMaxZoom: 14,
            clusterRadius: 50
        });

        map.addLayer({
            id: 'clusters',
            type: 'circle',
            source: 'markers',
            filter: ['has', 'point_count'],
            paint: {
                'circle-color': [
                    'step',
                    ['get', 'point_count'],
                    '#51bbd6',
                    10,
                    '#f1f075',
                    100,
                    '#f28cb1'
                ],
                'circle-radius': [
                    'step',
                    ['get', 'point_count'],
                    15,
                    10,
                    20,
                    100,
                    30
                ]
            }
        });

        map.addLayer({
            id: 'cluster-count',
            type: 'symbol',
            source: 'markers',
            filter: ['has', 'point_count'],
            layout: {
                'text-field': '{point_count_abbreviated}',
                'text-font': ['DIN Offc Pro Medium', 'Arial Unicode MS Bold'],
                'text-size': 12
            },
            paint: {
                'text-color': '#ffffff'
            }
        });

        map.addLayer({
            id: 'unclustered-point',
            type: 'circle',
            source: 'markers',
            filter: ['!', ['has', 'point_count']],
            paint: {
                'circle-color': 'red',
                'circle-radius': 9,
                'circle-stroke-width': 1,
                'circle-stroke-color': 'red'
            }
        });

        map.on('click', 'clusters', function(e) {
            var features = map.queryRenderedFeatures(e.point, {
                layers: ['clusters']
            });
            var clusterId = features[0].properties.cluster_id;
            map.getSource('markers').getClusterExpansionZoom(clusterId, function(err, zoom) {
                if (err) return;

                map.easeTo({
                    center: features[0].geometry.coordinates,
                    zoom: zoom
                });
            });
        });


        map.on('click', 'unclustered-point', function(e) {
            var coordinates = e.features[0].geometry.coordinates.slice();
            var properties = e.features[0].properties;

            new mapboxgl.Popup()
                .setLngLat(coordinates)
                .setHTML('<h3>' + properties.title + '</h3>' + properties.description)
                .addTo(map);
        });

        // Agregar el geocodificador al mapa
        var geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            mapboxgl: mapboxgl
        });

        map.addControl(geocoder);

        // Crear instancia del NavigationControl
        var navControl = new mapboxgl.NavigationControl();

        map.addControl(navControl, 'top-right');


        // Agregar el control de geolocalización al mapa
        var geolocateControl = new mapboxgl.GeolocateControl({
            positionOptions: {
                enableHighAccuracy: true
            },
            trackUserLocation: true,
            showUserHeading: true,
            showAccuracyCircle: false
        });

        map.addControl(geolocateControl);



        map.on('mouseenter', 'clusters', function() {
            map.getCanvas().style.cursor = 'pointer';
        });

        map.on('mouseleave', 'clusters', function() {
            map.getCanvas().style.cursor = '';
        });

        map.on('mouseenter', 'unclustered-point', function() {
            map.getCanvas().style.cursor = 'pointer';
        });

        map.on('mouseleave', 'unclustered-point', function() {
            map.getCanvas().style.cursor = '';
        });
    });
</script>
