<?php if(isset($_POST['submit'])):  //Función isset va a revisar que la variable exista. nombre submit en el btnRegistro
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $email = $_POST['email'];
  $regalo = $_POST['regalo'];
  $total = $_POST['total_pedido'];
  $fecha = date('Y-m-d H:i:s');
  //Pedidos
  $boletos = $_POST['boletos'];
  $camisas = $_POST['pedido_camisas'];
  $etiquetas = $_POST['pedido_etiquetas'];
  include_once 'includes/funciones/funciones.php'; //Para llamar a la funcion en donde tenemos los archivos
  $pedido = productos_json($boletos, $camisas, $etiquetas); //Pasar los parametros en el mismo orden. Siempre que utilices una funcion que retorne un valor debes asignarle una variable
  //Eventos
  $eventos = $_POST['registro'];
  $registro = eventos_json($eventos);
  //Manejo de registros e insersiones
  try {
    require_once('includes/funciones/bd_conexion.php');
    $stmt = $conn->prepare("INSERT INTO registrados (nombre_registrado, apellido_registrado, email_registrado,  fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado) VALUES (?,?,?,?,?,?,?,?)"); //Se vaya preparando por que va a ver una inserción en la base de datos y prevenimos ataques de inyección SQL
    $stmt->bind_param("ssssssis", $nombre, $apellido, $email, $fecha, $pedido, $registro, $regalo, $total); //Las cadenas de texto con un stmt deben ir con una s y los enteros i. debemos pasar nuestras variables en el mismo orden
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header('Location: validar_registro.php?exitoso=1'); //Nos aseguramos que no sea reingresado el usuario si volvemos a recargar la pagina, cargamos toda la logica antese de header
  } catch (\Exception $e) {
    echo $e->getMessage(); //Para atrapar el mensaje de error
  }
?>
<?php endif; ?>
<?php include_once 'includes/templates/header.php'; ?>
<section class="seccion contenedor"> <!-- Apertura seccion registro usuarios -->
  <h2>Resumen de registro</h2>

  <?php if(isset($_GET['exitoso'])):
    if($_GET['exitoso'] =="1"):
      echo "Registro exitoso";
    endif;
  endif; ?>
  
</section> <!-- Cierre seccion registro usuarios -->
<?php include_once 'includes/templates/footer.php'; ?>
