<?php
require_once "GUIPreceptor.class.php";
if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {
?>
<!-- Footer -->
  
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <strong>Sistema de Gestión</strong>  
    </div>
    <strong>INSTITUTO</strong>  Nuestra Señora
  </footer>

   

  

<!-- Script -->
<script src="../recursos/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../recursos/bootstrap/js/bootstrap.min.js"></script>
<script src="../recursos/plugins/fastclick/fastclick.js"></script>
<script src="../recursos/dist/js/app.min.js"></script>
<script src="../recursos/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="../recursos/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../recursos/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="../recursos/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../recursos/plugins/chartjs/Chart.min.js"></script>


</body>
</html>

<?php
} 
else {
  header('location: ../presentacion/login.php');
}