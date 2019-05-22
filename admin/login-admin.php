<?php
if(isset($_POST['login-admin'])) {
  $usuario = $_POST['usuario']; //Leemos las variables
  $password = $_POST['password'];

  try {
    include_once 'funciones/funciones.php';
    $stmt = $conn->prepare("SELECT * FROM admins WHERE usuario = ?;");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->bind_result($id_admin, $usuario_admin, $nombre_admin, $password_admin, $editado, $nivel); //Siempre que haces un select te retorna ciertos resultados la cual puedes asignar en el retorno
    session_start();
    $_SESSION['usuario'] = $usuario_admin;
    $_SESSION['nombre'] = $nombre_admin;
    if($stmt->affected_rows) {
      $existe = $stmt->fetch(); //Guardamos los resultados en variable
      if($existe) {
        if(password_verify($password, $password_admin)) { //Funcion que verifica password, toma el password que hemos escrito y luego compara con el de la base de datos.
          session_start();
          $_SESSION['usuario'] = $usuario_admin;
          $_SESSION['nombre'] = $nombre_admin;
          $_SESSION['nivel'] = $nivel;
          $_SESSION['id'] = $id_admin;
          $respuesta = array(
            'respuesta' => 'exitoso',
            'usuario' => $nombre_admin
          );
        } else {
          $respuesta = array(
            'respuesta' => 'error'
          );
        }
      } else {
        $respuesta = array(
          'respuesta' => 'error'
        );
      }
    }
    $stmt->close();
    $conn->close();
  } catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
  }
  die(json_encode($respuesta));
}
?>
