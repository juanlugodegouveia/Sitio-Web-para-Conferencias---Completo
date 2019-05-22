<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 2.4.0
  </div>
  <strong>Copyright &copy; 2018-2019 Juan Carlos Lugo De Gouveia</a>.</strong> All rights
  reserved.
</footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="js/bootstrap.min.js"></script>

<script src="js/jquery.dataTables.min.js"></script>

<script src="js/dataTables.bootstrap.min.js"></script>

<!-- SlimScroll -->
<script src="js/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>

<script src="js/sweetalert2.min.js"></script>

<script src="js/admin-ajax.js"></script>

<script src="js/bootstrap-datepicker.min.js"></script>

<script src="js/select2.full.min.js"></script>

<script src="js/bootstrap-timepicker.min.js"></script>

<script src="js/fontawesome-iconpicker.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
<script src="js/login-ajax.js"></script>
<script src="js/icheck.min.js"></script>
<script src="../js/cotizador.js"></script>
<script src="js/app.js"></script>

<?php
$archivo = basename($_SERVER['PHP_SELF']);  //Nos regresa el nombre del archivo actual
$pagina = str_replace(".php", "", $archivo); //Toma tres parametros, primo lo que quieres buscar, segundo por que lo vas a reemplazar y tercero la fuente de los datos
if($pagina == 'dashboard') {
  echo '<script src="js/raphael.min.js"></script>';
  echo '<script src="js/morris.min.js"></script>';
  echo '<script src="js/grafico.js"></script>';
}
?>
</body>
</html>
