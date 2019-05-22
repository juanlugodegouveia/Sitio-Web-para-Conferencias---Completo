$(document).ready(function() {
  $('#guardar-registro').on('submit', function(e) {
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
        if(resultado.respuesta == 'exito') {
          swal(
            'Correcto',
            'Se guardó correctamente',
            'success'
          )
        } else {
          swal(
            'Error',
            'Hubo un error',
            'error'
          )
        }
      }
    })
  }); //Cierre Guardar registro

  //Se ejecuta cuando hay un archivo

  $('#guardar-registro-archivo').on('submit', function(e) {
    e.preventDefault();

    var datos = new FormData(this);

    $.ajax({
      type: $(this).attr('method'),
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      contentType: false,
      processData : false,
      async: true,
      cache: false,
      success: function(data) {
        console.log(data);
        var resultado = data;
        if(resultado.respuesta == 'exito') {
          swal(
            'Correcto',
            'Se guardó correctamente',
            'success'
          )
        } else {
          swal(
            'Error!',
            'Hubo un error',
            'error'
          )
        }
      }
    })
  }); //Cierre


  //Eliminar un registro

  $('.borrar_registro').on('click', function(e) {
    e.preventDefault(); //Para cancelar el comportamiento por default que tenga el navegador sobre el boton

    var id = $(this).attr('data-id');
    var tipo = $(this).attr('data-tipo');
    swal({
  title: '¿Estás seguro?',
  text: "Un registro eliminado no se puede recuperar",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Eliminar!',
  cancelButtonText: 'Cancelar'
}).then(function () {
    $.ajax({
      type:'post',
      data: {
        'id' : id,
        'registro' : 'eliminar'
      },
      url: 'modelo-'+tipo+'.php',
      success:function(data) {
        console.log(data); //seccion 57, clase 498 min 1:30
        var resultado = JSON.parse(data);
        if (resultado.respuesta == 'exito') {
          swal(
            'Eliminado',
            'Registro Eliminado Exitosamente',
            'success'
          )
       jQuery('[data-id="'+resultado.id_eliminado+'"]').parents('tr').remove(); //Para acceder al objeto
        } else {
          swal(
            'Error',
            'No se pudo eliminar registro',
            'error'
          )
        }
      }
    })
  })//Cierre alarma
  }); //Cierre borrar_registro


}); //Cierre document ready
