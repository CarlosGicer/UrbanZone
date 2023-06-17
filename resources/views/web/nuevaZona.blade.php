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

        select {
            width: 200px;
           
            padding: 5px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        select option {
            font-size: 14px;
            background-color: #fff;
            color: #333;
        }
    </style>
</head>

<body>
    <form action="/zona/crear" method="POST" enctype="multipart/form-data" id="msform">
        @csrf
        <!-- fieldsets -->
        <fieldset>
            <h2 class="fs-title">Crear Zona</h2>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" style="border-radius: 60px;" required>
            <br> <br>
            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" style="border-radius: 60px; padding-left:40%" required>
            <br> <br>
            <label for="deporte_id">Tipo de Deporte:</label>
            <select name="deporte_id" id="deporte_id">
                @foreach ($deportes as $deporte)
                    <option value="{{ $deporte->id }}">{{ $deporte->nombre }}</option>
                @endforeach

            </select>

            <br>
            <br>
            <h2 class="fs-title">¿Donde?</h2>
            <div style=" border: 1px solid black; border-radius: 20px;">
                <div id="map" style="height: 60vh;  width: 100%;  color: black; border-radius: 20px;"></div>
            </div>
            <input type="hidden" id="latitud" name="latitud" required>
           
            <input type="hidden" id="longitud" name="longitud" required>
         
            <button class="submit action-button" type='submit' name='enviar' texto=''>Crear</button>
            <button class="cancel action-button" type="button" onclick="window.history.back()">Cancelar</button>
        </fieldset>
    </form>

</body>

</html>
<script src="https://api.mapbox.com/mapbox-gl-js/v2.5.0/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v2.5.0/mapbox-gl.css" rel="stylesheet" />
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.3/mapbox-gl-geocoder.min.js"></script>
<link rel="stylesheet"
    href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.3/mapbox-gl-geocoder.css"
    type="text/css" />



<!--El mapa -->
<script>
    //token
    mapboxgl.accessToken =
        'pk.eyJ1IjoiY2FybG9zZ2ljZXIiLCJhIjoiY2xobnBjaGh5MW9tbjNkcDE0OHUyMjU3ZyJ9.VmS8t445rgyEO8N6Nmqjvg';

    //Vista del mapa
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/outdoors-v12',
        zoom: 14
    });

    // Obtener la ubicación actual del usuario
    navigator.geolocation.getCurrentPosition(function(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        // Establecer el centro del mapa en la ubicación actual del usuario
        map.setCenter([longitude, latitude]);
    });

    var markers = [
        // Generar los marcadores de las zonas
        @foreach ($zonas as $zona)
            {
                type: 'Feature',
                properties: {
                    title: "{{ $zona->nombre }}",
                    description: '<img src="{{ asset($zona->imagen) }}" alt="{{ $zona->nombre }}" width="200px">'
                },
                geometry: {
                    type: 'Point',
                    coordinates: [{{ $zona->longitud }}, {{ $zona->latitud }}]
                }
            },
        @endforeach
    ];


    //Añadir posicion con click en el mapa
    var currentMarker = null;
    map.on('click', function(e) {
        var latitud = e.lngLat.lat;
        var longitud = e.lngLat.lng;
        document.getElementById('latitud').value = latitud;
        document.getElementById('longitud').value = longitud;

        // Eliminar marcador anterior si existe
        if (currentMarker) {
            currentMarker.remove();
        }

        // Crear nuevo marcador
        currentMarker = new mapboxgl.Marker({
                color: "red"
            })
            .setLngLat([longitud, latitud])
            .addTo(map);
    });

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

        // Mostrar información detallada al hacer clic en un cluster
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

        // Mostrar información detallada al hacer clic en un marcador individual
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



        // Cambiar el cursor al pasar sobre un cluster o marcador individual
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

    // Agregar controles adicionales al mapa
    map.addControl(new mapboxgl.MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        mapboxgl: mapboxgl
    }));
    map.addControl(new mapboxgl.NavigationControl());
    map.addControl(new mapboxgl.GeolocateControl({
        positionOptions: {
            enableHighAccuracy: true
        },
        trackUserLocation: true,
        showUserHeading: true,
        showAccuracyCircle: false
    }));
</script>
