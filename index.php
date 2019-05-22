<?php include_once 'includes/templates/header.php'; ?>

<!-- Sección de información -->

<section class="seccion contenedor"> <!-- Apertura de Sección información -->
  <h2>La mejor conferencia de diseño web en español</h2>
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate.</p>
</section> <!-- Cierre de Sección información -->

<section class="programa"> <!-- Apertura de Sección programa (Padre de todo el contenedor) -->

  <div class="contenedor-video">  <!-- Apertura contenedor-video -->
    <video autoplay loop muted poster="img/bg-talleres.jpg"> <!-- El poster se mostrara solo en algunos dispositivos, se coloca "muted para que el video se reproduzca cuando se haga refresh a la pagina, en la seccion 43, clase 355 agrege img/ porque al inspeccionar me salir (404 not found)" -->
      <source src="video/video.mp4" type="video/mp4"> <!-- Colocamos de primero el .mp4 por que Apple los reconoce primero y sino esta, dara error-->
      <source src="video/video.mp4" type="video/webm">
      <source src="video/video.mp4" type="video/ogg">
    </video>
  </div> <!-- Cierre contenedor-video -->

  <div class="contenido-programa"> <!-- Apertura de contenido-programa -->
    <div class="contenedor"> <!-- Apertura de contenedor -->
      <div class="programa-evento"> <!-- Apertura de programa-evento -->
        <h2>Programa del Evento</h2>

        <?php //Imprimir los programas del evento con php en el menu de Programa del Evento
        try {
          require_once('includes/funciones/bd_conexion.php'); //Conectamos a la base de datos
          $sql = " SELECT * FROM categoria_evento "; //Realizamos la consulta en la tabla de nuestra base de datos en donde tenemos guardados nuestros eventos
          $resultado = $conn->query($sql); //Funcion de PHP para hacer consultas, realizamos nuestra consulta y guardamos el dato en resultado.
        } catch (\Exception $e) {
          echo $e->getMessage(); //Para atrapar el mensaje de error
        }
        ?>

        <nav class="menu-programa">
          <?php while($cat = $resultado->fetch_array(MYSQLI_ASSOC)) { //funcion para imprimir resultados, siempre que se trabaje con ella hay que ponerla dentro de un while para imprimir varios elementos, va a rrecorer el arreglo. Cambie en la base de datos conferencias por conferencia y seminario por seminarios por que me estaban dando error al ser llamadas?>
          <?php $categoria = $cat['cat_evento']; ?>
          <a href="#<?php echo strtolower($categoria) ?>"><i class="fas <?php echo $cat['icono']; ?>" aria-hidden="true"></i> <?php echo $categoria //Recordar que se activan y desactivan las clases con jQuery y CSS ?></a>
        <?php } ?>
        </nav>

        <?php
        try {
          require_once('includes/funciones/bd_conexion.php'); //Realizamos una multiconsulta seleccionando los elementos de categorias por su id y asignandole un limite de 2, luego utilizamos un do while con multi_query para poder imprimirlos ya que sino se imprime uno id.
          $sql = " SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado ";
          $sql .= " FROM eventos";
          $sql .= " INNER JOIN categoria_evento ";
          $sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria ";
          $sql .= " INNER JOIN invitados ";
          $sql .= " ON eventos.id_inv = invitados.invitado_id ";
          $sql .= " AND eventos.id_cat_evento = 1 ";
          $sql .= " ORDER BY evento_id LIMIT 2;";
          $sql .= " SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado ";
          $sql .= " FROM eventos";
          $sql .= " INNER JOIN categoria_evento ";
          $sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria ";
          $sql .= " INNER JOIN invitados ";
          $sql .= " ON eventos.id_inv = invitados.invitado_id ";
          $sql .= " AND eventos.id_cat_evento = 2 ";
          $sql .= " ORDER BY evento_id LIMIT 2;";
          $sql .= " SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado ";
          $sql .= " FROM eventos";
          $sql .= " INNER JOIN categoria_evento ";
          $sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria ";
          $sql .= " INNER JOIN invitados ";
          $sql .= " ON eventos.id_inv = invitados.invitado_id ";
          $sql .= " AND eventos.id_cat_evento =3 ";
          $sql .= " ORDER BY evento_id LIMIT 2;";
        } catch (\Exception $e) {
          echo $e->getMessage(); //Para atrapar el mensaje de error
        }
        ?>

        <?php $conn->multi_query($sql); //Para realizar consulta multiquery?>

        <?php
        do {
          $resultado = $conn->store_result(); //Esta funcion transfiere un conjunto de resulados de la última consulta
          $row = $resultado->fetch_all(MYSQLI_ASSOC); //Obtenemos todas las filas en un array asociativo, numérico, o en ambos y se recorre con un foreach?>

          <?php $i = 0;  ?>
          <?php foreach($row as $evento): ?>
            <?php if($i % 2 == 0) { //Nos aseguramos de que sea un número par, abre en los pares y cierra en los nones ?>
          <div id="<?php echo strtolower($evento['cat_evento']) ?>" class="info-curso ocultar clearfix"> <!-- Apertura de talleres -->
          <?php } ?>
            <div class="detalle-evento"> <!-- Apertura de detalle-evento -->
              <h3><?php echo html_entity_decode($evento['nombre_evento']) ?></h3>
              <p><i class="far fa-clock"></i> <?php echo $evento['hora_evento'];?></p>
              <p><i class="far fa-calendar-alt"></i> <?php echo $evento['fecha_evento'];?></p>
              <p><i class="fas fa-user"></i> <?php echo $evento['nombre_invitado'] . " " . $evento['apellido_invitado'] ;?></p>
            </div> <!-- Cierre de detalle-evento -->

            <?php if($i % 2 == 1): //Imprime el boton despues de imprimir el contenedor de detalle evento ?>
              <a href="calendario.php" class="button float-right">Ver todos</a>
          </div> <!-- Cierre de talleres -->
        <?php endif; ?>
          <?php $i++; //Antes de finalizar el foreach se incrementa el contador?>
        <?php endforeach; ?>
        <?php $resultado->free(); //Liberamos la consulta cuando se ultiliza multi_query?>
      <?php } while ($conn->more_results() && $conn->next_result());//Mientras tengas mas resultado y tenga los siguiente resultados?>
      </div> <!-- Cierre de programa-evento -->
    </div> <!-- Cierre de contenedor -->
  </div> <!-- Cierre de contenido-programa -->
