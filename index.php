<!DOCTYPE html>

<?php


require_once 'Recursos/BD.php';
require_once 'Recursos/temppanel_negros.php';

session_start();

if(!isset($_SESSION['logeado'])) {
	echo "<script>location.href='login.php';</script>";
	die();
}


  $adm = $_SESSION["Nombre"];
  $sesion = new Sesion($adm); 

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
              <h3><?php  echo count(seleccionar_BD("SELECT 'name' FROM users"));  ?></h3>

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
              <h3><?php  echo count(seleccionar_BD("SELECT 'name' FROM users WHERE isDonator > 0"));  ?></h3>

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
              <h3><?php  echo count(seleccionar_BD("SELECT 'name' FROM users WHERE job = 'police'"));  ?></h3>

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
              <h3><?php  echo count(seleccionar_BD("SELECT 'name' FROM users WHERE job = 'ambulance'"));  ?></h3>

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
      
          <!-- filera 2 <div class="row">
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
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                    <strong>Users</strong>
                  </p>

                  <div class="chart">
                   <div id="container" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
                  </div>
                </div>
                <div class="col-md-4">
                  <p class="text-center">
                    <strong>Servers</strong>
                  </p>
                  <center>
                  <strong>Esta puta mierda no va</strong>
                 <br>
                  <strong>Hay que arreglarla</strong>
              </center>
                </div>
              </div>
            </div>
          </div>
        </div> </div>-->

        <style>

        .myButton {
  -moz-box-shadow: 0px 10px 14px -7px #3e7327;
  -webkit-box-shadow: 0px 10px 14px -7px #3e7327;
  box-shadow: 0px 10px 14px -7px #3e7327;
  background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #77b55a), color-stop(1, #72b352));
  background:-moz-linear-gradient(top, #77b55a 5%, #72b352 100%);
  background:-webkit-linear-gradient(top, #77b55a 5%, #72b352 100%);
  background:-o-linear-gradient(top, #77b55a 5%, #72b352 100%);
  background:-ms-linear-gradient(top, #77b55a 5%, #72b352 100%);
  background:linear-gradient(to bottom, #77b55a 5%, #72b352 100%);
  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#77b55a', endColorstr='#72b352',GradientType=0);
  background-color:#77b55a;
  -moz-border-radius:4px;
  -webkit-border-radius:4px;
  border-radius:4px;
  border:1px solid #4b8f29;
  display:inline-block;
  cursor:pointer;
  color:#ffffff;
  font-family:Arial;
  font-size:28px;
  font-weight:bold;
  padding:20px 30px;
  text-decoration:none;
  text-shadow:0px 1px 0px #5b8a3c;
}
.myButton:hover {
  background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #72b352), color-stop(1, #77b55a));
  background:-moz-linear-gradient(top, #72b352 5%, #77b55a 100%);
  background:-webkit-linear-gradient(top, #72b352 5%, #77b55a 100%);
  background:-o-linear-gradient(top, #72b352 5%, #77b55a 100%);
  background:-ms-linear-gradient(top, #72b352 5%, #77b55a 100%);
  background:linear-gradient(to bottom, #72b352 5%, #77b55a 100%);
  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#72b352', endColorstr='#77b55a',GradientType=0);
  background-color:#72b352;
}
.myButton:active {
  position:relative;
  top:1px;
}



.myButton2 {
  -moz-box-shadow: 0px 10px 14px -7px #732727;
  -webkit-box-shadow: 0px 10px 14px -7px #732727;
  box-shadow: 0px 10px 14px -7px #732727;
  background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #b35959), color-stop(1, #b35252));
  background:-moz-linear-gradient(top, #b35959 5%, #b35252 100%);
  background:-webkit-linear-gradient(top, #b35959 5%, #b35252 100%);
  background:-o-linear-gradient(top, #b35959 5%, #b35252 100%);
  background:-ms-linear-gradient(top, #b35959 5%, #b35252 100%);
  background:linear-gradient(to bottom, #b35959 5%, #b35252 100%);
  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#b35959', endColorstr='#b35252',GradientType=0);
  background-color:#b35959;
  -moz-border-radius:4px;
  -webkit-border-radius:4px;
  border-radius:4px;
  border:1px solid #8f2929;
  display:inline-block;
  cursor:pointer;
  color:#ffffff;
  font-family:Arial;
  font-size:28px;
  font-weight:bold;
  padding:20px 30px;
  text-decoration:none;
  text-shadow:0px 1px 0px #8a3d3d;
}
.myButton2:hover {
  background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #b35252), color-stop(1, #b35959));
  background:-moz-linear-gradient(top, #b35252 5%, #b35959 100%);
  background:-webkit-linear-gradient(top, #b35252 5%, #b35959 100%);
  background:-o-linear-gradient(top, #b35252 5%, #b35959 100%);
  background:-ms-linear-gradient(top, #b35252 5%, #b35959 100%);
  background:linear-gradient(to bottom, #b35252 5%, #b35959 100%);
  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#b35252', endColorstr='#b35959',GradientType=0);
  background-color:#b35252;
}
.myButton2:active {
  position:relative;
  top:1px;
}



    </style>

    <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">

              <center>
                  <strong>Tus Horas de servicio:</strong>
                 <br>
                  <strong><?php
                            echo(round(($sesion->tiempoTotal/3600), 2));
                            ?> Horas</strong>
              </center>
              <?php 
          if ($sesion->servicio) {
            # code...
            echo '<center><a href="negros.php/?a=1" class="myButton2">Salir de Servicio</a>';
          }else{
            echo '<center><a href="negros.php/?a=0" class="myButton">Entrar de Servicio</a>';
          }
          
          ?>


	
            </div>
          </div>
        </div>
      </div>

	  <?php $tickets = seleccionar_BD("SELECT * FROM panel_tickets ORDER BY fecha DESC LIMIT 100;");?>
	  
	  
				<div id= "tablaticketsg"></div>

             
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
				  <th>Comentario</th>
				  <th>Staff</th>
                  <th>tiempo</th>
				  <th>Fecha</th>
				  <th>Estado</th>
				  <th>Acción</th>
                  
                </tr>
				
                </thead>
                <tbody>
				<?php 
        if($_SESSION['lvRANGO'] >= 2 and $_SESSION['lvRANGO'] != 8){
				 foreach( $tickets as $ticket){
					 // if ($ticket['status'] == 0){
						 
							 if($ticket['tipo'] == 1){ $tipo = "<td><span class=\"label label-warning\">KICK</span></td>";}elseif($ticket['tipo'] == 3){$tipo = "<td><span class=\"label label-danger\">BAN</span></td>";}
					 elseif($ticket['tipo'] == 4){$tipo = "<td><span class=\"label label-danger\">WIPE</span></td>";}elseif($ticket['tipo'] == 2){$tipo = "<td><span class=\"label label-info\">BANTEMP</span></td>";}elseif($ticket['tipo'] == 5){$tipo = "<td><span class=\"label label-success\">DESBANEO</span></td>";}elseif($ticket['tipo'] == 6){$tipo = "<td><span class=\"label label-warning\">AVISO</span></td>";}else{$tipo = "ERROR";}
					 
					 if($ticket['status'] == 0){ $estado = "<td><span class=\"label label-warning\">PENDIENTE</span></td>";}elseif($ticket['status'] == 1){$estado = "<td><span class=\"label label-primary\">APROBADO</span></td>";}
					 elseif($ticket['status'] == 2){$estado = "<td><span class=\"label label-danger\">RECHAZADO</span></td>";}else{$estado = "<td>ERROR</td>";}
					 
					 if ($ticket["comentarios"] != ''){
						 
						 $comentario = $ticket["comentarios"];
						 echo '
              <div class="modal modal-warning fade" id="comentario'.$ticket["id"].'">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Ticket ID: '.$ticket["id"].'</h4>
                    </div>
                    <div class="modal-body">
                      <p>'.$comentario.'</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                      
                    </div>
                  </div>
                <!-- /.modal-content -->
                </div>
              <!-- /.modal-dialog -->
              </div>
            <!-- /.modal -->
					 
					 ';
					 $boton = '<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#comentario'.$ticket["id"].'">Comentario</button>';
					 }else{
						 $comentario = "...";
						 $boton = " ";
					 }
					 
					 
						echo '
							<tr>
							'.$tipo.'
							<td><a href=./usuario.php?licencia='.$ticket['licencia'].'>'.$ticket["usuario"].'</td>
							<td>'.$ticket["razon"].'</td>
							<td>'.$boton.'</td>
							<td>'.$ticket["staff"].'</td>
							<td>'.$ticket["tiempo"].'</td>
							<td>'.$ticket["fecha"].'</td>
							'.$estado.'
							<td><a href=./funciones/modificar_ticket.php?id='.$ticket["id"].'&accion=2>ELIMINAR</td>
							</tr>
						';
					 //}
				 }


        }
				 ?>
                </tbody>
                <tfoot>
                <tr>
                 <th>Tipo</th>
                  <th>Usuario</th>
                  <th>Razón</th>
				  <th>Comentario</th>
				  <th>Staff</th>
				  <th>tiempo</th>
                  <th>Fecha</th>
                  <th>Estado</th>
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
		
		</div> <!--row-->
		






		         <div class="row">
       <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Ultima Actividad Time</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table id="UltimaAT" class="table table-hover">
                <thead>
				
                <tr>
                  <th>Fecha inicio</th>
                  <th>Fecha Final</th>
                  <th>Horas</th>
                  
                </tr>
				
                </thead>
                <tbody>
				<?php 
        if($_SESSION['lvRANGO'] >= 2){
        				$historiales = $sesion->getHistorial();
        				foreach ($historiales as $historial) {
        					# code...
	        				
							echo '
								<tr>
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
    $('#UltimaAT').DataTable({
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
$(document).ready(
            function() {
		    $.ajax({
  
					url:"./funciones/tabala_general_tickets.php",  
					method:"POST",  
					success:function(data){  
                     $('#tablaticketsg').html(data);  
					}  
				});  
           setInterval(function() {                  
				$.ajax({
  
					url:"./funciones/tabala_general_tickets.php",  
					method:"POST",  
					success:function(data){  
                     $('#tablaticketsg').html(data);  
					}  
				});  
		
	  
				}, 10000);
			}
	  );
</script>
</body>
</html>
