<!DOCTYPE html>
<html>

<head>
    <title>Paguina Deporte</title>
    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('cssMio/stylesMio.css') }}">

</head>

<body>

   
    <nav>
        <a href="https://fontmeme.com/shadow-effect/" id="este"><img
            src="https://fontmeme.com/permalink/230612/02a9c006e8f5fe9bee2b8a725e9948e6.png" alt="shadow-effect"
            border="0"></a>

        <ul class="menu nav-menu">
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





    <div style="width: 97%; margin:20px;   box-shadow: 0 0 20px rgba(0, 0, 0, 0.9);  border: 1px solid black; border-radius: 20px; ">
        <div>
            <div id="map" style="height: 80vh; color: black; border-radius: 20px;"></div>
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

    var markers = [
        @foreach ($zonas as $zona)
            @if ($deporte_id == $zona->deporte_id)
                {
                    type: 'Feature',
                    properties: {
                        title: "{{ $zona->nombre }}",
                        description: '<a href="/zonas/publicaciones/{{ $zona->id }}"><img src="{{ asset($zona->imagen) }}" alt="{{ $zona->nombre }}" width="200px"></a>'
                    },
                    geometry: {
                        type: 'Point',
                        coordinates: [{{ $zona->longitud }}, {{ $zona->latitud }}]
                    }
                },
            @elseif ($deporte_id == null) {
                    type: 'Feature',
                    properties: {
                        title: "{{ $zona->nombre }}",
                        description: '<a href="/zonas/publicaciones/{{ $zona->id }}"><img src="{{ asset($zona->imagen) }}" alt="{{ $zona->nombre }}" width="200px"></a>'
                    },
                    geometry: {
                        type: 'Point',
                        coordinates: [{{ $zona->longitud }}, {{ $zona->latitud }}]
                    }
                },
            @endif
        @endforeach
    ];


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
