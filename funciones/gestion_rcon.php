<?php
require_once './Recursos/BD.php';






function rcon_kick($steamid, $razon){
	
	
	$servers = seleccionar_BD("SELECT * FROM panel_servers");
	
	ini_set('default_socket_timeout', 130);
	foreach($servers  as $server )
	{
		
		$url = "http://".$server["ip"].":".$server["puerto"]."/players.json";
		$json = @file_get_contents($url); 
		$data = json_decode($json, true);
		if(!$json === FALSE ){
			
			
	
		
			$server["jugadores"] = $data;
		
			foreach ($server["jugadores"] as $jugador)
			{
			
				//if (stripos($jugador['identifiers'][0], "steam")){
				
					if($jugador['identifiers'][0] == $steamid)
					{
					
						$con = new q3query($server["ip"], $server["puerto"], $success);
					
						if (!$success) 
						{
							die ("ERROR EN LA CONEXIÓN RCON");
					
						}
					
						$con->setRconpassword($server["rcon"]);
					
						$con->rcon("clientkick ".$jugador["id"]." $razon");
					
					}
				
				
				//}
			
			
			}	
	
		}
	}
	
	
}




?>