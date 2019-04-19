<?php
require_once './Recursos/BD.php';


function dar_coche($steamid, $hash, $nombre)
{
    # code...
    $baseJSON = '{"modAirFilter":-1,"modSteeringWheel":-1,"wheels":0,"modOrnaments":-1,"modSpeakers":-1,"color2":0,"modGrille":-1,"dirtLevel":8.3588266372681,"modFender":-1,"modRoof":-1,"modAPlate":-1,"plateIndex":1,"neonColor":[255,0,0],"modHorns":-1,"color1":29,"modTrimB":-1,"modTransmission":2,"modTrunk":-1,"modArmor":4,"modTank":-1,"modEngine":3,"modFrontBumper":2,"windowTint":1,"modSideSkirt":3,"modBrakes":2,"modRearBumper":-1,"modEngineBlock":-1,"modWindows":-1,"modRightFender":-1,"modTrimA":-1,"modDial":-1,"neonEnabled":[1,1,1,1],"modArchCover":-1,"pearlescentColor":29,"modXenon":1,"modDashboard":-1,"modHood":-1,"modPlateHolder":-1,"modTurbo":false,"modExhaust":2,"wheelColor":0,"modFrame":0,"modShifterLeavers":-1,"modLivery":-1,"modVanityPlate":-1,"modBackWheels":-1,"modDoorSpeaker":-1,"modHydrolic":-1,"plate":"24Fht797","health":784,"tyreSmokeColor":[255,0,0],"model":-1567297735,"modSpoilers":2,"modSuspension":3,"modStruts":-1,"modSeats":-1,"modSmokeEnabled":1,"modFrontWheels":-1,"modAerials":-1}';
    $propiedades = json_decode($baseJSON, true);
	
	$letras = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $matricula='';
        $i=0;
		
        while($i<8){
            $posicion=rand(0,35);
            $matricula=$matricula.substr($letras,$posicion,1);
            $i++;
        }
    $propiedades['plate'] = $matricula;
    $propiedades['model'] = intval($hash);
    $vehiculo = json_encode($propiedades);  
    $request = request_BD("INSERT INTO owned_vehicles (vehicle, owner, state,name) VALUES ('$vehiculo', '$steamid', 1,'$nombre')");
}


function dar_cochef($steamid){
	
	$ferrarij = '{"modAirFilter":-1,"modSteeringWheel":-1,"wheels":0,"modOrnaments":-1,"modSpeakers":-1,"color2":0,"modGrille":-1,"dirtLevel":8.3588266372681,"modFender":-1,"modRoof":-1,"modAPlate":-1,"plateIndex":1,"neonColor":[255,0,0],"modHorns":-1,"color1":29,"modTrimB":-1,"modTransmission":2,"modTrunk":-1,"modArmor":4,"modTank":-1,"modEngine":3,"modFrontBumper":2,"windowTint":1,"modSideSkirt":3,"modBrakes":2,"modRearBumper":-1,"modEngineBlock":-1,"modWindows":-1,"modRightFender":-1,"modTrimA":-1,"modDial":-1,"neonEnabled":[1,1,1,1],"modArchCover":-1,"pearlescentColor":29,"modXenon":1,"modDashboard":-1,"modHood":-1,"modPlateHolder":-1,"modTurbo":false,"modExhaust":2,"wheelColor":0,"modFrame":0,"modShifterLeavers":-1,"modLivery":-1,"modVanityPlate":-1,"modBackWheels":-1,"modDoorSpeaker":-1,"modHydrolic":-1,"plate":"24Fht797","health":784,"tyreSmokeColor":[255,0,0],"model":-1567297735,"modSpoilers":2,"modSuspension":3,"modStruts":-1,"modSeats":-1,"modSmokeEnabled":1,"modFrontWheels":-1,"modAerials":-1}';
	
	$ferrari = json_decode($ferrarij, true);
	
	$letras = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $matricula='';
        $i=0;
		
        while($i<8){
            $posicion=rand(0,35);
            $matricula=$matricula.substr($letras,$posicion,1);
            $i++;
        }
		
	$ferrari['plate'] = $matricula;
	
	$ferrarij = json_encode($ferrari);
	
	$request = request_BD("INSERT INTO owned_vehicles (vehicle, owner, state,name) VALUES ('$ferrarij', '$steamid', 1,'F430S')");
	

	
	
}

