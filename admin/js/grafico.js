$(document).ready(function () {
  // LINE CHART
  $.getJSON('servicio-registrados.php', function(data) { //Funcion para pasar url y pasamos los datos en json
  var line = new Morris.Line({
    element: 'grafica-registros',
    resize: true,
    data: data, //Pasamos los datos
    xkey: 'fecha',
    ykeys: ['cantidad'],
    labels: ['Item 1'],
    lineColors: ['#3c8dbc'],
    hideHover: 'auto'
  });
  });//Cierre función
}) //Cierre Document Ready
