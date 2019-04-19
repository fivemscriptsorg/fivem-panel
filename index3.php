<!DOCTYPE html>

<?php


require_once 'Recursos/BD.php';
session_start();

if(!isset($_SESSION['logeado'])) {
	echo "<script>location.href='login.php';</script>";
	die();
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
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php include_once "header.php" ?>
<?php include_once "menu.php" ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Inicio
        <small>Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Inicio</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php  echo count(seleccionar_BD("SELECT * FROM users"));  ?></h3>

              <p>Usuarios Registrados</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php  echo count(seleccionar_BD("SELECT * FROM users WHERE isDonator > 0"));  ?></h3>

              <p>Usuarios VIP</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            
          </div>
        </div>
      <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php  echo count(seleccionar_BD("SELECT * FROM users WHERE job = 'police'"));  ?></h3>

              <p>Usuarios GC</p>
            </div>
            <div class="icon">
              <i class="ion-briefcase"></i>
            </div>
           
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php  echo count(seleccionar_BD("SELECT * FROM users WHERE job = 'ambulance'"));  ?></h3>

              <p>Usuarios EMS</p>
            </div>
            <div class="icon">
              <i class="ion ion-medkit"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
	  
	  
      <!--<div class="row">
        
        
     </div>
       -->

	<!-- filera 2-->
      
         <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Usuarios En Tiempo Real</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
               
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                    <strong>Users</strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                   <div id="container" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <p class="text-center">
                    <strong>Servers</strong>
                  </p>

                  <div class="progress-group">
                    <span class="progress-text">#S1</span>
                    <span class="progress-number"><b>19</b>/30</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                 
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">#S2</span>
                    <span class="progress-number"><b>25</b>/30</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-yellow" style="width: 67%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
        <!-- ./col -->

      <!-- /.row -->
      <!-- Main row -->
	  
	  <?php $tickets = seleccionar_BD("SELECT * FROM panel_tickets ORDER BY fecha DESC;");?>
      <form name="PENDIENTES" action="funciones/modificar_ticket.php" method="POST">
	  <div class="row">
		<div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Pendientes</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table id="pendientes" class="table table-hover">
                <thead>
                <tr>
                  <th>Tipo</th>
				  <th>ID</th>
                  <th>Usuario</th>
				  <th>SteamID</th>
                  <th>Razón</th>
				  <th>Staff</th>
                  <th>Tiempo</th>
                  <th>Estado</th>
				  <th>Acción</th>
				  <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                <?php 
				 foreach( $tickets as $ticket){
					 $_SESSION['idt'] = $ticket["id"];
					 $_SESSION['tipot'] = $ticket["tipo"];
					 if ($ticket['status'] == 0){
						 
							 if($ticket['tipo'] == 1){ $tipo = "<td><span class=\"label label-warning\">KICK</span></td>";}elseif($ticket['tipo'] == 3){$tipo = "<td><span class=\"label label-danger\">BAN</span></td>";}
					 elseif($ticket['tipo'] == 4){$tipo = "<td><span class=\"label label-danger\">WIPE</span></td>";}elseif($ticket['tipo'] == 2){$tipo = "<td><span class=\"label label-danger\">BANTEMP</span></td>";}elseif($ticket['tipo'] == 5){$tipo = "<td><span class=\"label label-danger\">DESBANEO</span></td>";}else{$tipo = "ERROR";}
					 
					 if($ticket['status'] == 0){ $estado = "<td><span class=\"label label-warning\">PENDIENTE</span></td>";}elseif($ticket['status'] == 1){$estado = "<td><span class=\"label label-primary\">APROBADO</span></td>";}
					 elseif($ticket['status'] == 2){$estado = "<td><span class=\"label label-danger\">RECHAZADO</span></td>";}else{$estado = "<td>ERROR</td>";}
					 
						echo '
							<tr>
							'.$tipo.'
							<td>'.$ticket["usuario"].'</td>
							<td>'.$ticket["id"].'</td>
							<td>'.$ticket["steamid"].'</td>
							<td>'.$ticket['razon'].'</td>
							<td>'.$ticket["staff"].'</td>
							<td>'.$ticket["tiempo"].'</td>
							'.$estado.'
							<td><a href=./funciones/modificar_ticket.php?id='.$ticket["id"].'&accion=0>Aprobar</td>
							<td><a href=./funciones/modificar_ticket.php?id='.$ticket["id"].'&accion=1>Rechazar</td>
							</tr>
						';
					 }
				 }
				 ?>
                </tbody>
                <tfoot>
                <tr>
                 <th>Tipo</th>
				  <th>ID</th>
                  <th>Usuario</th>
				  <th>SteamID</th>
                  <th>Razón</th>
				  <th>Staff</th>
                  <th>Tiempo</th>
                  <th>Estado</th>
				  <th>Acción</th>
				  <th>Acción</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		  
		          </div>
        <!-- /.col -->
      </div>
	  </form>
      <!-- /.row -->
         <div class="row">
       <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Ultima Actividad</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table id="UltimaA" class="table table-hover">
                <thead>
				
                <tr>
                  <th>Tipo</th>
                  <th>Usuario</th>
                  <th>Razón</th>
				  <th>Staff</th>
                  <th>tiempo</th>
				  <th>Fecha</th>
				  <th>Estado</th>
                  
                </tr>
				
                </thead>
                <tbody>
				<?php 
				 foreach( $tickets as $ticket){
					 // if ($ticket['status'] == 0){
						 
							 if($ticket['tipo'] == 1){ $tipo = "<td><span class=\"label label-warning\">KICK</span></td>";}elseif($ticket['tipo'] == 3){$tipo = "<td><span class=\"label label-danger\">BAN</span></td>";}
					 elseif($ticket['tipo'] == 4){$tipo = "<td><span class=\"label label-danger\">WIPE</span></td>";}elseif($ticket['tipo'] == 2){$tipo = "<td><span class=\"label label-info\">BANTEMP</span></td>";}elseif($ticket['tipo'] == 5){$tipo = "<td><span class=\"label label-success\">DESBANEO</span></td>";}else{$tipo = "ERROR";}
					 
					 if($ticket['status'] == 0){ $estado = "<td><span class=\"label label-warning\">PENDIENTE</span></td>";}elseif($ticket['status'] == 1){$estado = "<td><span class=\"label label-primary\">APROBADO</span></td>";}
					 elseif($ticket['status'] == 2){$estado = "<td><span class=\"label label-danger\">RECHAZADO</span></td>";}else{$estado = "<td>ERROR</td>";}
					 
						echo '
							<tr>
							'.$tipo.'
							<td><a href=./usuario.php?licencia='.$ticket['licencia'].'>'.$ticket["usuario"].'</td>
							<td>'.$ticket["razon"].'</td>
							<td>'.$ticket["staff"].'</td>
							<td>'.$ticket["tiempo"].'</td>
							<td>'.$ticket["fecha"].'</td>
							'.$estado.'
							</tr>
						';
					 //}
				 }
				 ?>
                </tbody>
                <tfoot>
                <tr>
                 <th>Tipo</th>
                  <th>Usuario</th>
                  <th>Razón</th>
				  <th>Staff</th>
				  <th>tiempo</th>
                  <th>Fecha</th>
                  <th>Estado</th>
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
		
        <button id ="testn" onclick="notificacion()">Click me</button>
       
      <!-- /.row (main row) -->

    </section>
	
	<!-- /.filera 2-->
	
    <!-- /.content -->
  </div>
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
<!-- tablas -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="bower_components/chart.js/Chart.js"></script>



<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>




<!-- AdminLTE App -->
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
<script src="dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script>
  $(function () {
    $('#pendientes').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : true
    })
    $('#UltimaA').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script>
<script>
var ctx = document.getElementById("usuarios");
var usuarios = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>


      <script>
    
Highcharts.setOptions({
    global: {
        useUTC: false
    }
});

Highcharts.chart('container', {
    chart: {
        type: 'spline',
        animation: Highcharts.svg, // don't animate in old IE
        marginRight: 10,
        events: {
            load: function () {

                // set up the updating of the chart each second
                
					var series = this.series[0];
					
					
         
	  setInterval(function () {
		        $.ajax({  
       type: 'POST',
       url: 'usuarios.php',
		data: 'dataString',
       success:function(data) {
				
               
				yt = data;
				
				 
       },
       error : function(){
            // Te sugiero ver la documentación y agregar los demas parámetros que recibe en caso de error
            // lo anterior te permitirá saber más "preciso" que error se reportar y por consiguiente podrás depurar y corregir.
            
       }
     });
		  var x = (new Date()).getTime(); // current time
                     var y = parseInt(yt);
					 
                    series.addPoint([x, y], true, true);
                }, 7000);
                   
            }
        }
    },
    title: {
        text: 'Usuarios En tiempo real'
    },
    xAxis: {
        type: 'datetime',
        tickPixelInterval: 150
    },
    yAxis: {
        title: {
            text: 'Usuarios'
        },
        plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
        }]
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
                Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                Highcharts.numberFormat(this.y, 2);
        }
    },
    legend: {
        enabled: false
    },
    exporting: {
        enabled: false
    },
    series: [{
        name: 'Usuarios TOTALES',
        data: (function () {
            // generate an array of random data
            var data = [],
                time = (new Date()).getTime(),
                i;

            for (i = -19; i <= 0; i += 1) {
                data.push({
                   x: time + i * 1000,
                    y: 0
                });
            }
            return data;
        }())
    }]
});
</script>


<script>
function notificacion() {
if (Notification) {
if (Notification.permission !== "granted") {
Notification.requestPermission()
}
var title = "POPPanel"
var extra = {
icon: "./imagenes/PGS.jpg",
body: "Esto es un TEST"
}
var noti = new Notification( title, extra)
noti.onclick = {
// Al hacer click
}
noti.onclose = {
// Al cerrar
}
setTimeout( function() { noti.close() }, 10000)
}
}
</script>


</body>
</html>