function dar_cochel($steamid){
	
	$ferrarij = '{"modAirFilter":-1,"modSteeringWheel":-1,"wheels":0,"modOrnaments":-1,"modSpeakers":-1,"color2":0,"modGrille":-1,"dirtLevel":8.3588266372681,"modFender":-1,"modRoof":-1,"modAPlate":-1,"plateIndex":1,"neonColor":[255,0,0],"modHorns":-1,"color1":29,"modTrimB":-1,"modTransmission":2,"modTrunk":-1,"modArmor":4,"modTank":-1,"modEngine":3,"modFrontBumper":2,"windowTint":1,"modSideSkirt":3,"modBrakes":2,"modRearBumper":-1,"modEngineBlock":-1,"modWindows":-1,"modRightFender":-1,"modTrimA":-1,"modDial":-1,"neonEnabled":[1,1,1,1],"modArchCover":-1,"pearlescentColor":29,"modXenon":1,"modDashboard":-1,"modHood":-1,"modPlateHolder":-1,"modTurbo":false,"modExhaust":2,"wheelColor":0,"modFrame":0,"modShifterLeavers":-1,"modLivery":-1,"modVanityPlate":-1,"modBackWheels":-1,"modDoorSpeaker":-1,"modHydrolic":-1,"plate":"24Fht797","health":784,"tyreSmokeColor":[255,0,0],"model":865989668,"modSpoilers":2,"modSuspension":3,"modStruts":-1,"modSeats":-1,"modSmokeEnabled":1,"modFrontWheels":-1,"modAerials":-1}';
	
	$ferrari = json_decode($ferrarij, true);
	
	$letras = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $matricula='';
        $i=0;
		
        while($i<8){
            $posicion=rand(0,35);
            $matricula=$matricula.substr($letras,$posicion,1);
            $i++;
        }
		
	$ferrari['plate'] = $matricula;
	
	$ferrarij = json_encode($ferrari);
	
	$request = request_BD("INSERT INTO owned_vehicles (vehicle, owner, state,name) VALUES ('$ferrarij', '$steamid', 1,'LAMBORGUINI')");
	

	
	
}


function dar_cochegtrs($steamid){
	
	$ferrarij = '{"modTank":-1,"modWindows":-1,"modExhaust":-1,"modFrame":-1,"plateIndex":1,"modRightFender":-1,"modRoof":-1,"modEngine":-1,"modSpoilers":-1,"modFender":-1,"modHydrolic":-1,"modGrille":-1,"modAirFilter":-1,"tyreSmokeColor":[255,255,255],"modEngineBlock":-1,"modXenon":false,"modFrontBumper":-1,"modSeats":-1,"modPlateHolder":-1,"modRearBumper":-1,"modTurbo":false,"modSteeringWheel":-1,"wheels":0,"modTrunk":-1,"modSpeakers":-1,"wheelColor":156,"modDoorSpeaker":-1,"modAPlate":-1,"model":-1983015514,"plate":"24HDD750","modSideSkirt":-1,"color1":38,"modArchCover":-1,"dirtLevel":4.0,"modArmor":-1,"modLivery":-1,"modVanityPlate":-1,"modOrnaments":-1,"modTrimA":-1,"modSmokeEnabled":false,"modDashboard":-1,"modStruts":-1,"pearlescentColor":0,"health":1000,"modShifterLeavers":-1,"modFrontWheels":-1,"neonEnabled":[false,false,false,false],"neonColor":[255,0,255],"modHorns":-1,"modTransmission":-1,"modAerials":-1,"color2":0,"modBrakes":-1,"modSuspension":-1,"modHood":-1,"modBackWheels":-1,"modDial":-1,"modTrimB":-1,"windowTint":-1}';
	
	$ferrari = json_decode($ferrarij, true);
	
	$letras = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $matricula='';
        $i=0;
		
        while($i<8){
            $posicion=rand(0,35);
            $matricula=$matricula.substr($letras,$posicion,1);
            $i++;
        }
		
	$ferrari['plate'] = $matricula;
	
	$ferrarij = json_encode($ferrari);
	
	$request = request_BD("INSERT INTO owned_vehicles (vehicle, owner, state,name) VALUES ('$ferrarij', '$steamid', 1),'GTRS'");
	

	
	
}


