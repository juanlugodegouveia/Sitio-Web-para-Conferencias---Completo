<?php include_once 'includes/templates/header.php'; ?>

<section class="seccion contenedor">
  <h2>Calendario de Eventos</h2>
  <?php
  try {
    require_once('includes/funciones/bd_conexion.php');
    $sql = " SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado ";
    $sql .= " FROM eventos";
    $sql .= " INNER JOIN categoria_evento ";
    $sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria ";
    $sql .= " INNER JOIN invitados ";
    $sql .= " ON eventos.id_inv = invitados.invitado_id ";
    $sql .= " ORDER BY evento_id";
    $resultado = $conn->query($sql); //Funcion de PHP para hacer consultas
  } catch (\Exception $e) {
    echo $e->getMessage(); //Para atrapar el mensaje de error
  }
  ?>

  <div class="calendario">
  <?php //Seccion 44, Clase 366, 367, 368.
  $calendario = array(); //Creamos arreglo vacio afuera del while para despues ingresar informacion con un array asociativo.
  while($eventos = $resultado->fetch_assoc() ) { //fetch_assoc es una funcion para imprimir resultados, siempre que se trabaje con ella hay que ponerla dentro de un while para imprimir varios elementos, va a rrecorer el arreglo.

    $fecha = $eventos['fecha_evento']; //Creamos la variable $fecha para guardar los valores. Obtenemos la fecha del eventos para poder organizar por fecha, podemos hacerlo con cualquier elemetno.

    $evento = array ( //Creamos array asociativo para ingresar la informacion del evento, dandanos nuestro propio formato. Aqui estamos guardando todos las datos del arreglo.
      'titulo' => $eventos['nombre_evento'],
      'fecha' => $eventos['fecha_evento'],
      'hora' => $eventos['hora_evento'],
      'categoria' => $eventos['cat_evento'],
      'icono' => 'fas' . " " . $eventos['icono'],
      'invitado' => $eventos['nombre_invitado'] . " " . $eventos['apellido_invitado']
    );

    $calendario[$fecha][] = $evento; //Agrupamos todos los elemento en el arreglo de calendario y seleccionamos el elemento fecha para mostrarlos organizados en un solo arreglo, los corchetes al final en php agregan un elemento al final, creando un arreglo grupal para cada fecha.
  ?>
    <?php } //Cierre del while ?>

    <?php //Imprime todos los eventos con la funcion foreach
    foreach ($calendario as $dia => $lista_eventos) { //Seccion 40, clase 320, para solo accder a la fecha es necesaria esta sintaxis, recordar que la variable $calendario tenemos un arreglo que agrupa las fechas, le asignamos la llave de variable $dia, el cual $dia tendria el valor de las fechas al recorrer el arreglo y asignarlo a la $lista_eventos>
    ?>
      <h3>
        <i class="far fa-calendar-alt"></i>
        <?php
        // windows
        setlocale(LC_TIME, 'spanish');
        echo utf8_encode(strftime("%A, %d de %B del %Y", strtotime($dia))); //Funcion para colocar la hora en español, tambien se puede con echo strftime ("%A, %d de %B del %Y", strtotime($dia)); pero me traia problemas. Seccion 44, clase
        ?>
      </h3>
      <?php foreach($lista_eventos as $evento) { //Recorremos el arreglo por la fecha de la lista de eventos, agrupamos los eventos por dia?>
        <div class="dia"> <!--Apertura dia-->
          <p class="titulo"> <?php echo $evento['titulo']; ?> </p>
          <p class="hora"><i class="far fa-clock" aria-hidden="true"></i>
            <?php echo $evento['fecha'] . " " . $evento['hora']; ?>
          </p>
          <p>
            <i class="<?php echo $evento['icono']; ?>" aria-hidden="true"></i>
            <?php echo $evento['categoria']; ?>
         </p>
          <p>
            <i class="fas fa-user" aria-hidden="true"></i>
            <?php echo $evento['invitado']; ?>
          </p>
        </div> <!--Cierre dia-->
      <?php } //Fin foreach eventos ?>
    <?php } //Fin foreach de dias ?>
  </div>  <!--Cierre calendario-->

  <?php
  $conn->close();
   ?>
</section>
<?php include_once 'includes/templates/footer.php'; ?>
