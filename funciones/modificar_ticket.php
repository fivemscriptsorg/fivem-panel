<?php


require_once 'BD.php';
require_once 'gestion_ticket.php';
require_once 'gestion_rcon2.php';
require("q3query.class.php");
session_start();

if(!isset($_SESSION['logeado'])) {
	echo "<script>location.href='login.php';</script>";
	die();
}
if( !$_SESSION['lvRANGO'] >= 2){
	echo "<script>location.href='index.php';</script>";
	die();
}

$lvrango = $_SESSION['lvRANGO'];





if($_SERVER["REQUEST_METHOD"] == "GET"){
		
	
	$id = trim($_GET["id"]);
	$accion = trim($_GET["accion"]);

	
	$tickets = seleccionar_BD("SELECT * FROM panel_tickets WHERE id = '$id' LIMIT 1");
	

	foreach($tickets as $ticket){
		
		
		
		$staff =  $ticket['staff'];
		$usuario =  $ticket['usuario'];
		$steamid =  $ticket['steamid'];
		$razon =  $ticket['razon'];
		$tiempo =  $ticket['tiempo'];
		$tipo =  $ticket['tipo'];
		
		
		
	}
	
	//function aprobar_pendiente($id, $staff, $usuario, $steamid, $razon, $tiempo, $tipo){
	
		if ($lvrango == 2 ){
			
			
			
			
		}
		
		if ($lvrango == 3 ){
			
			
			
			if ( $accion == 0){
				if ($tipo == 2){
					$aprovar = aprobar_pendiente($id, $staff, $usuario, $steamid, $razon, $tiempo, $tipo);
				}
			}elseif($accion == 1){
				if ($tipo == 2){
				$rechazar = rechazar_pendiente($id);
				}
			}
		}
		
		
		if ($lvrango == 4 ){
			
			
		
			if ( $accion == 0){
				if ($tipo == 2){
					$aprovar = aprobar_pendiente($id, $staff, $usuario, $steamid, $razon, $tiempo, $tipo);
				}
				if ($tipo == 3){
					$aprovar = aprobar_pendiente($id, $staff, $usuario, $steamid, $razon, $tiempo, $tipo);
				}
			}elseif($accion == 1){
				if ($tipo == 2){
				$rechazar = rechazar_pendiente($id);
				}
				if ($tipo == 3){
					$aprovar = rechazar_pendiente($id);
				}
			}
			
		}
		if ($lvrango == 5 ){
			
			
			
			if ( $accion == 0){
				if ($tipo == 2){
					$aprovar = aprobar_pendiente($id, $staff, $usuario, $steamid, $razon, $tiempo, $tipo);
				}
				if ($tipo == 3){
					$aprovar = aprobar_pendiente($id, $staff, $usuario, $steamid, $razon, $tiempo, $tipo);
				}
				if ($tipo == 5){
					$aprovar = aprobar_pendiente($id, $staff, $usuario, $steamid, $razon, $tiempo, $tipo);
				}
			}elseif($accion == 1){
				if ($tipo == 2){
				$rechazar = rechazar_pendiente($id);
				}
				if ($tipo == 3){
					$aprovar = rechazar_pendiente($id);
				}
				if ($tipo == 5){
					$aprovar = rechazar_pendiente($id);
				}
			}
			
			
		}
		if ($lvrango >= 6 ){
			
			
			
			if ( $accion == 0){
				if ($tipo == 2){
					$aprovar = aprobar_pendiente($id, $staff, $usuario, $steamid, $razon, $tiempo, $tipo);
				}
				if ($tipo == 3){
					$aprovar = aprobar_pendiente($id, $staff, $usuario, $steamid, $razon, $tiempo, $tipo);
				}
				if ($tipo == 5){
					$aprovar = aprobar_pendiente($id, $staff, $usuario, $steamid, $razon, $tiempo, $tipo);
				}
			}elseif($accion == 1){
				if ($tipo == 2){
				$rechazar = rechazar_pendiente($id);
				}
				if ($tipo == 3){
					$aprovar = rechazar_pendiente($id);
				}
				if ($tipo == 5){
					$aprovar = rechazar_pendiente($id);
				}
			}elseif($accion == 2){
				$request = request_BD("delete from panel_tickets where id = '$id'");
			}
			
			
		}
		
		

	}


	
echo $lvrango;
echo $accion;
echo $tipo;
	header('Location: http://poplife.es/panel/index.php');

?>