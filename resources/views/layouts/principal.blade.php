<!DOCTYPE html>
<html lang="es" style="background-color: #FECB09;">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" href="{{asset('img/favicon.png')}}" type="image/x-icon">
        <title>
            @yield("titulo")
        </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://fonts.cdnfonts.com/css/luckiest-guy" rel="stylesheet">
    </head>
    <body style="background-color: #FECB09;">
        <div class="container-fluid">
            <a href="@yield("paginaAnterior")">
                <img src="{{asset('media/img/iconos/atras.png')}}" alt="imagen modificada de 'to be continued' de JoJo's Bizarre Adventure" height="100vh" width="180vw" draggable="false">
            </a>
            @include('partials.mensajes')
            <div class="row" style="display:flex; align-items: center; justify-content: center;">
                <div class="col-sm-6 d-none d-md-block text-end" style="display:flex; align-items: center; justify-content: flex-end;">
                    <img src="{{asset('media/img/zanahoria.png')}}" alt="karoteno" height="700vh" width="700vw" draggable="false">
                </div>
                @yield("contenido")
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- Script para cargar Landbot -->
    <script>
        window.addEventListener('mouseover', initLandbot, { once: true });
        window.addEventListener('touchstart', initLandbot, { once: true });
        var myLandbot;
        function initLandbot()
        {
            if (!myLandbot)
            {
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.addEventListener('load', function()
                {
                    var myLandbot = new Landbot.Livechat({
                        configUrl: 'https://storage.googleapis.com/landbot.online/v3/H-2183130-L3SDF8GFLGZH0B4A/index.json',
                    });
                });
                s.src = 'https://cdn.landbot.io/landbot-3/landbot-3.0.0.js';
                var x = document.getElementsByTagName('script')[0];
                x.parentNode.insertBefore(s, x);
            }
        }
    </script>
</html>