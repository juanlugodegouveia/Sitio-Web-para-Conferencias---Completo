<!-- Footer  -->

<footer class="site-footer">
  <div class="contenedor clearfix"> <!-- Apertura de contenedor clearfix  -->

    <div class="footer-informacion">
      <h3>Sobre <span>gdlwebcamp</span></h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua  tempor incididunt ut labore et dolore magna</p>
    </div>

    <div class="ultimos-tweets">
      <h3>Últimos <span>tweets</span></h3>
<a class="twitter-timeline" data-height="400" data-link-color="#fe4918" href="https://twitter.com/gdlwebcamp?ref_src=twsrc%5Etfw">Tweets by gdlwebcamp</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </div>

    <div class="menu">
      <h3>Redes <span>sociales</span></h3>
      <nav class="redes-sociales"> <!-- Apertura redes-sociales, barra de redes sociales -->
       <a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>  <!-- Icono de facebook -->
       <a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a> <!-- Icono de twitter -->
       <a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a> <!-- Icono de pinterest -->
       <a href="#"><i class="fab fa-youtube" aria-hidden="true"></i></a> <!-- Icono de youtube -->
       <a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a> <!-- Icono de instagram -->
      </nav> <!-- Cierre barra de redes sociales -->
   </div>
    </div> <!-- Cierre de contenedor clearfix  -->
    <p class="copyright">Todos los derechos reservados GDLWEBCAMP 2018.</p>

    <!-- Codigo de mailchimp  -->
    <!-- Begin Mailchimp Signup Form -->
  <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
  <style type="text/css">
  	#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
  	/* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
  	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
  </style>

  <div style="display: none;"> <!-- Contenedor agregado por nosotros para que se mueste cuando le demos click-->

  <div id="mc_embed_signup">
  <form action="https://gdlwebcamp.us20.list-manage.com/subscribe/post?u=99752ff6c01d0df086d1b610e&amp;id=01964fda30" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
      <div id="mc_embed_signup_scroll">
  	<h2>Suscribete al Newsletter y no te pierdas nada de este evento</h2>
  <div class="indicates-required"><span class="asterisk">*</span> Es obligatorio</div>
  <div class="mc-field-group">
  	<label for="mce-EMAIL">Correo Electrónico  <span class="asterisk">*</span>
  </label>
  	<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
  </div>
  <div class="mc-field-group">
  	<label for="mce-FNAME">Nombre </label>
  	<input type="text" value="" name="FNAME" class="" id="mce-FNAME">
  </div>
  <div class="mc-field-group">
  	<label for="mce-LNAME">Apellido </label>
  	<input type="text" value="" name="LNAME" class="" id="mce-LNAME">
  </div>
  	<div id="mce-responses" class="clear">
  		<div class="response" id="mce-error-response" style="display:none"></div>
  		<div class="response" id="mce-success-response" style="display:none"></div>
  	</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
      <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_99752ff6c01d0df086d1b610e_01964fda30" tabindex="-1" value=""></div>
      <div class="clear"><input type="submit" value="Suscribirse" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
      </div>
  </form>
  </div>
  <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
  <!--End mc_embed_signup-->
  </div>
  </footer>

  <!-- Add your site or application content here -->
  <script src="js/vendor/modernizr-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
  <script src="js/plugins.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script> <!-- Nuestro plugin de contador descargado de http://aishek.github.io/jquery-animateNumber/ -->
  <script src="js/jquery.countdown.min.js"></script> <!-- Nuestro plugin de contador(Cuenta regresiva) descargado de http://hilios.github.io/jQuery.countdown/ -->

  <?php
  $archivo = basename($_SERVER['PHP_SELF']);  //Nos regresa el nombre del archivo actual
  $pagina = str_replace(".php", "", $archivo); //Toma tres parametros, primo lo que quieres buscar, segundo por que lo vas a reemplazar y tercero la fuente de los datos
  if($pagina == 'invitados' || $pagina == 'index') {
    echo '<script src="js/jquery.colorbox-min.js"></script>'; //Nuestro plugin de contador(Cuenta regresiva) descargado de http://hilios.github.io/jQuery.countdown/
    echo '<script src="js/jquery.waypoints.min.js"></script>'; //Nuestro plugin de waypoints para saber en que parte de la pantalla estamos.
  }
  else if ($pagina == 'conferencia') {
    echo '<script src="js/lightbox.js"></script>'; //Nuestro plugin para el efecto en la galería de imagenes. seccion 38, clase 290 https://lokeshdhakar.com/projects/lightbox2/
  }
   ?>

  <script src="js/jquery.lettering.js"></script> <!-- Nuestro plugin para el efecto de las letras de https://github.com/davatron5000/Lettering.js -->
  <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script>
  <script src="js/main.js"></script>
  <script src="js/cotizador.js"></script>

  <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
  <script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('send', 'pageview')
  </script>
  <script src="https://www.google-analytics.com/analytics.js" async defer></script>

  <script type="text/javascript" src="//downloads.mailchimp.com/js/signup-forms/popup/unique-methods/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script><script type="text/javascript">window.dojoRequire(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us20.list-manage.com","uuid":"99752ff6c01d0df086d1b610e","lid":"01964fda30","uniqueMethods":true}) })</script> <!-- Codigo copiado de mailchimp -->

</body> <!-- Cierre del body -->

</html>
