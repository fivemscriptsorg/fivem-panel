<?php
require_once './Recursos/BD.php';

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
	
		//Obtenemos el tipo de accion y la sanitamos paras evitar sql inyection
		
		/*
		Tipos De Acciones: 
			1 : Kick "Aviso"
			2 : Temp Ban
			3 : Perma Ban
			4 : Wipe
			5 : Desbaneo
		*/
		$accion = trim($_GET["accion"]);
		$accion = htmlspecialchars($accion);
		$accion = mysql_real_escape_string($accion);
		
		//Obtenemos el estado y lo sanitamos paras evitar sql inyection
		
		/*
		Tipos De Estado: 
			0 : Pendiente
			1 : Aprobado
			2 : Rechazado	
		*/
		$estado = trim($_GET["estado"]);
		$estado = htmlspecialchars($estado);
		$estado = mysql_real_escape_string($estado);
		
		//Obtenemos el SteamID del usuario y lo sanitamos paras evitar sql inyection
		$steamid = trim($_GET["steamid"]);
		$steamid = htmlspecialchars($steamid); 
		$steamid = mysql_real_escape_string($steamid);
		
		
		
		//Obtenemos el usuario y lo sanitamos paras evitar sql inyection
		$usuario = trim($_GET["usuario"]);
		$usuario = htmlspecialchars($usuario); 
		$usuario = mysql_real_escape_string($usuario);
		
		//Obtenemos el Staff y lo sanitamos paras evitar sql inyection
		$staff = trim($_GET["staff"]);
		$staff = htmlspecialchars($staff); 
		$staff = mysql_real_escape_string($staff);
		
			if ($lvrango >= 6){
			
				if($accion == 1){

		
				}elseif($accion == 2){
				
				
				
				}elseif($accion == 3){
				
				
				
				}elseif($accion == 4)){
				
				
				
				}elseif($accion == 5){
					
				}

				break;
			}elseif($lvrango >= 5){
				
				
				if($accion == 1){
			
		

		
				}elseif($accion == 2){
				
				
				
				}elseif($accion == 3){
				
				
				
				}elseif($accion == 4)){
				
				
				
				}elseif($accion == 5){
					
				}
		

				break;
			}elseif($lvrango >= 4){
				
				if($accion == 1){
			
		

		
				}elseif($accion == 2){
				
				
				
				}elseif($accion == 3){
				
				
				
				}elseif($accion == 4)){
				
				
				
				}elseif($accion == 5){
					
				}
	
				break;
			}elseif($lvrango >= 3){
				
				if($accion == 1){
			
		

		
				}elseif($accion == 2){
				
				
				
				}elseif($accion == 3){
				
				
				
				}elseif($accion == 4)){
				
				
				
				}elseif($accion == 5){
					
				}
				
				break;
			}elseif($lvrango >= 2){
				
				if($accion == 1){
			
		

		
				}elseif($accion == 2){
				
				
				
				}elseif($accion == 3){
				
				
				
				}elseif($accion == 4)){
				
				
				
				}elseif($accion == 5){
					
				}
				
				break;
			}else{ echo ' ERROR contacta con VictorMinemu';	break;}
	
	
	
	}
?>
