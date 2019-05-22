<?php
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
include_once 'templates/header.php';
include_once 'templates/barra.php';
include_once 'templates/navegacion.php';

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Crear Registro de Usuario Manual
      <small>Llena el formulario para crear un usuario registrado</small>
    </h1>
  </section>
  <div class="row">
    <div class="col-md-8">
      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Crear Usuario</h3>
          </div>
          <div class="box-body">
            <!-- form start -->
            <form role="form" name="guardar-registro" id="guardar-registro" method="post" action="modelo-registrado.php">
              <div class="box-body">
                <div class="form-group">
                  <label for="nombre_registrado">Nombre: </label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                </div>

                <div class="form-group">
                  <label for="apellido">Apellido: </label>
                  <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Nombre">
                </div>

                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>

                <div id="error"></div>

                <div class="form-group">
                  <div id="paquetes "class="paquetes"> <!-- Apertura de paquetes -->
                    <div class="box-header with-border">
                      <h3 class="box-title">Elige el número de boletos</h3>
                    </div> <!-- Cierre de box-header with-border -->

                    <ul class="lista-precios clearfix row"> <!-- Apertura de lista-precios clearfix, utilizamos el clearfix ya que vamos a flotar el elemento a la izquierda   -->

                      <li class="col-md-4">
                        <div class="tabla-precio text-center"> <!-- Apertura de tabla-precio  -->
                          <h3>Pase por día (Viernes)</h3>
                          <p class="numero">$30</p>
                          <ul>
                            <li>Bocadillos Gratis</li>
                            <li>Todas las conferencias</li>
                            <li>Todos los talleres</li>
                          </ul>
                          <div class="orden"> <!-- Apertura de orden  -->
                            <label for="pase_dia">Boletos deseados: </label>
                            <input type="number" class="form-control" min="0" id="pase_dia" size="3"  name="boletos[un_dia][cantidad]" placeholder="0">
                            <input type="hidden" value="30" name="boletos[un_dia][precio]">
                          </div> <!-- Cierre de orden  -->
                        </div> <!-- Cierre de tabla-precio  -->
                      </li>

                      <li class="col-md-4">
                        <div class="tabla-precio text-center"> <!-- Apertura de tabla-precio  -->
                          <h3>Todos los días</h3>
                          <p class="numero">$50</p>
                          <ul>
                            <li>Bocadillos Gratis</li>
                            <li>Todas las conferencias</li>
                            <li>Todos los talleres</li>
                          </ul>
                          <div class="orden"> <!-- Apertura de orden  -->
                            <label for="pase_completo">Boletos deseados: </label>
                            <input type="number" class="form-control" min="0" id="pase_completo" size="3" name="boletos[completo][cantidad]" placeholder="0">
                            <input type="hidden" value="50" name="boletos[completo][precio]">
                          </div> <!-- Cierre de orden  -->
                        </div> <!-- Cierre de tabla-precio  -->
                      </li>

                      <li class="col-md-4">
                        <div class="tabla-precio text-center"> <!-- Apertura de tabla-precio  -->
                          <h3>Pase por 2 días (Viernes y Sábado)</h3>
                          <p class="numero">$45</p>
                          <ul>
                            <li>Bocadillos Gratis</li>
                            <li>Todas las conferencias</li>
                            <li>Todos los talleres</li>
                          </ul>
                          <div class="orden"> <!-- Apertura de orden  -->
                            <label for="pase_dosdias">Boletos deseados: </label>
                            <input type="number" class="form-control" min="0" id="pase_dosdias" size="3" name="boletos[2dias][cantidad]" placeholder="0">
                            <input type="hidden" value="45" name="boletos[2dias][precio]">
                          </div> <!-- Cierre de orden  -->
                        </div> <!-- Cierre de tabla-precio  -->
                      </li>

                    </ul> <!-- Cierre de lista-precios clearfix   -->
                  </div> <!-- Cierre de paquetes -->
                </div> <!-- Cierre de formgroup -->

                <div class="form-group">
                  <div class="box-header with-border">
                    <h3 class="box-title">Elige los talleres</h3>
                  </div> <!-- Cierre de box-header with-border -->
                  <div id="eventos" class="eventos clearfix"> <!-- Apertura de eventos, nos ayudara con el JavaScript para poder ocultar y mostrar las secciones-->
                    <div class="caja"> <!-- Apertura de caja, contenedor en donde estara todo el contenido -->
                      <?php
                      try {
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
                         <div id="<?php echo str_replace('á', 'a', $dia); ?>" class="contenido-dia clearfix row"> <!-- Apertura de contenedor de información del día Viernes -->
                           <h4 class="text-center nombre_dia"><?php echo $dia; ?></h4>

                           <?php foreach ($eventos['eventos'] as $tipo => $evento_dia): ?>
                           <div class="col-md-4">
                             <p><?php echo $tipo; ?>:</p>

                             <?php foreach($evento_dia as $evento) {  ?>
                             <label>
                               <input type="checkbox" class="minimal" name="registro_evento[]" id="<?php echo $evento['id']; ?>" value="<?php echo $evento['id']; ?>">
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
                    <div class="box-header with-border">
                      <h3 class="box-title">Pagos y Extras</h3>
                    </div> <!-- Cierre de box-header with-border -->
                    <br>
                    <div class="caja clearfix row"> <!-- Apertura caja -->
                      <div class="extras col-md-6"> <!-- Apertura extras -->

                        <div class="orden"> <!-- Apertura orden de camisa-->
                          <label for="camisa_evento">Camisa del evento $10 <small>(Promoción 7% dto.)</small></label>
                          <input type="number" class="form-control" min="0"="" id="camisa_evento" name="pedido_extra[camisas][cantidad]" size="3" placeholder="0">
                          <input type="hidden" value="10" name="pedido_extra[camisas][precio]">
                        </div>  <!-- Cierre orden de camisa -->

                        <div class="orden"> <!-- Apertura orden de etiqueta -->
                          <label for="etiquetas">Paquete de 10 etiquetas $2 <small>(HTML5, CSS3, JavaScript, Chrome)</small></label>
                          <input type="number" class="form-control" min="0"="" id="etiquetas" name="pedido_extra[etiquetas][cantidad]" size="3" placeholder="0">
                          <input type="hidden" value="2" name="pedido_extra[etiquetas][precio]">

                        </div>  <!-- Cierre orden de etiqueta-->

                        <div class="orden"> <!-- Apertura orden de regalo-->
                          <label for="regalo">Seleccione un regalo</label> <br>
                          <select id="regalo" name="regalo" required class="form-control seleccionar"> <!-- Apertura de selectores de regalo-->
                            <option value="">-Seleccione un regalo-</option>
                            <option value="2">Etiquetas</option>
                            <option value="1">Pulsera</option>
                            <option value="3">Plumas</option>
                          </select> <!-- Cierre de selectores de regalo-->
                        </div> <!-- Cierre orden de regalo-->
                        <br>
                        <input type="button" id="calcular" class="btn btn-success" value="calcular">

                      </div> <!-- Cierre extras -->

                      <div class="total col-md-6"> <!-- Apertura Total, contenedor-->
                        <p>Resumen:</p>
                        <div id="lista-productos"> <!-- Apertura lista-productos-->

                        </div> <!-- Cierre lista-productos-->
                        <p>Total:</p>
                        <div id="suma-total"> <!-- Apertura suma-total-->

                        </div> <!-- Cierre suma-total-->
                        <input type="hidden" name="total_pedido" id="total_pedido">
                        <input type="hidden" name="total_descuento" id="total_descuento" value="total_descuento"><!--  //Codigo necesario para paypal-->
                      </div> <!-- Cierre Total, contenedor-->
                    </div> <!-- Cierre caja -->
                  </div> <!-- Cierre de resumen -->
                </div> <!-- Cierre de formgroup -->

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input type="hidden" name="registro" value="nuevo">
                <button type="submit" class="btn btn-primary" id="btnRegistro">Añadir</button>
              </div>
            </form>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </section>
      <!-- /.content -->
    </div>
  </div>
</div>
<!-- /.content-wrapper -->

<?php include_once 'templates/footer.php';  ?>
