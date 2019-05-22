<?php include_once 'includes/templates/header.php'; ?>

<!-- Sección de registro de usuario -->

<section class="seccion contenedor"> <!-- Apertura seccion registro usuarios -->
  <h2>Registro de Usuarios</h2>
  <form id="registro" class="registro" action="pagar.php" method="post"> <!-- Apertura de formulario -->
    <div id="datos_usuario" class="registro caja clearfix"> <!-- Apertura de datos_usuario, contenedor de registro -->
      <div class="campo"> <!-- Apertura de campo nombre-->
        <label for="nombre">Nombre: </label> <!-- Creamos etiqueta para el nombre-->
        <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre"> <!-- Creamos campo para el nombre-->
      </div> <!-- Cierre de campo nombre-->

      <div class="campo"> <!-- Apertura de campo apellido-->
        <label for="apellido">Apellido: </label> <!-- Creamos etiqueta para el apellido-->
        <input type="text" id="apellido" name="apellido" placeholder="Tu Apellido"> <!-- Creamos campo para el apellido-->
      </div> <!-- Cierre de campo apellido-->

      <div class="campo"> <!-- Apertura de campo email-->
        <label for="email">Email: </label> <!-- Creamos etiqueta para el email-->
        <input type="email" id="email" name="email" placeholder="Tu Email"> <!-- Creamos campo para el email-->
      </div> <!-- Cierre de campo email-->

      <div id="error"> <!-- Con JavaScript haremos que se muestre un mensaje mas adelante-->
      </div> <!-- Con JavaScript haremos que se muestre un mensaje mas adelante-->

    </div> <!-- Cierre de datos_usuario, contenedor de registro -->

    <!-- Cierre de sección de registro de usuario -->

    <!-- Sección de paquetes -->

    <div id="paquetes "class="paquetes"> <!-- Apertura de paquetes -->
      <h3>Elige el número de boletos</h3>

      <ul class="lista-precios clearfix"> <!-- Apertura de lista-precios clearfix, utilizamos el clearfix ya que vamos a flotar el elemento a la izquierda   -->

        <li>
          <div class="tabla-precio"> <!-- Apertura de tabla-precio  -->
            <h3>Pase por día (Viernes)</h3>
            <p class="numero">$30</p>
            <ul>
              <li>Bocadillos Gratis</li>
              <li>Todas las conferencias</li>
              <li>Todos los talleres</li>
            </ul>
            <div class="orden"> <!-- Apertura de orden  -->
              <label for="pase_dia">Boletos deseados: </label>
              <input type="number" min="0" id="pase_dia" size="3"  name="boletos[un_dia][cantidad]" placeholder="0">
              <input type="hidden" value="30" name="boletos[un_dia][precio]">
            </div> <!-- Cierre de orden  -->
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
            <div class="orden"> <!-- Apertura de orden  -->
              <label for="pase_completo">Boletos deseados: </label>
              <input type="number" min="0" id="pase_completo" size="3" name="boletos[completo][cantidad]" placeholder="0">
              <input type="hidden" value="50" name="boletos[completo][precio]">
            </div> <!-- Cierre de orden  -->
          </div> <!-- Cierre de tabla-precio  -->
        </li>

        <li>
          <div class="tabla-precio"> <!-- Apertura de tabla-precio  -->
            <h3>Pase por 2 días (Viernes y Sábado)</h3>
            <p class="numero">$45</p>
            <ul>
              <li>Bocadillos Gratis</li>
              <li>Todas las conferencias</li>
              <li>Todos los talleres</li>
            </ul>
            <div class="orden"> <!-- Apertura de orden  -->
              <label for="pase_dosdias">Boletos deseados: </label>
              <input type="number" min="0" id="pase_dosdias" size="3" name="boletos[2dias][cantidad]" placeholder="0">
              <input type="hidden" value="45" name="boletos[2dias][precio]">
            </div> <!-- Cierre de orden  -->
          </div> <!-- Cierre de tabla-precio  -->
        </li>

      </ul> <!-- Cierre de lista-precios clearfix   -->
    </div> <!-- Cierre de paquetes -->

    <div id="eventos" class="eventos clearfix"> <!-- Apertura de eventos, nos ayudara con el JavaScript para poder ocultar y mostrar las secciones-->
      <h3>Elige tus talleres</h3>

      <div class="caja"> <!-- Apertura de caja, contenedor en donde estara todo el contenido -->
        <?php
        try {
          require_once('includes/funciones/bd_conexion.php');
          $sql = "SELECT eventos.*, categoria_evento.cat_evento, invitados.nombre_invitado, invitados.apellido_invitado ";
          $sql .= " FROM eventos ";
          $sql .= " JOIN categoria_evento ";
          $sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria ";
          $sql .= " JOIN invitados ";
          $sql .= " ON eventos.id_inv = invitados.invitado_id ";
          $sql .= " ORDER BY eventos.fecha_evento, eventos.id_cat_evento, eventos.hora_evento ";
          /*echo $sql;*/
          $resultado = $conn->query($sql);
        } catch (Exception $e) {
          echo $e->getMessage();
        }

        $eventos_dias = array();
        while($eventos = $resultado->fetch_assoc()) {
          $fecha = $eventos['fecha_evento'];
          setlocale(LC_ALL, 'es_ES');
          $dia_semana = strftime("%A", strtotime($fecha)); //Para devolver un día

          $categoria = $eventos['cat_evento'];
          $dia = array(
            'nombre_evento' => $eventos['nombre_evento'],
            'hora' => $eventos['hora_evento'],
            'id' => $eventos['evento_id'],
            'nombre_invitado' => $eventos['nombre_invitado'],
            'apellido_invitado' => $eventos['apellido_invitado']
          );
          $eventos_dias[$dia_semana]['eventos'][$categoria][] = $dia;
        }//Cierre while
         ?>

         <?php  foreach ($eventos_dias as $dia => $eventos) { ?>
           <div id="<?php echo str_replace('á', 'a', $dia); ?>" class="contenido-dia clearfix"> <!-- Apertura de contenedor de información del día Viernes -->
             <h4><?php echo $dia; ?></h4>

             <?php foreach ($eventos['eventos'] as $tipo => $evento_dia): ?>
             <div>
               <p><?php echo $tipo; ?>:</p>

               <?php foreach($evento_dia as $evento) {  ?>
               <label>
                 <input type="checkbox" name="registro[]" id="<?php echo $evento['id']; ?>" value="<?php echo $evento['id']; ?>">
                 <time><?php echo $evento['hora']; ?></time><?php echo $evento['nombre_evento']; ?>
                 <br>
                 <span class="autor"><?php echo "Tutor: " . $evento['nombre_invitado'] . " " . $evento['apellido_invitado']; ?></span>
               </label>
             <?php  } //foreach $evento_dia?>
             </div>
           <?php endforeach; // foreach $eventos ?>
           </div> <!-- Cierre de contenedor de información del día-->
         <?php  } ?> <!-- Cierre del foreach-->
       </div> <!-- Cierre de caja, contenedor en donde estara todo el contenido -->
     </div> <!-- Cierre de eventos -->

    <!-- Cierre sección de paquetes -->

    <!-- Sección de resumen -->

    <div id="resumen" class="resumen"> <!-- Apertura de resumen -->
      <h3>Pagos y Extras</h3>

      <div class="caja clearfix"> <!-- Apertura caja -->
        <div class="extras"> <!-- Apertura extras -->

          <div class="orden"> <!-- Apertura orden de camisa-->
            <label for="camisa_evento">Camisa del evento $10 <small>(Promoción 7% dto.)</small></label>
            <input type="number" min="0"="" id="camisa_evento" name="pedido_extra[camisas][cantidad]" size="3" placeholder="0">
            <input type="hidden" value="10" name="pedido_extra[camisas][precio]">
          </div>  <!-- Cierre orden de camisa -->

          <div class="orden"> <!-- Apertura orden de etiqueta -->
            <label for="etiquetas">Paquete de 10 etiquetas $2 <small>(HTML5, CSS3, JavaScript, Chrome)</small></label>
            <input type="number" min="0"="" id="etiquetas" name="pedido_extra[etiquetas][cantidad]" size="3" placeholder="0">
            <input type="hidden" value="2" name="pedido_extra[etiquetas][precio]">

          </div>  <!-- Cierre orden de etiqueta-->

          <div class="orden"> <!-- Apertura orden de regalo-->
            <label for="regalo">Seleccione un regalo</label> <br>
            <select id="regalo" name="regalo" required> <!-- Apertura de selectores de regalo-->
              <option value="">-Seleccione un regalo-</option>
              <option value="2">Etiquetas</option>
              <option value="1">Pulsera</option>
              <option value="3">Plumas</option>
            </select> <!-- Cierre de selectores de regalo-->
          </div> <!-- Cierre orden de regalo-->
          <input type="button" id="calcular" class="button" value="calcular">

        </div> <!-- Cierre extras -->

        <div class="total"> <!-- Apertura Total, contenedor-->
          <p>Resumen:</p>
          <div id="lista-productos"> <!-- Apertura lista-productos-->

          </div> <!-- Cierre lista-productos-->
          <p>Total:</p>
          <div id="suma-total"> <!-- Apertura suma-total-->

          </div> <!-- Cierre suma-total-->
          <input type="hidden" name="total_pedido" id="total_pedido">
          <input id="btnRegistro" type="submit" name="submit" class="button" value="Pagar">
        </div> <!-- Cierre Total, contenedor-->
      </div> <!-- Cierre caja -->
    </div> <!-- Cierre de resumen -->
  </form> <!-- Cierre de formulario -->
</section> <!-- Cierre seccion registro usuarios -->
<?php include_once 'includes/templates/footer.php'; ?>
