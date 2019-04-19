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
require_once './BD.php';
session_start();
?>
<?php $tickets = seleccionar_BD("SELECT * FROM panel_tickets WHERE status = '0' ORDER BY fecha DESC LIMIT 10");?>
                <?php 
                if($_SESSION['lvRANGO'] >= 2){
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