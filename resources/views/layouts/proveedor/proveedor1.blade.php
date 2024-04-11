<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mapa con Mapbox</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src='https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.css' rel='stylesheet' />

    <link rel="icon" type="image/png" href="{{ asset('img/logo-02.png') }}">
    <link rel="stylesheet" href="{{ asset('css/proveedor1.css') }}" />
</head>

<body>
    @yield('contenido')
    <div id="map">
        <a href="{{ route('proveedor2') }}">
            <button class="mover" id="mover">Gestionar Proveedor</button>
        </a>
    </div>
    <script src="{{ asset('js/rider.js') }}"></script>
</body>

</html>