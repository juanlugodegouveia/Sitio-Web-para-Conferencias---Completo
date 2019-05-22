<?php
try {
  require_once('includes/funciones/bd_conexion.php');
  $sql = " SELECT * FROM invitados ";
  $resultado = $conn->query($sql); //Funcion de PHP para hacer consultas
} catch (\Exception $e) {
  echo $e->getMessage(); //Para atrapar el mensaje de error
}
?>

<section class="invitados contenedor seccion"> <!-- Apertura de invitados -->
  <h2>Nuestros Invitados</h2>
  <ul Class="lista-invitados clearfix"> <!-- Apertura de lista-invitados -->
    <?php   while($invitados = $resultado->fetch_assoc() ) { //fetch_assoc es una funcion para imprimir resultados, siempre que se trabaje con ella hay que ponerla dentro de un while para imprimir varios elementos, va a rrecorer el arreglo.?>

      <li>
        <div class="invitado">
          <a class="invitado-info" href="#invitado<?php echo $invitados['invitado_id']; ?>">
            <img src="img/invitados/<?php echo $invitados['url_imagen']; ?>" alt="imagen invitado">
            <p><?php echo $invitados['nombre_invitado'] . " " . $invitados['apellido_invitado']; ?></p>
          </a>
        </div>
      </li>

      <div style="display:none;"> <!-- Apertura de style, esta en display:none para no afectar las posiciones con el plugin -->
        <div class="invitado-info" id="invitado<?php echo $invitados['invitado_id'];?>"> <!-- Apertura de invitado-info, recorriendo el arreglo con el fetch_assoc del while e imprimiendo los id., creamos en contenedor para el plugin -->
          <h2> <?php echo $invitados['nombre_invitado'] . " " . $invitados['apellido_invitado']; //Imprimimos nombre de usuario en plugin?></h2>
          <img src="img/invitados/<?php echo $invitados['url_imagen']; //Imprimimos la imagen del invitado en plugin?>" alt="imagen invitado">
          <p><?php echo $invitados['descripcion'] //Imprimimos descripcion en plugin ?></p>
        </div> <!-- Cierre de invitado-info -->
      </div> <!-- Cierre de style -->

    <?php } //Cierre while?>
  </ul> <!-- Cierre de lista-invitados, fuera del while para que al recorrer sea un solo ul-->
</section> <!-- Cierre de invitados, fuera del while para no alterar a distintas secciones -->
<?php
$conn->close();
?>