function dar_cochecorvette($steamid){
    
	
	$ferrarij = '{"modDial":-1,"neonColor":[255,0,255],"modTransmission":-1,"neonEnabled":[false,false,false,false],"modExhaust":-1,"modTrunk":-1,"color1":38,"modGrille":-1,"modDashboard":-1,"modSpoilers":-1,"modTrimB":-1,"modXenon":false,"modAirFilter":-1,"modRoof":-1,"tyreSmokeColor":[255,255,255],"modShifterLeavers":-1,"modRightFender":-1,"modSuspension":-1,"modFrontBumper":-1,"modArchCover":-1,"model":874739883,"modTank":-1,"modFrame":-1,"windowTint":-1,"modTrimA":-1,"health":1000,"modAerials":-1,"modLivery":-1,"modOrnaments":-1,"modArmor":-1,"wheels":0,"modSteeringWheel":-1,"modHorns":-1,"dirtLevel":0.0,"modStruts":-1,"modBrakes":-1,"modSideSkirt":-1,"color2":0,"modVanityPlate":-1,"modRearBumper":-1,"wheelColor":1,"pearlescentColor":88,"modBackWheels":-1,"modHood":-1,"modSmokeEnabled":false,"plate":"61IRS519","modFrontWheels":-1,"modDoorSpeaker":-1,"modWindows":-1,"modSpeakers":-1,"modHydrolic":-1,"modPlateHolder":-1,"modTurbo":false,"modAPlate":-1,"modEngine":-1,"modFender":-1,"modSeats":-1,"modEngineBlock":-1,"plateIndex":3}';
	
	$ferrari = json_decode($ferrarij, true);
	
	$letras = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $matricula='';
        $i=0;
		
        while($i<8){
            $posicion=rand(0,35);
            $matricula=$matricula.substr($letras,$posicion,1);
            $i++;
        }
		
	$ferrari['plate'] = $matricula;
	
	$ferrarij = json_encode($ferrari);
	
	$request = request_BD("INSERT INTO owned_vehicles (vehicle, owner, state,name) VALUES ('$ferrarij', '$steamid', 1,'CORVETTE')");



}

function dar_cochedisenador($steamid){
	
	$ferrarij = '{"modVanityPlate":-1,"modAerials":-1,"modAirFilter":-1,"modSteeringWheel":-1,"modSpeakers":-1,"modShifterLeavers":-1,"modTank":-1,"modLivery":-1,"modDial":-1,"modEngineBlock":-1,"modSmokeEnabled":false,"modAPlate":-1,"modFrontBumper":-1,"color1":64,"modRoof":-1,"modStruts":-1,"wheels":0,"modFender":-1,"modFrame":-1,"modDashboard":-1,"modExhaust":-1,"tyreSmokeColor":[255,255,255],"modTrunk":-1,"wheelColor":158,"modWindows":-1,"modSeats":-1,"modRightFender":-1,"windowTint":-1,"modSpoilers":-1,"modDoorSpeaker":-1,"modTrimA":-1,"modOrnaments":-1,"modHorns":-1,"neonEnabled":[false,false,false,false],"modBackWheels":-1,"modRearBumper":-1,"plateIndex":0,"modTurbo":false,"modHydrolic":-1,"dirtLevel":1.0,"modPlateHolder":-1,"modTrimB":-1,"modBrakes":-1,"modXenon":false,"modHood":-1,"color2":64,"modSideSkirt":-1,"modGrille":-1,"health":1000,"modFrontWheels":-1,"modSuspension":-1,"plate":"07AOG217","model":-119718915,"modEngine":-1,"neonColor":[255,0,255],"pearlescentColor":70,"modArchCover":-1,"modTransmission":-1,"modArmor":-1}';
	
	$ferrari = json_decode($ferrarij, true);
	
	$letras = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $matricula='';
        $i=0;
		
        while($i<8){
            $posicion=rand(0,35);
            $matricula=$matricula.substr($letras,$posicion,1);
            $i++;
        }
		
	$ferrari['plate'] = $matricula;
	
	$ferrarij = json_encode($ferrari);
	
	$request = request_BD("INSERT INTO owned_vehicles (vehicle, owner, state,name) VALUES ('$ferrarij', '$steamid', 1,'DESIGNCAR')");
	

	
	
}

