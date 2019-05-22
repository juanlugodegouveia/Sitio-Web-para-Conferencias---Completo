$(document).ready(function() {
$('#login-admin').on('submit', function(e) {
  e.preventDefault();

  var datos = $(this).serializeArray(); //serializeArray nos sirve para iterar y nos lo crear como objetos.

  $.ajax({
    type: $(this).attr('method'),
    data: datos,
    url: $(this).attr('action'),
    dataType: 'json',
    success: function(data) {
      console.log(data);
      var resultado = data;
      if(resultado.respuesta == 'exitoso') {
        swal(
          'Login Correcto',
          'Bienvenid@ '+resultado.usuario+'',
          'success'
        )
        setTimeout(function () {
          window.location.href = 'dashboard.php';
        }, 2000);
      } else {
        swal(
          'Error',
          'Usuario o Password incorrectos',
          'error'
        )
      }


    }
  })
}); //Cierre login
}); //Cierre Document ready
