<!DOCTYPE html>

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once 'Recursos/BD.php';
require_once 'Recursos/temppanel_negros.php';
session_start();

if(!isset($_SESSION['logeado'])) {
  echo "<script>location.href='login.php';</script>";
  die();
}
if( $_SESSION['lvRANGO'] < 11){
  echo "<script>location.href='index.php';</script>";
  die();
}

?>



<?php


if($_SERVER["REQUEST_METHOD"] == "POST"){
  
  
  $usuariob = trim($_POST["Usuario"]);
  
  
  
  //seguridad 
  $usuariob = htmlspecialchars($usuariob); 


        $adm = $_SESSION["Nombre"];
      $sesion = new Sesion($usuariob, $adm);
         
  
  
  
  $resultados = seleccionar_BD("SELECT * FROM panel_users WHERE LOWER( USUARIO ) LIKE '%".$usuariob."%'");
  $resultados2 = seleccionar_BD("SELECT * FROM panel_users WHERE servicio = '0' ");
  
}else{
    $adm = $_SESSION["Nombre"];
      $sesion = new Sesion('VictorMinemu', $adm);
  $resultados = seleccionar_BD("SELECT * FROM panel_users WHERE servicio = '1' ");
  $resultados2 = seleccionar_BD("SELECT * FROM panel_users WHERE servicio = '0' ");

}


?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Calle13 Panel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition sidebar-mini skin-purple">
<div class="wrapper">

<?php include_once "header.php" ?>
<?php include_once "menu.php" ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
  
  <section class="content">
  
  <div class="row">
        <!-- left column -->
        <div class="col-md-12">
    
     <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Buscar Usuario Panel</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form"  action="./buscarnegros.php" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="Usuario">Usuario</label>
                  <input type="text" class="form-control" name="Usuario" id="Usuario" placeholder="Usuario">
                </div>
                
               
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">BUSCAR</button>
              </div>
            </form>
          </div>
      <!-- /.row -->
      <!-- Main row -->
            </div>
        <!--/.col (right) -->
      </div>
  
  
  
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Users en servicio</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Usuario</th>
                  <th>Rango</th>
                  <th>LV Rango</th>
                  <th>Tiempo (H)</th>
                  <th>Esta En Servicio</th>
                  <th>Activo</th>
                </tr>
                </thead>
        <tbody>
        <?php 
        if(!$resultados == false){
          foreach($resultados  as $Usuario ){
            
          echo "<tr >";
          echo  "<td> <a href=./negro.php?u=".$Usuario['USUARIO'].">".$Usuario['USUARIO']."</td>";
          echo  "<td>".$Usuario['RANGO']."</td>";
          echo  "<td>".$Usuario['lvRANGO']."</td>";
          echo  "<td>".round(($Usuario['tiempo']/3600), 2)."</td>";
          echo  "<td>".$Usuario['servicio']."</td>";
          echo  "<td>".$Usuario['ACTIVO']."</td>";
          echo "</tr>";
        
        }
        
        }
        
        
        
        
        
        
        
        ?>
        
        </tbody>
        
        <tfoot>
                <tr>
                 <th>Usuario</th>
                  <th>Rango</th>
                  <th>LV Rango</th>
                  <th>Tiempo (H)</th>
                  <th>Esta En Servicio</th>
                  <th>Activo</th>
                </tr>
                </tfoot>
                      </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        
        
        
        
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->


        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Todos los Users</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Usuario</th>
                  <th>Rango</th>
                  <th>LV Rango</th>
                  <th>Tiempo (H)</th>
                  <th>Esta En Servicio</th>
                  <th>Activo</th>
                </tr>
                </thead>
        <tbody>
        <?php 
        if(!$resultados2 == false){
          foreach($resultados2  as $Usuario ){
            
          echo "<tr >";
          echo  "<td> <a href=./negro.php?u=".$Usuario['USUARIO'].">".$Usuario['USUARIO']."</td>";
          echo  "<td>".$Usuario['RANGO']."</td>";
          echo  "<td>".$Usuario['lvRANGO']."</td>";
          echo  "<td>".round(($Usuario['tiempo']/3600), 2)."</td>";
          echo  "<td>".$Usuario['servicio']."</td>";
          echo  "<td>".$Usuario['ACTIVO']."</td>";
          echo "</tr>";
        
        }
        
        }
        
        
        
        
        
        
        
        ?>
        
        </tbody>
        
        <tfoot>
                <tr>
                 <th>Usuario</th>
                  <th>Rango</th>
                  <th>LV Rango</th>
                  <th>Tiempo (H)</th>
                  <th>Esta En Servicio</th>
                  <th>Activo</th>
                </tr>
                </tfoot>
                      </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        
        
        
        
          </div>
          <!-- /.box -->
        </div>



        <div class="row">
       <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h2 class="box-title">Ultimas Entradas</h2>
            </br>
              <h3 class="box-title">Ultima Actividad Time</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table id="UltimaA" class="table table-hover">
                <thead>
        
                <tr>
                  <th>Admin</th>
                  <th>Fecha inicio</th>
                  <th>Fecha Final</th>
                  <th>Horas</th>
                  
                </tr>
        
                </thead>
                <tbody>
        <?php 
        if($_SESSION['lvRANGO'] >= 2){
                $historiales = $sesion->getHistorialTotal();

                foreach ($historiales as $historial) {
                  # code...
                  
              echo '
                <tr>
                <td><a href=./negro.php?u='.$historial["admin"].'>'.$historial['admin'].'</td>
                <td>'.date('d-m-Y H:i:s', $historial['inicio']).'</td>
                <td>'.date('d-m-Y H:i:s', $historial['final']).'</td>
                <td>'.(round($historial['tiempo']/3600, 2)).'</td>
                </tr>
              ';
           }
         


        }
         ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Admin</th>
                 <th>Fecha</th>
                 <th>Fecha Final</th>
                  <th>Horas</th>
                 
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      
              </div>
        <!-- /.col -->
    
    </div> <!--row-->
        <!-- /.col -->

      </div>
      <!-- /.row -->
    </section>

  
  
  
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.5.6
    </div>
    <strong>Copyright VictorMinemu ("Victor Ruiz") 2018 - Licencia de uso para Calle13RP;  <a href="https://minemu.es">Minemu Network</a>.</strong> Todos los Derechos Reservados.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
