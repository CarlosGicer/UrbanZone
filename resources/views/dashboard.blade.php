<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           <a href="/zona/nueva">Nueva Zona</a> 
        </h2>
    </x-slot>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div id="map" style="height: 100vh;  color: black;"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://api.mapbox.com/mapbox-gl-js/v2.5.0/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.5.0/mapbox-gl.css" rel="stylesheet" />

    <script>
      mapboxgl.accessToken = 'pk.eyJ1IjoiY2FybG9zZ2ljZXIiLCJhIjoiY2xobnBjaGh5MW9tbjNkcDE0OHUyMjU3ZyJ9.VmS8t445rgyEO8N6Nmqjvg';

        var markers = [
            ["Garrucha", -1.821653, 37.180590],
            ["Vera", -1.862156, 37.244518],
            ["Mojacar", -1.851172, 37.140214],
            ["Cuevas del Almanzora", -1.877148, 37.292129]
        ];
        var zoom = 10;

        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/outdoors-v12',
        
            center: [-1.821653, 37.180590],
            zoom: zoom
        });

        map.on('load', function () {
            for (var i = 0; i < markers.length; i++) {
                new mapboxgl.Marker()
                    .setLngLat([markers[i][1], markers[i][2]])
                    .setPopup(new mapboxgl.Popup().setHTML('<h3>' + markers[i][0] + '</h3>'))
                    .addTo(map);
            }
        });
    </script>
</x-app-layout>