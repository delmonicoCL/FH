<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Food Hero - Salva Comida Alimenta Corazones</title>
  {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
  {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
  <link href="https://fonts.cdnfonts.com/css/luckiest-guy" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/landing.css') }}" />
 
</head>

<body>

  <div class="container-fluid">


    <nav class="navbar navbar-expand-lg barra">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img class="logo-barra" src="{{ asset('img/logo-02.png') }}" alt="Food Hero" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link" href="#home">Home</a>
            <a class="nav-link" href="#nosotros">Nosotros</a>
            <a class="nav-link" href="#raider">Raider</a>
            <a class="nav-link" href="#proveedor">Proveedor</a>
            <a class="nav-link" href="#footer">Unete</a>
            <a class="nav-link"  href="{{ route('login') }}" style="color: black;">Ir al APP</a>
          </div>
        </div>
      </div>
    </nav>


    
    <section id="home" class="contenedor-seccion">
      <div class="contenedor-imagen">
       <img src="{{ asset('img/home.png') }}" alt="">
      </div>
    </section>

    <section id="nosotros" class="contenedor-seccion">
      <div class="contenedor-imagen">
        <img src="{{ asset('img/nosotros.png') }}" alt="">
        <p class="parrafo"> ¡Bienvenidos a Food Heroe! plataforma que une a héroes sin capa que salvan comida y alimentan corazones. Proveedores (generan menú de regalo) y 
          raiders (entregan menú) se unen en una noble causa para alimentar al necesitado, geolozalizados en la app 
        </p>
      </div>
    </section>

    <section id="raider" class="contenedor-seccion">
      <div class="contenedor-imagen">
        <img src="{{ asset('img/raider.png') }}" alt="">
        <p class="parrafo"> Nuestros riders, a través de nuestro app, al momento de identificar un persona en necesidad, pueden crear un punto geolocalizado de entrega 
          (denominado "pua"), además la posibilidad de repartir un menú solidario creado por un proveedor 
        </p>
      </div>
    </section>

    <section id="proveedor" class="contenedor-seccion">
      <div class="contenedor-imagen">
        <img src="{{ asset('img/proveedor.png') }}" alt="">
        <p class="parrafo"> Los proveedores arman menús (desayuno, comida, cena), elaborados con productos de sus tiendas, que están dispuestos a regalar a alguien lo necesite. A través de la app 
          generan una púa con la cantidad de menús, que luego será retirado y entregado por un raider
        </p>
      </div>
    </section>

    

    <section id="footer" class="contenedor-seccion">
      <div class="contenedor-imagen">
      
        <img src="{{ asset('img/footer.png') }}" alt="">
        <p class="parrafo"> Únete a nosotros en esta misión. ¡Juntos podemos hacer una diferencia real en las vidas de quienes más lo necesitan! 
          El mundo te necesita, el mundo necesita nuevos héroes
        </p>
      </div>
    </section>
  </div>


 

<!-- Script para cargar Landbot -->
<script>
    window.addEventListener('mouseover', initLandbot, { once: true });
    window.addEventListener('touchstart', initLandbot, { once: true });
    var myLandbot;
    function initLandbot() {
        if (!myLandbot) {
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.addEventListener('load', function() {
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




  <!-- Scripts de Bootstrap (jQuery y Popper.js) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="/assets/js/script.js"></script>
</body>

</html>