</section> <!-- Cierre de Sección programa (Padre de todo el contenedor)-->

<?php include_once 'includes/templates/invitados.php'; ?>

<div class="contador parallax"> <!-- Apertura de contador parallax -->
  <div class="contenedor"> <!-- Apertura de contenedor -->
    <ul class="resumen-evento clearfix"> <!-- Apertura de resumen-evento -->
      <li><p class="numero"></p> Invitados</li>
      <li><p class="numero"></p> Talleres</li>
      <li><p class="numero"></p> Días</li>
      <li><p class="numero"></p> Conferencias</li>
    </ul> <!-- Cierre de resumen-evento -->
  </div> <!-- Cierre de contenedor -->
</div> <!-- Cierre de contador parallax -->

<!-- Lista de Precios  -->

<section class="precios seccion"> <!-- Apertura de precios-seccion  -->
  <h2>Precios</h2>
  <div class="contenedor"> <!-- Apertura de contenedor, declarado en el css para que no tope con la orilla del navegador   -->
    <ul class="lista-precios clearfix"> <!-- Apertura de lista-precios clearfix, utilizamos el clearfix ya que vamos a flotar el elemento a la izquierda   -->
      <li>
        <div class="tabla-precio"> <!-- Apertura de tabla-precio  -->
          <h3>Pase por día</h3>
          <p class="numero">$30</p>
          <ul>
            <li>Bocadillos Gratis</li>
            <li>Todas las conferencias</li>
            <li>Todos los talleres</li>
          </ul>
          <a href="#" class="button hollow">Comprar</a>
        </div> <!-- Cierre de tabla-precio  -->
      </li>

      <li>
        <div class="tabla-precio"> <!-- Apertura de tabla-precio  -->
          <h3>Todos los días</h3>
          <p class="numero">$50</p>
          <ul>
            <li>Bocadillos Gratis</li>
            <li>Todas las conferencias</li>
            <li>Todos los talleres</li>
          </ul>
          <a href="#" class="button">Comprar</a>
        </div> <!-- Cierre de tabla-precio  -->
      </li>

      <li>
        <div class="tabla-precio"> <!-- Apertura de tabla-precio  -->
          <h3>Pase por 2 días</h3>
          <p class="numero">$45</p>
          <ul>
            <li>Bocadillos Gratis</li>
            <li>Todas las conferencias</li>
            <li>Todos los talleres</li>
          </ul>
          <a href="#" class="button hollow">Comprar</a>
        </div> <!-- Cierre de tabla-precio  -->
      </li>
    </ul> <!-- Cierre de lista-precios clearfix   -->
  </div>
