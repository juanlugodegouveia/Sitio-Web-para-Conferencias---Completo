<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/all.min.css"> <!-- Se carga antes del main -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Oswald|PT+Sans" rel="stylesheet"> <!-- Importamos las fuentes que vamos a utilizar -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css">  <!-- Importamos en mapa desde https://leafletjs.com -->

  <?php
  $archivo = basename($_SERVER['PHP_SELF']);  //Nos regresa el nombre del archivo actual
  $pagina = str_replace(".php", "", $archivo); //Toma tres parametros, primo lo que quieres buscar, segundo por que lo vas a reemplazar y tercero la fuente de los datos
  if($pagina == 'invitados' || $pagina == 'index') {
    echo '<link rel="stylesheet" href="css/colorbox.css">'; //CSS para el efecto de la descripcion de los invitados
  }
  else if ($pagina == 'conferencia') {
    echo '<link rel="stylesheet" href="css/lightbox.css">'; //CSS para el efecto de las imagenes
  }
   ?>

  <link rel="stylesheet" href="css/main.css">
</head>

<body class="<?php echo $pagina; ?>"> <!--Para cambiar de paginas y saber en cual posición estamos, para luego darle estilos con css-->
  <!--[if lte IE 9]>
  <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

<header class="site-header"> <!-- Apertura site-header -->
   <div class="hero"> <!-- Apertura hero, hero= Imagen vista principal pagina Web -->
   <div class="contenido-header"> <!-- Apertura contenido-header, el cual contendra la barra de redes sociales -->

    <nav class="redes-sociales"> <!-- Apertura redes-sociales, barra de redes sociales -->
     <a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>  <!-- Icono de facebook -->
     <a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a> <!-- Icono de twitter -->
     <a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a> <!-- Icono de pinterest -->
     <a href="#"><i class="fab fa-youtube" aria-hidden="true"></i></a> <!-- Icono de youtube -->
     <a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a> <!-- Icono de instagram -->
    </nav> <!-- Cierre barra de redes sociales -->

    <div class="informacion-evento"> <!-- Apertura informacion-eventos -->

      <div class="clearfix"> <!-- Apertura Clearfix -->
        <p class="fecha"><i class="far fa-calendar-alt" aria-hidden="true"></i> 10-12 Dic</p>
        <p class="ciudad"><i class="fas fa-map-marker-alt" aria-hidden="true"></i> Santiago de Chile, Chile</p>
      </div> <!-- Cierre Clearfix -->

        <h1 class="nombre-sitio">GdlWebCamp</h1> <!-- Nombre del Sitio Web -->
        <p class="slogan">La mejor conferencia de <span>diseño web</span></p> <!-- Eslogan del Sitio Web -->

     </div> <!-- Cierre informacion-eventos -->

    </div> <!-- Cierre contenido-header -->
    </div> <!-- Cierre de hero -->
</header> <!-- Cierre site-header -->

<div class="barra"> <!-- Apertura barra de navegación -->
 <div class="contenedor clearfix"> <!-- Apertura contenedor de contenido en barra de navegación, se puede llamar el clearfix definido en el css sin afectar la clase "contenedor" -->

    <div class="logo"> <!-- Apertura de logo de barra de navegación -->
      <a href="index.php">
      <img src="img/logo.svg" alt="logo gdlwebcamp"> <!-- Los archivos .svg son imagenes vectoriales, no se distorcionan al manipular la imagen ya que son calculos matematicos  -->
      </a>
    </div>  <!-- Cierre de logo de barra de navegación -->

    <div class="menu-movil"> <!-- Apertura menu-movil, menu para el telefono móvil, se realizan las barran con el span para dar efecto de tipo sandiwch, su vista sera para telefono movil y se accionara con jQuery y CSS -->
      <span></span>
      <span></span>
      <span></span>
    </div> <!-- Cierre menu-movil -->

    <nav class="navegacion-principal clearfix"> <!-- Apertura navegación-principal, utiizamos clearfix sin afectar la clase para arreglar errores de posicion, con los media query lo mostramos en pantallas grandes y lo escondemos con CSS para que trabaje en funcion con el menu-movil -->
      <a href="conferencia.php">Conferencia</a>
      <a href="calendario.php">Calendario</a>
      <a href="invitados.php">Invitados</a>
      <a href="registro.php">Reservaciones</a>
    </nav> <!-- Cierre navegación-principal -->

 </div> <!-- Cierre contenedor de contenido en barra de navegación -->
</div> <!-- Cierre barra de navegación -->