function dar_coche_onyx($steamid){
	
	$ferrarij = '{"windowTint":-1,"neonEnabled":[false,false,false,false],"modSteeringWheel":-1,"modXenon":false,"modSeats":-1,"modSideSkirt":-1,"dirtLevel":2.0,"modGrille":-1,"modWindows":-1,"neonColor":[255,0,255],"modPlateHolder":-1,"modVanityPlate":-1,"modSmokeEnabled":false,"modSuspension":-1,"color2":120,"modEngineBlock":-1,"modLivery":-1,"modTransmission":-1,"modStruts":-1,"modEngine":-1,"modBackWheels":-1,"wheels":7,"modTrunk":-1,"modArmor":-1,"tyreSmokeColor":[255,255,255],"modFrame":-1,"modHorns":-1,"modOrnaments":-1,"modTurbo":false,"modSpeakers":-1,"modArchCover":-1,"modDial":-1,"color1":12,"health":1000,"modExhaust":-1,"modHydrolic":-1,"modRearBumper":-1,"plateIndex":3,"wheelColor":120,"modSpoilers":-1,"modDashboard":-1,"modRoof":-1,"modRightFender":-1,"modFrontBumper":-1,"modHood":-1,"modTank":-1,"modAPlate":-1,"modShifterLeavers":-1,"modTrimB":-1,"plate":"68HPK577","modFender":-1,"modBrakes":-1,"modTrimA":-1,"modAirFilter":-1,"modDoorSpeaker":-1,"modAerials":-1,"modFrontWheels":-1,"model":-449419902,"pearlescentColor":12}';
	
	$ferrari = json_decode($ferrarij, true);
	
	$letras = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $matricula='';
        $i=0;
		
        while($i<8){
            $posicion=rand(0,35);
            $matricula=$matricula.substr($letras,$posicion,1);
            $i++;
        }
		
	$ferrari['plate'] = $matricula;
	
	$ferrarij = json_encode($ferrari);
	
	$request = request_BD("INSERT INTO owned_vehicles (vehicle, owner, state,name) VALUES ('$ferrarij', '$steamid', 1,'ONYX')");
	

	
	
}