</section>  <!-- Cierre de precios-seccion  -->


<!-- Mapa  -->

<div id="mapa" class="mapa"> <!-- Apertura de mapa  -->


</div> <!-- Cierre de mapa  -->

<!-- Testimoniales  -->

<section class="seccion">
  <h2>Testimoniales</h2>
  <div class="testimoniales contenedor clearfix">
  <div class="testimonial"> <!-- Apertura de testimonial  -->
    <blockquote cite="http://"> <!-- Etiqueta usada para testimmoniales  -->
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
      <footer class="info-testimonial clearfix">
        <img src="img/testimonial.jpg" alt="imagen testimonial">
        <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
      </footer>
    </blockquote>
  </div> <!-- Cierre de testimonial  -->

  <div class="testimonial"> <!-- Apertura de testimonial  -->
    <blockquote cite="http://"> <!-- Etiqueta usada para testimmoniales  -->
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
      <footer class="info-testimonial clearfix">
        <img src="img/testimonial.jpg" alt="imagen testimonial">
        <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
      </footer>
    </blockquote>
  </div> <!-- Cierre de testimonial  -->

  <div class="testimonial"> <!-- Apertura de testimonial  -->
    <blockquote cite="http://"> <!-- Etiqueta usada para testimmoniales  -->
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
      <footer class="info-testimonial clearfix">
        <img src="img/testimonial.jpg" alt="imagen testimonial">
        <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
      </footer>
    </blockquote>
  </div> <!-- Cierre de testimonial  -->
</div> <!-- Cierre de testimoniales contenedor clearfix  -->
</section> <!-- Cierre de seccion de testimoniales -->

<!-- Newsletter-->

<div class="newsletter parallax"> <!-- Apertura de newsletter parallax  -->
  <div class="contenido contenedor"> <!-- Apertura de contenido contenedor  -->
    <p>Regístrate al newsletter</p>
    <h3>gdlwebcamp</h3>
    <a href="#mc_embed_signup" class="boton_newsletter button transparente">Registro</a>
  </div> <!-- Cierre de contenido contenedor  -->
</div> <!-- Cierre de newsletter parallax  -->

<!-- Faltan  -->

<section class="seccion"> <!-- Apertura de seccion de faltan  -->
  <h2>Faltan</h2>
  <div class="cuenta-regresiva contenedor"> <!-- Apertura de cuenta-regresivan  -->
    <ul class="clearfix">
      <li><p id="dias" class="numero">0</p> días</li>
      <li><p id="horas" class="numero">0</p> horas</li>
      <li><p id="minutos" class="numero">0</p> minutos</li>
      <li><p id="segundos" class="numero">0</p> segundos</li>
    </ul>
  </div> <!-- Cierre de cuenta-regresivan  -->
</section> <!-- Cierre de seccion de faltan  -->

<?php include_once 'includes/templates/footer.php'; ?>
