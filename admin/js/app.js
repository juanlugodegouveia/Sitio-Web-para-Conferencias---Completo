$(document).ready(function () {
  $('.sidebar-menu').tree() //Copiado para la lista-admin

      $('#registros').DataTable({
        'paging'      : true,
        'pageLength'  : 10,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'language'    : {
          paginate: {
            next: 'Siguiente',
            previous: 'Anterior',
            last: 'Último',
            first: 'Primero'
          },
          info: 'Mostrando_START_ a _END_ de _TOTAL_ resultados',
          emptyTable: 'No hay registros',
          infoEmpty: '0 Registros',
          search: 'Buscar:'
        }
      });

      $('#crear_registro_admin').attr('disabled', true);

      $('#repetir_password').on('input', function () {
        var password_nuevo = $('#password').val();

        if($(this).val() == password_nuevo ) {
          $('#resultado_password').text('Correcto');
          $('#resultado_password').parents('.form-group').addClass('has-success').removeClass('has-error'); //Agregar y quitar clase de boostrap clase a repetir_password
          $('input#password').parents('.form-group').addClass('has-success').removeClass('has-error'); //Agregar clase a password
          $('#crear_registro_admin').attr('disabled', false);
        } else {
          $('#resultado_password').text('El password no coincide');
          $('#resultado_password').parents('.form-group').addClass('has-error').removeClass('has-success'); //Quitar clase a repetir_password
          $('input#password').parents('.form-group').addClass('has-error').removeClass('has-success'); //Quitar clase a password
        }
      });//Cierre repetir_password


      //Date picker
      $('#fecha').datepicker({
        autoclose: true
      });

      //Select2
      $('.seleccionar').select2();

      //Timepicker
      $('.timepicker').timepicker({
        showInputs: false
      });

      //Iconpicker
      $('#icono').iconpicker();

      //iCheck for checkbox and radio inputs
      $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass   : 'iradio_flat-blue'
      });

}) //Cierre Document Ready