function dar_coche_atom($steamid){
	
	$ferrarij = '{"windowTint":-1,"neonEnabled":[false,false,false,false],"modSteeringWheel":-1,"modXenon":false,"modSeats":-1,"modSideSkirt":-1,"dirtLevel":7.0,"modGrille":-1,"modWindows":-1,"neonColor":[255,0,255],"modPlateHolder":-1,"modVanityPlate":-1,"modSmokeEnabled":false,"modSuspension":-1,"color2":28,"modEngineBlock":-1,"modLivery":-1,"modTransmission":-1,"modStruts":-1,"modEngine":-1,"modBackWheels":-1,"wheels":0,"modTrunk":-1,"modArmor":-1,"tyreSmokeColor":[255,255,255],"modFrame":-1,"modHorns":-1,"modOrnaments":-1,"modTurbo":false,"modSpeakers":-1,"modArchCover":-1,"modDial":-1,"color1":1,"health":1000,"modExhaust":-1,"modHydrolic":-1,"modRearBumper":-1,"plateIndex":4,"wheelColor":111,"modSpoilers":-1,"modDashboard":-1,"modRoof":-1,"modRightFender":-1,"modFrontBumper":-1,"modHood":-1,"modTank":-1,"modAPlate":-1,"modShifterLeavers":-1,"modTrimB":-1,"plate":"64IPC532","modFender":-1,"modBrakes":-1,"modTrimA":-1,"modAirFilter":-1,"modDoorSpeaker":-1,"modAerials":-1,"modFrontWheels":-1,"model":-1307793205,"pearlescentColor":1}';
	
	$ferrari = json_decode($ferrarij, true);
	
	$letras = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $matricula='';
        $i=0;
		
        while($i<8){
            $posicion=rand(0,35);
            $matricula=$matricula.substr($letras,$posicion,1);
            $i++;
        }
		
	$ferrari['plate'] = $matricula;
	
	$ferrarij = json_encode($ferrari);
	
	$request = request_BD("INSERT INTO owned_vehicles (vehicle, owner, state,name) VALUES ('$ferrarij', '$steamid', 1,'ATOM')");
	

	
	
}

function dar_coche_visiongt($steamid){
	
	$ferrarij = '{"dirtLevel":2.17422747612,"modAPlate":-1,"wheelColor":0,"modRearBumper":-1,"modSuspension":-1,"neonColor":[255,0,255],"modShifterLeavers":-1,"modTank":-1,"modEngine":-1,"modRoof":-1,"modDashboard":-1,"modTrimA":-1,"color2":140,"modAerials":-1,"modFrontWheels":-1,"modAirFilter":-1,"modTransmission":-1,"tyreSmokeColor":[255,255,255],"modArmor":-1,"modEngineBlock":-1,"modStruts":-1,"modGrille":-1,"modFrontBumper":-1,"modExhaust":-1,"modDoorSpeaker":-1,"modPlateHolder":-1,"model":913030392,"pearlescentColor":15,"modSpeakers":-1,"windowTint":-1,"modFrame":-1,"modDial":-1,"wheels":0,"modWindows":-1,"modVanityPlate":-1,"color1":16,"modHydrolic":-1,"modXenon":false,"neonEnabled":[false,false,false,false],"plate":"22CTR087","modArchCover":-1,"modTurbo":false,"modHood":-1,"modSideSkirt":-1,"modRightFender":-1,"modSpoilers":-1,"modBackWheels":-1,"modSmokeEnabled":1,"modSeats":-1,"modTrimB":-1,"modBrakes":-1,"modFender":-1,"modLivery":-1,"modSteeringWheel":-1,"modTrunk":-1,"modOrnaments":-1,"plateIndex":4,"modHorns":-1,"health":1000}';
	
	$ferrari = json_decode($ferrarij, true);
	
	$letras = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $matricula='';
        $i=0;
		
        while($i<8){
            $posicion=rand(0,35);
            $matricula=$matricula.substr($letras,$posicion,1);
            $i++;
        }
		
	$ferrari['plate'] = $matricula;
	
	$ferrarij = json_encode($ferrari);
	
	$request = request_BD("INSERT INTO owned_vehicles (vehicle, owner, state,name) VALUES ('$ferrarij', '$steamid', 1,'VISIONGT')");
	

	
	
}



