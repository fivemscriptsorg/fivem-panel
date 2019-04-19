<?php

require_once './Recursos/BD.php';

	
	
		$servers = seleccionar_BD("SELECT * FROM panel_servers");
	
	$nusert = 0;
	foreach($servers  as $server ){
		
		$url = "http://".$server["ip"].":".$server["puerto"]."/players.json";
		$json = @file_get_contents($url); 
		$data = json_decode($json, true);
		if(!$json === FALSE ){
			
			
		
		
		$server["jugadores"] = $data;
		
		$nusers = count($server["jugadores"]);
		$nusert = $nusert + $nusers;
		
		
		}
		
	
}
echo $nusert;



?>