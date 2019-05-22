(function () { // Para que se ejecute solo una vez
    "use strict";

    document.addEventListener('DOMContentLoaded', function () {

        console.log("DOM fully loaded and parsed");

        //Creamos nuestras variables, seleccionando nuestros elemento anteriormente declarados en el registro.html para tener acceso a ellos.

        //Campos Datos, para los datos de registro.

        var nombre = document.getElementById('nombre');
        var apellido = document.getElementById('apellido');
        var email = document.getElementById('email');

        //Campos Pases

        var pase_dia = document.getElementById('pase_dia');
        var pase_dosdias = document.getElementById('pase_dosdias');
        var pase_completo = document.getElementById('pase_completo');

        //Botones y Divs

        var calcular = document.getElementById('calcular');
        var errorDiv = document.getElementById('error');
        var botonRegistro = document.getElementById('btnRegistro');
        var lista_productos = document.getElementById('lista-productos');
        var regalo = document.getElementById('regalo'); // Seccion 32, clase 247, en el video lo coloca fuera del 'DOMContentLoaded', revisando las preguntas dice que era por problema de cache, que si se puede colocar adentro, en caso de que de error colocarlo afuera del 'DOMContentLoaded' y averiguar por que no funcionaría correctamente si esta adentro de DOM.
        var suma = document.getElementById('suma-total');

        //Camisas y etiquetas

        var camisas = document.getElementById('camisa_evento');
        var etiquetas = document.getElementById('etiquetas');

        var botonRegistro = document.querySelector('#btnRegistro'); //Codigo sacado por mi tomado de otros ejemplos, me daba error de valor no valido o no definido. El codigo origanl es botonRegistro.disabled=true;
        if(botonRegistro) {
          botonRegistro.disabled=true; //Deshabilitamos botón de pagar
        }

        //Eventos

        //Codigo para corregir error en consola de addEventListener, seccion 38, clase 294. Al trabajar con un selector que no existe, marcara un error, por lo que hay que coloar el codigo dentro de un   if(document.getElementById('calcular')){}. Seleccionamos el calcular pero podemos seleccionar cualquiera de los de arriba

        if(document.getElementById('calcular')){ //Hace referencia a la explicacion de arriba. https://cybmeta.com/como-comprobar-si-un-elemento-existe-con-jquery-

        calcular.addEventListener('click', calcularMontos); //Creamos el evento 'click' para el boton de calcular y luego creamos la funcion "calcularMontos".

        pase_dia.addEventListener('blur', mostrarDias); //Creamos el evento 'blur' que nos permite tomar el valor ingresado una vez que nos salgamos la selección de pases.
        pase_dosdias.addEventListener('blur', mostrarDias);
        pase_completo.addEventListener('blur', mostrarDias);

        nombre.addEventListener('blur', validarCampos); //Creamos el evento en nombre para validar campo de nombre
        apellido.addEventListener('blur', validarCampos); //Creamos el evento en appellido para validar campo de appellido
        email.addEventListener('blur', validarCampos); //Creamos el evento en email para validar campo de email
        email.addEventListener('blur', validarMail); //Creamos el evento en email para validar campo de email

        //Mostrar en editar
        var formulario_editar = document.getElementsByClassName('editar-registrado');
        if(formulario_editar.length > 0) {
            if(pase_dia.value || pase_dosdias.value || pase_completo.value) {
              mostrarDias();
            }
        }

        function validarCampos() { //Función para validar campos

          if (this.value == '') { //Si el valor del formulario esta vació situandose en el evento de nombre, en este caso en  formulario para a mandar una alerta.
            errorDiv.style.display = 'block';
            errorDiv.innerHTML = "Este campo es obligatorio";
            this.style.border = '1px solid red';
            errorDiv.style.border = '1px solid red';
          } else {
            errorDiv.style.display = 'none';
            this.style.border = '1px solid #cccccc';
          }
        }

        function validarMail() {
          if(this.value.indexOf("@") > -1) {
            errorDiv.style.display = 'none';
            this.style.border = '1px solid #cccccc';
          } else {
            errorDiv.style.display= 'block';
            errorDiv.innerHTML ="debe tener al menos una @";
            this.style.border = '1px solid red';
            errorDiv.style.border = '1px solid red';
          }
        }

        function calcularMontos(event) { //Creamos la funcion para calcularMontos
            event.preventDefault();
            if (regalo.value === '') { //Validamos la seleccion del regalo, sino toma nada aparece una alerta.
                alert("Debes elegir un regalo");
                regalo.focus(); //Hacemos focus en la selección de regalo.
            } else {
                var boletosDia = parseInt(pase_dia.value, 10) || 0; //la función parseInt(,10)||0   /  Lo utilizamos para asegurarnos de que la función se cumpla correctamente al dar el "totalPagar".
                //console.log("Cantidad de boletos por día: " +boletosDia);
                var boletosDosDias = parseInt(pase_dosdias.value, 10) || 0;
                //console.log("Cantidad de boletos por dos días: " + boletosDosDias);
                var boletoCompleto = parseInt(pase_completo.value, 10) || 0;
                //console.log("Cantidad de boletos para todos días: " + boletoCompleto);

                var cantCamisas = parseInt(camisas.value, 10) || 0;
                //console.log("Cantidad de camisas: " + cantCamisas);

                var cantEtiquetas = parseInt(etiquetas.value, 10) || 0;
                //console.log("Cantidad de etiquetas: " + cantEtiquetas);

                var totalPagar = (boletosDia * 30) + (boletosDosDias * 45) + (boletoCompleto * 50) + ((cantCamisas * 10) * .93) + (cantEtiquetas * 2);
                //console.log(totalPagar);

                var listadoProductos = []; //Creamos un arreglo, luego utilizamos el metodo .push para irlos anexando al arreglo

                if (boletosDia >= 1) { //Validamos para que solo se muestren los seleccionados
                    listadoProductos.push(boletosDia + ' Pases por día');
                }
                if (boletosDosDias >= 1) {
                    listadoProductos.push(boletosDosDias + ' Pases por dos días');
                }
                if (boletoCompleto >= 1) {
                    listadoProductos.push(boletoCompleto + ' Pases completos');
                }
                if (cantCamisas >= 1) {
                    listadoProductos.push(cantCamisas + ' Camisas');
                }
                if (cantEtiquetas >= 1) {
                    listadoProductos.push(cantEtiquetas + ' Etiquetas');
                }

                lista_productos.style.display = "block"; //Este codigo nos permite hacer visible el recuadro gris de la lista de productos al darle click, anteriormente oculto en el css.
                lista_productos.innerHTML = ''; //Imprimios en el HTML, lo declaramos vacio antes del for para que no se vuelva a imprimir todo
                for (var i = 0; i < listadoProductos.length; i++) { //Para nuestro arreglo en la posición "i" aunmentara hasta ser igual mostrando en pantalla.
                    lista_productos.innerHTML += listadoProductos[i] + '<br/>'; //Concatenamos nuestro arreglo
                }

                suma.innerHTML = "$ " + totalPagar.toFixed(2); //El toFixed es para que solo nos regrese dos decimales

                botonRegistro.disabled = false; //Habilitar boton de pagar al momento de darle click a calcultar
                document.getElementById('total_pedido').value = totalPagar; //Para obtener el monto del pedido a pagar al momento de darle click al boton pagar.
            }
        }

        function mostrarDias() {

            var boletosDia = parseInt(pase_dia.value, 10) || 0; //la función parseInt(,10)||0   /  Lo     utilizamos para asegurarnos de que la función se cumpla correctamente al dar el "totalPagar".
            //console.log("Cantidad de boletos por día: " +boletosDia);
            var boletosDosDias = parseInt(pase_dosdias.value, 10) || 0;
            //console.log("Cantidad de boletos por dos días: " + boletosDosDias);
            var boletoCompleto = parseInt(pase_completo.value, 10) || 0;
            //console.log("Cantidad de boletos para todos días: " + boletoCompleto);

            var diasElegidos = []; //Declaramos un arreglo.

            if (boletosDia > 0) { //Los días son tomados desde el ID de Registro.html
                diasElegidos.push('viernes'); //Si selecionamos pases para un dia mandara el pulso solo del menu del viernes, anexandolo al arreglo.
            }
            if (boletosDosDias > 0) {
                diasElegidos.push('viernes', 'sabado'); //Si selecionamos pases para dos dias mandara el pulso solo el menu del viernes y sabado, anexandolo al arreglo.
            }
            if (boletoCompleto > 0) {
              diasElegidos.push('viernes', 'sabado', 'domingo'); //Si selecionamos pases para todos los dias mandara pulso para todos los menues, anexandolo al arreglo
            }

            //Muestra los seleccionados
            for (var i = 0; i < diasElegidos.length; i++) {
              document.getElementById(diasElegidos[i]).style.display = 'block'; //Recorrera el arreglo y tomando los pulso, pasara el elemento de display:none del CSS a block, mostrandose los menues.
            }

            // los oculta si vuelven a 0
            if(diasElegidos.length == 0 ) {
              var todosDias = document.getElementsByClassName('contenido-dia');
              for(var i = 0; i < todosDias.length; i++) {
                todosDias[i].style.display = 'none';
              }
            }

            //Sección 32, clase 252, el profesor pone el codigo en una de las preguntas para ocultar cuando se devuelva a 0 pero no funciona correctamente.
            /*if (diasElegidos.length == 0) {
            var todosDias = document.getElementsByClassName('contenido-dia');
            for (var i = 0; i < todosDias.length; i++) {
            todosDias[i].style.display = 'none';
             }
            }*/
        }
      } //Cierre del if para corrgir error de addEventListener
    }); //DOM CONTENT LOADED
})();
