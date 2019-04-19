<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'Recursos/BD.php';
require_once 'Recursos/panel_negros.php';

session_start();

if(!isset($_SESSION['logeado'])) {
	echo "<script>location.href='login.php';</script>";
	die();
}
if( !$_SESSION['lvRANGO'] >= 2){
	echo "<script>location.href='index.php';</script>";
	die();
}


if($_SERVER["REQUEST_METHOD"] == "GET"){
	print_r($_GET);
	
	$accion = $_GET["a"];
	
	if (!is_null($accion)) {
		# code...
	
		$adm = $_SESSION["Nombre"];
		$sesion = new Sesion($adm);
		
		
		if ($accion == "0") {
			# code...
			
			$sesion->nueva();
		}elseif($accion == "1"){
			$sesion->finalizar();
		}else{
			
		}
		print_r($sesion);
	}

}


header('Location: http://poplife.es/panel/');
?>