function dar_coche_buggati_veyron($steamid){
	
	$ferrarij = '{"dirtLevel":2.17422747612,"modAPlate":-1,"wheelColor":0,"modRearBumper":-1,"modSuspension":-1,"neonColor":[255,0,255],"modShifterLeavers":-1,"modTank":-1,"modEngine":-1,"modRoof":-1,"modDashboard":-1,"modTrimA":-1,"color2":140,"modAerials":-1,"modFrontWheels":-1,"modAirFilter":-1,"modTransmission":-1,"tyreSmokeColor":[255,255,255],"modArmor":-1,"modEngineBlock":-1,"modStruts":-1,"modGrille":-1,"modFrontBumper":-1,"modExhaust":-1,"modDoorSpeaker":-1,"modPlateHolder":-1,"model":-1444047101,"pearlescentColor":15,"modSpeakers":-1,"windowTint":-1,"modFrame":-1,"modDial":-1,"wheels":0,"modWindows":-1,"modVanityPlate":-1,"color1":16,"modHydrolic":-1,"modXenon":false,"neonEnabled":[false,false,false,false],"plate":"22CTR087","modArchCover":-1,"modTurbo":false,"modHood":-1,"modSideSkirt":-1,"modRightFender":-1,"modSpoilers":-1,"modBackWheels":-1,"modSmokeEnabled":1,"modSeats":-1,"modTrimB":-1,"modBrakes":-1,"modFender":-1,"modLivery":-1,"modSteeringWheel":-1,"modTrunk":-1,"modOrnaments":-1,"plateIndex":4,"modHorns":-1,"health":1000}';
	
	$ferrari = json_decode($ferrarij, true);
	
	$letras = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $matricula='';
        $i=0;
		
        while($i<8){
            $posicion=rand(0,35);
            $matricula=$matricula.substr($letras,$posicion,1);
            $i++;
        }
		
	$ferrari['plate'] = $matricula;
	
	$ferrarij = json_encode($ferrari);
	
	$request = request_BD("INSERT INTO owned_vehicles (vehicle, owner, state,name) VALUES ('$ferrarij', '$steamid', 1,'BUGATTI')");
	

	
	
}

function dar_coche_tesla($steamid){
	
	$ferrarij = '{"dirtLevel":2.17422747612,"modAPlate":-1,"wheelColor":0,"modRearBumper":-1,"modSuspension":-1,"neonColor":[255,0,255],"modShifterLeavers":-1,"modTank":-1,"modEngine":-1,"modRoof":-1,"modDashboard":-1,"modTrimA":-1,"color2":140,"modAerials":-1,"modFrontWheels":-1,"modAirFilter":-1,"modTransmission":-1,"tyreSmokeColor":[255,255,255],"modArmor":-1,"modEngineBlock":-1,"modStruts":-1,"modGrille":-1,"modFrontBumper":-1,"modExhaust":-1,"modDoorSpeaker":-1,"modPlateHolder":-1,"model":784906648,"pearlescentColor":15,"modSpeakers":-1,"windowTint":-1,"modFrame":-1,"modDial":-1,"wheels":0,"modWindows":-1,"modVanityPlate":-1,"color1":16,"modHydrolic":-1,"modXenon":false,"neonEnabled":[false,false,false,false],"plate":"22CTR087","modArchCover":-1,"modTurbo":false,"modHood":-1,"modSideSkirt":-1,"modRightFender":-1,"modSpoilers":-1,"modBackWheels":-1,"modSmokeEnabled":1,"modSeats":-1,"modTrimB":-1,"modBrakes":-1,"modFender":-1,"modLivery":-1,"modSteeringWheel":-1,"modTrunk":-1,"modOrnaments":-1,"plateIndex":4,"modHorns":-1,"health":1000}';
	
	$ferrari = json_decode($ferrarij, true);
	
	$letras = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $matricula='';
        $i=0;
		
        while($i<8){
            $posicion=rand(0,35);
            $matricula=$matricula.substr($letras,$posicion,1);
            $i++;
        }
		
	$ferrari['plate'] = $matricula;
	
	$ferrarij = json_encode($ferrari);
	
	$request = request_BD("INSERT INTO owned_vehicles (vehicle, owner, state,name) VALUES ('$ferrarij', '$steamid', 1,'TESLA')");
	

	
	
}

