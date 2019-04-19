<?php
require_once './Recursos/BD.php';

function dar_kit($licencia,$money,$type){
		
	$new_money = $money + $type;
	
	$request = request_BD("UPDATE `users` SET bank='$new_money' WHERE license = '$licencia'");		
}

?>