function dar_coche_tr22($steamid){
	
	$ferrarij = '{"dirtLevel":2.17422747612,"modAPlate":-1,"wheelColor":0,"modRearBumper":-1,"modSuspension":-1,"neonColor":[255,0,255],"modShifterLeavers":-1,"modTank":-1,"modEngine":-1,"modRoof":-1,"modDashboard":-1,"modTrimA":-1,"color2":140,"modAerials":-1,"modFrontWheels":-1,"modAirFilter":-1,"modTransmission":-1,"tyreSmokeColor":[255,255,255],"modArmor":-1,"modEngineBlock":-1,"modStruts":-1,"modGrille":-1,"modFrontBumper":-1,"modExhaust":-1,"modDoorSpeaker":-1,"modPlateHolder":-1,"model":-784906648,"pearlescentColor":15,"modSpeakers":-1,"windowTint":-1,"modFrame":-1,"modDial":-1,"wheels":0,"modWindows":-1,"modVanityPlate":-1,"color1":16,"modHydrolic":-1,"modXenon":false,"neonEnabled":[false,false,false,false],"plate":"22CTR087","modArchCover":-1,"modTurbo":false,"modHood":-1,"modSideSkirt":-1,"modRightFender":-1,"modSpoilers":-1,"modBackWheels":-1,"modSmokeEnabled":1,"modSeats":-1,"modTrimB":-1,"modBrakes":-1,"modFender":-1,"modLivery":-1,"modSteeringWheel":-1,"modTrunk":-1,"modOrnaments":-1,"plateIndex":4,"modHorns":-1,"health":1000}';
	
	$ferrari = json_decode($ferrarij, true);
	
	$letras = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $matricula='';
        $i=0;
		
        while($i<8){
            $posicion=rand(0,35);
            $matricula=$matricula.substr($letras,$posicion,1);
            $i++;
        }
		
	$ferrari['plate'] = $matricula;
	
	$ferrarij = json_encode($ferrari);
	
	$request = request_BD("INSERT INTO owned_vehicles (vehicle, owner, state,name) VALUES ('$ferrarij', '$steamid', 1,'CALIFORNIA')");
	

	
	
}


function dar_coche_huracan($steamid){
	
	$ferrarij = '{"dirtLevel":2.17422747612,"modAPlate":-1,"wheelColor":0,"modRearBumper":-1,"modSuspension":-1,"neonColor":[255,0,255],"modShifterLeavers":-1,"modTank":-1,"modEngine":-1,"modRoof":-1,"modDashboard":-1,"modTrimA":-1,"color2":140,"modAerials":-1,"modFrontWheels":-1,"modAirFilter":-1,"modTransmission":-1,"tyreSmokeColor":[255,255,255],"modArmor":-1,"modEngineBlock":-1,"modStruts":-1,"modGrille":-1,"modFrontBumper":-1,"modExhaust":-1,"modDoorSpeaker":-1,"modPlateHolder":-1,"model":-986029580,"pearlescentColor":15,"modSpeakers":-1,"windowTint":-1,"modFrame":-1,"modDial":-1,"wheels":0,"modWindows":-1,"modVanityPlate":-1,"color1":16,"modHydrolic":-1,"modXenon":false,"neonEnabled":[false,false,false,false],"plate":"22CTR087","modArchCover":-1,"modTurbo":false,"modHood":-1,"modSideSkirt":-1,"modRightFender":-1,"modSpoilers":-1,"modBackWheels":-1,"modSmokeEnabled":1,"modSeats":-1,"modTrimB":-1,"modBrakes":-1,"modFender":-1,"modLivery":-1,"modSteeringWheel":-1,"modTrunk":-1,"modOrnaments":-1,"plateIndex":4,"modHorns":-1,"health":1000}';
	
	$ferrari = json_decode($ferrarij, true);
	
	$letras = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $matricula='';
        $i=0;
		
        while($i<8){
            $posicion=rand(0,35);
            $matricula=$matricula.substr($letras,$posicion,1);
            $i++;
        }
		
	$ferrari['plate'] = $matricula;
	
	$ferrarij = json_encode($ferrari);
	
	$request = request_BD("INSERT INTO owned_vehicles (vehicle, owner, state,name) VALUES ('$ferrarij', '$steamid', 1,'HURACAN')");
	

	
	
}

?>