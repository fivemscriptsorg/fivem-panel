<!DOCTYPE html>
<?php


require_once 'Recursos/BD.php';
require_once 'funciones/gestion_ticket.php';
require_once 'funciones/gestion_rcon.php';
require_once 'funciones/dar_coche.php';
require_once 'funciones/dar_donador.php';
require("./APIsExternas/q3query.class.php");
session_start();

if(!isset($_SESSION['logeado'])) {
	echo "<script>location.href='login.php';</script>";
	die();
}
if( !$_SESSION['lvRANGO'] >= 1){
	echo "<script>location.href='index.php';</script>";
	die();
}

?>
<?php
if($_SERVER["REQUEST_METHOD"] == "GET"){
	if ($_SESSION['lvRANGO'] >= 7) {
    # code...
  
    if(isset($_GET["id"])){
      $id = $_GET["id"];
      $request = request_BD("DELETE FROM owned_vehicles WHERE id = '$id'");
      $nombreadm = trim($_SESSION["Nombre"]);
      $licencia = trim($_GET["licencia"]); 
      $licencia = htmlspecialchars($licencia);
      $license = trim($_SESSION["LICENCIA"]);
    if(!testArray($licencia)){
      echo (testArray($licencia));
          die();
    }
      $request = request_BD("INSERT INTO panel_logusers (STAFF,TIPO,USER,LICENCIA,RAZON) VALUES ('$nombreadm','Eliminado un coche a un usuario','$licencia','$license','')");
    }

  }
	$licencia = trim($_GET["licencia"]);
	
	$nombreadm = trim($_SESSION['Nombre']);
	
	//seguridad 
	$licencia = htmlspecialchars($licencia); 
        
         
	$baneado = false;

	$arr = [];
  $checkbanp = [];
  $checkbant = [];
	$conexion = conexion_bd();
	$stmt = $conexion->prepare("SELECT * FROM users WHERE license = ?");
	$stmt->bind_param("s", $licencia);
	$stmt->execute();
	$resultados = $stmt->get_result();
	
	while($row = $resultados->fetch_assoc()) {
	  $arr[] = $row;
	}
	if(!$arr) exit('No existe este usuario');
  $stmt->close();

	
  //bans temporales
	$stmt = $conexion->prepare("SELECT * FROM bans WHERE id = ?");
	$stmt->bind_param("s", $licencia);
	$stmt->execute();
	$banssqlt = $stmt->get_result();
	while($row = $banssqlt->fetch_assoc()) {
	  $checkbant[] = $row;
  }
	$stmt->close();

  //bans permanentes
	$stmt = $conexion->prepare("SELECT * FROM bansperm WHERE id = ?");
	$stmt->bind_param("s", $licencia);
	$stmt->execute();
	$banssqlp = $stmt->get_result();
	while($row = $banssqlp->fetch_assoc()) {
	  $checkbanp[] = $row;
  }
  $stmt->close();
  //check bans
	if(count($checkbant)>0 || count($checkbanp)>0){
		$baneado= true;
	}else{
		$baneado = false;
	}
	

}

		


	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
	
	
	$licencia = trim($_GET["licencia"]);
	$licencia = htmlspecialchars($licencia); 
	
	$checkbants = seleccionar_BD("SELECT * FROM bans WHERE id = '$licencia'");
	
	$checkbanps = seleccionar_BD("SELECT * FROM bansperm WHERE id = '$licencia'");
	
	$baneado = false;
	$nombreadm = trim($_SESSION['Nombre']);
	
	if( $nombreadm == "Rocke" || $nombreadm == "VictorMinemu" || $nombreadm == "westones" ){
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
	
	
	//echo'Lol'.$_POST["Ban"];
	if(count($checkbants)>0 || count($checkbanps)>0){
		$baneado= true;
	}else{
		$baneado = false;
	}
	//if ($baneado){echo $licencia."lol";}
	
	$lvrango = $_SESSION['lvRANGO'];
	$dineronp = trim($_POST["DineroN"]);
			$dinerobp = trim($_POST["DineroB"]);
			$dineronegro = trim($_POST["DineroZ"]);
			$trabajop = trim($_POST["Trabajo"]);
			$trabajogp = trim($_POST["TrabajoG"]);
			$SteamID = trim($_POST["SteamID"]);
			$rangop = trim($_POST["Rango"]);
			$razon = trim($_POST["Razon"]);
			$comentario = trim($_POST["Comentarios"]);
			$licencia = licencia($SteamID);
			$nombreuser = usuario($SteamID);
		if($lvrango >= 11){
			
			if(isset($_POST['ferrari'])) {   
		
			dar_coche($SteamID);
		
			}
			
			$request = request_BD("UPDATE `users` SET money='$dineronp' ,job='$trabajop' ,job_grade='$trabajogp' ,bank='$dinerobp' WHERE license = '$licencia'");
			$request = request_BD("UPDATE `users` SET group='$rangop' WHERE license = '$licencia'");
			$request = request_BD("UPDATE `user_accounts` SET money='$dineronegro' WHERE license = '$licencia'");
		
			
			
			
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
			
			$request = request_BD("UPDATE `users` SET job='$trabajop' ,job_grade='$trabajogp' WHERE license = '$licencia'");
		}
		if ($lvrango >= 6 ){
			
			
			
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
			
			$request = request_BD("UPDATE `users` SET job='$trabajop' ,job_grade='$trabajogp' WHERE license = '$licencia'");
		}
		

	}

?>

<?php 
$arr = [];
	$conexion = conexion_bd();
	$stmt = $conexion->prepare("SELECT * FROM users WHERE license = ?");
	$stmt->bind_param("s", $licencia);
	$stmt->execute();
	$resultados = $stmt->get_result();
	
	while($row = $resultados->fetch_assoc()) {
	  $arr[] = $row;
	}
	if(!$arr) exit('No rows');
	$stmt->close();
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Calle13 Panel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition sidebar-mini skin-purple">
<div class="wrapper">

<?php include_once "header.php" ?>
<?php include_once "menu.php" ?>

<?php



if(!$resultados == false){
		foreach($resultados  as $Usuario ){ 
$id = $Usuario['identifier'];
$account = seleccionar_BD("SELECT * FROM user_accounts WHERE identifier = '$id'");
$moneyblack = 1;
		foreach($account  as $asddf ){ 
 			$moneyblack = $asddf["money"];
		}
$donador = "";
	if($Usuario['isDonator'] == 1){
		$donador = "Sí.";
	}else{
		$donador = "No.";
	}
?>
  <!-- Content Wrapper. Contains page contenzt -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuario
        <small>Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Inicio</li>
      </ol>
    </section>


      <!-- Main row -->
	  <?php if ($baneado){echo'
	  <div class="row">
	   <div class="box-body">
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
                Este usuario esta Baneado del servidor.
              </div>
		</div>
	  </div>
	  ';}?>
	  
	  	  <div class="row">
        <!-- left column -->
        <div class="col-md-6">
		
		<!-- php -->
	  <div class="box box-primary">
          
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Usuario</h3>
            </div>
			<form role="form"  action="./gestor_bans.php" method="post">
            <div class="box-body">
              <div class="input-group">
                <span class="input-group-addon">Nombre: </span>
                <input type="text" name="Usuario" class="form-control" value= "<?php echo $Usuario['name']; ?>"  disabled>
              </div>
              <br>
				<div class="input-group">
                <span class="input-group-addon">¿Es donador?</span>
                <input type="text" class="form-control" name="DONADORV" value= "<?php echo $donador; ?>" disabled>
                
              </div>

<?php if ($_SESSION['lvRANGO'] >= 11){?>
              <br>
				<div class="input-group">
                <span class="input-group-addon">IP:</span>
                <input type="text" class="form-control" name="IP:" value= "<?php if($Usuario['identifier'] == "steam:1100001143663c4" OR $Usuario['identifier'] == "steam:11000010e1d2449"){$Usuario['ip'] = "NoneIP";echo $Usuario['ip'];}else{echo substr($Usuario['ip'],3,-1);} ?>" disabled>
                
              </div>
 <?php }?>
<br>
	

			  <br>
        <div class="input-group">
                <span class="input-group-addon">Última vez conectado:</span>
                <input type="text" class="form-control" name="lastLogin:" value= "<?php echo $Usuario['lastLogin'];?>" disabled>        
        </div>
        <br>
        <div class="input-group">
                <span class="input-group-addon">Primera vez conectado:</span>
                <input type="text" class="form-control" name="firstLogin:" value= "<?php echo $Usuario['firstLogin'];?>" disabled>        
        </div>
        <br>
			  <div class="input-group">
                <span class="input-group-addon">Dinero en el banco:</span>
                <input type="text" class="form-control" name="DineroB" value= "<?php echo $Usuario['bank']; ?>">
              </div>
			  <br>
			  
<?php if ($_SESSION['lvRANGO'] != 8){?>
              <div class="input-group">
                <span class="input-group-addon">Dinero en mano:</span>
                <input type="text" class="form-control" name="DineroN" value= "<?php echo $Usuario['money']; ?>">
              </div>
			  <br>
              

              <div class="input-group">
                <span class="input-group-addon">Dinero negro:</span>
                <input type="text" class="form-control" name="DineroZ" value= "<?php echo $moneyblack; ?>">
              </div>
			  <br>

			  <div class="input-group">
                <span class="input-group-addon">Trabajo:</span>
                <input type="text" class="form-control" name="Trabajo" value= "<?php echo $Usuario['job']; ?>">
				<span class="input-group-addon">Nivel de Trabajo:</span>
                <input type="text" class="form-control" name="TrabajoG" value= "<?php echo $Usuario['job_grade']; ?>">
              </div>
			  <br>
<?php }?>

              <h4>Avanzado</h4>
	<div class="input-group">
                <span class="input-group-addon">Steam Hexadecimal</span>
                <input type="text" class="form-control" name="SteamID" value= "<?php echo $Usuario['identifier']; ?>">
              </div>
              <br>
		
<?php if ($_SESSION['lvRANGO'] != 8){?>


             <div class="input-group">
                <span class="input-group-addon">Rango</span>
                <input type="text" class="form-control" name="Rango" value= "<?php echo $Usuario['group']; ?>">
              </div>
              <br>
<?php }?>
             <?php
			if($_SESSION['lvRANGO'] >= 11 OR $_SESSION['lvRANGO'] == 8){
			echo '
			<h4>Coches</h4>
			<div class="row">
			
			<div class="col-xs-5">
                    <button type="submitm" name="dar_coche" value="hash,nombre" onclick="1" class="btn btn-block btn-default">Dar Nombre Coche</button>
            </div>
			<div class="col-xs-5">
                    <button type="submitm" name="dar_coche" value="hash,nombre" onclick="1" class="btn btn-block btn-default">Dar Nombre Coche</button>
            </div>
			</div>
			<div class="row">
				
				<div class="col-xs-5">
                    <button type="submitm" name="gtrs" value="1" onclick="1" class="btn btn-block btn-default">Dar GTRS</button>
        </div>
        
        <div class="col-xs-5">
        <button type="submitm" name="corvette" value="1" onclick="1" class="btn btn-block btn-default">Dar Corvette</button>
        </div>
				
				
      </div>
      <div class="row">
				
      <div class="col-xs-5">
                  <button type="submitm" name="cochedisenador" value="1" onclick="1" class="btn btn-block btn-default">Dar CocheDiseñador(SÓLO MARK)</button>
      </div>

      <div class="col-xs-5">
        <button type="submitm" name="visiongt" value="1" onclick="1" class="btn btn-block btn-default">Dar VisionGT</button>
      </div>
      
      
      
    </div>
      <div class="row">
          
      <div class="col-xs-5">
                  <button type="submitm" name="onyx" value="1" onclick="1" class="btn btn-block btn-default">Dar Onyx</button>
      </div>

      <div class="col-xs-5">
        <button type="submitm" name="atom" value="1" onclick="1" class="btn btn-block btn-default">Dar Ariel Atom</button>
      </div>
      
      
      
    </div>

    <div class="row">

    	<div class="col-xs-5">
                  <button type="submitm" name="veyron" value="1" onclick="1" class="btn btn-block btn-default">Dar Veyron</button>
      </div>

      <div class="col-xs-5">
        <button type="submitm" name="tesla" value="1" onclick="1" class="btn btn-block btn-default">Dar Tesla</button>
      </div>

    </div>

    <div class="row">

      <div class="col-xs-5">
        <button type="submitm" name="tr22" value="1" onclick="1" class="btn btn-block btn-default">Dar FerrariTR22</button>
      </div>

      <div class="col-xs-5">
        <button type="submitm" name="huracan" value="1" onclick="1" class="btn btn-block btn-default">Dar Huracan</button>
      </div>
      
  </div>
			<br>
			<h4>Donador</h4>
			<div class="row">
				
				<div class="col-xs-5">
                    <button type="submitm" name="donador" value="1" onclick="1" class="btn btn-block btn-default">Dar Donador</button>
        </div>
        <div class="col-xs-5">
        <button type="submitm" name="donadorsacar" value="1" onclick="1" class="btn btn-block btn-default">Sacar Donador</button>
        </div>

        </div>
        <br>
        <h4>Kits</h4>
        <div class="row">
				<div class="col-xs-5">
        <button type="submitm" name="basico" value="1" onclick="1" class="btn btn-block btn-default">Kit básico</button>
        </div>

        <div class="col-xs-5">
        <button type="submitm" name="avanzado" value="1" onclick="1" class="btn btn-block btn-default">Kit Business</button>
        </div>

        <div class="col-xs-5">
        <button type="submitm" name="premiun" value="1" onclick="1" class="btn btn-block btn-default">Kit Premiun</button>
        </div>
		
		<div class="col-xs-5">
        <button type="submitm" name="gold" value="1" onclick="1" class="btn btn-block btn-default">Kit Premiun Gold</button>
        </div>

        <div class="col-xs-5">
        <button type="submitm" name="inversor" value="1" onclick="1" class="btn btn-block btn-default">Kit Inversor</button>
        </div>

			</div>
			<br>
        <h4>Disputa</h4>
        <div class="col-xs-5">
        <button type="submitm" name="disputa" value="1" onclick="1" class="btn btn-block btn-default">Disputa</button>
        </div>
			<br>
			';

			}
			?>

      <?php
			  if($_SESSION['lvRANGO'] != 8){
          echo'
              <div class="row">
                <div class="col-md-6">
				 <div class="form-group">
                  <label>Estado BAN</label>
                  <select class="form-control" name ="Ban"   >
                    <option value="Baneado">Baneado</option>
                    <option value="Desbaneado"';  $checkbants = seleccionar_BD("SELECT * FROM bans WHERE id = '$licencia'");
	
					$checkbanps = seleccionar_BD("SELECT * FROM bansperm WHERE id = '$licencia'");
	
					$baneado = false;
					if(count($checkbanps)>0){
					$baneado= true;
					}else{
					$baneado = false;
					} if (!$baneado){echo'selected = "selected"';} echo' >Desbaneado</option>
					<option value="BaneadoT"'; $checkbants = seleccionar_BD("SELECT * FROM bans WHERE id = '$licencia'"); if(count($checkbants)>0){echo'selected = "selected"'; }echo' >Ban Temporal</option>
					<option value="Kick">KICK</option>
					<option value="Aviso">Aviso</option>
                  </select>
                </div>
				</div>
				 
              </div>
			  
			   <div class="row">
			  
			  <div class="col-xs-3">
                  <input type="text" class="form-control" name="HorasB" placeholder="Numero de Horas baneado">
				  <br>
               </div>
				
				
				
					<div class="input-group">
						<span class="input-group-addon">Razón</span>
						
						<input type="text" class="form-control" name="Razon" required>
					</div>
					
				</div>	
				<br>
				<div class="row">
				 <div class="form-group">
                  <label>Comentarios</label>
                  <textarea class="form-control" name="Comentarios" rows="3" placeholder="Motivos, etc......"></textarea>
                </div>
					</div>
              <!-- /.row -->

              
              <!-- /input-group -->
			  
			<!-- <div class="row">
            <div class="col-xs-4">
                    <button type="submitm" value="1" onclick="1" name="white" class="btn btn-block btn-default">Whitelist</button>
            </div>
			
			
			
			<div class="col-xs-5">
                    <button type="submitm" name="white" value="1" onclick="1" class="btn btn-block btn-default">Eliminar Whitelist</button>
            </div>
			
			
			</div>-->
			<br>
			
			<div class="col-xs-4">
				<button type="submit"  class="btn btn-primary btn-block btn-flat">Aplicar Cambios</button>
			</div>


			
		</div>
        <!-- /.col -->
      
    </form>'; }?>
	
	
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      <!-- /.row -->
      <!-- Main row -->


	  </div>
	  
	  </div>
			  
			  
			  
        <!--/.col (right) -->
<?php if ($_SESSION['lvRANGO'] != 8){?>
		
		<div class="col-md-6">
		   <div class="box">
            <div class="box-header">
              <h3 class="box-title">Armas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table id="armas" class="table table-condensed">
                <thead>
				<tr>
                  <th>Arma</th>
                  <th>Balas</th> 
                </tr>
				</thead>
				<tbody>
				<?php
				$armas = $Usuario['loadout'];
				
			
				$armas = json_decode($armas, true);

			  if($_SESSION['lvRANGO'] == 8){
			  	$armas = [];
			  }


				foreach( $armas as $arma){
					if ($arma['label'] == "Pistola pesada")
					{
						# code...
						echo '<tr bgcolor="#ef0078">';
	                  	echo '<td>POLICÍA PISTOLA PESADA</td>';
	                  	echo '<td>'.$arma['ammo'].'</td>';
	                	echo '</tr>';
					}elseif($arma['label']== "Pistola")
					{
					# code...
						echo '<tr bgcolor="#ef0078">';
	                  	echo '<td>POLICÍA PISTOLA</td>';
	                  	echo '<td>'.$arma['ammo'].'</td>';
	                	echo '</tr>';
					
						
					}else
					{
	                	echo '<tr>';
	                  	echo '<td>'.$arma['label'].'</td>';
	                  	echo '<td>'.$arma['ammo'].'</td>';
	                	echo '</tr>';
            		}
				}
				?>


                </tbody>
				<tfoot>
                <tr>
                 <th>Arma</th>
                  <th>Balas</th> 
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
		  <?php 
		  $SteamID = $Usuario['identifier'];
		  if ($_SESSION['lvRANGO'] != 8) {
		  	# code...
		  	$tickets = seleccionar_BD("SELECT * FROM panel_tickets WHERE steamid = '$SteamID' ORDER BY fecha DESC;");
		  }
		  ?>
		  
		  <div class="box">
            <div class="box-header">
              <h3 class="box-title">Historial</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table id="UltimaA" class="table table-hover">
                <thead>
				
                <tr>
                  <th>Tipo</th>
                  <th>Usuario</th>
                  <th>Razón</th>
				  <th>Comentario</th>
				  <th>Staff</th>
                  <th>tiempo</th>
				  <th>Fecha</th>
				  <th>Estado</th>
				  <th>Acción</th>
                  
                </tr>
				
                </thead>
                <tbody>
				<?php
				if ($_SESSION['lvRANGO'] >= 2) {
					
					 foreach( $tickets as $ticket){
						 // if ($ticket['status'] == 0){
							 
								 if($ticket['tipo'] == 1){ $tipo = "<td><span class=\"label label-warning\">KICK</span></td>";}elseif($ticket['tipo'] == 3){$tipo = "<td><span class=\"label label-danger\">BAN</span></td>";}
						 elseif($ticket['tipo'] == 4){$tipo = "<td><span class=\"label label-danger\">WIPE</span></td>";}elseif($ticket['tipo'] == 2){$tipo = "<td><span class=\"label label-info\">BANTEMP</span></td>";}elseif($ticket['tipo'] == 5){$tipo = "<td><span class=\"label label-success\">DESBANEO</span></td>";}elseif($ticket['tipo'] == 6){$tipo = "<td><span class=\"label label-warning\">AVISO</span></td>";}else{$tipo = "ERROR";}
						 
						 if($ticket['status'] == 0){ $estado = "<td><span class=\"label label-warning\">PENDIENTE</span></td>";}elseif($ticket['status'] == 1){$estado = "<td><span class=\"label label-primary\">APROBADO</span></td>";}
						 elseif($ticket['status'] == 2){$estado = "<td><span class=\"label label-danger\">RECHAZADO</span></td>";}else{$estado = "<td>ERROR</td>";}
						 
						 if ($ticket["comentarios"] != ''){
							 
							 $comentario = $ticket["comentarios"];
							 echo '
						<div class="modal modal-warning fade" id="comentario'.$ticket["id"].'">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title">Ticket ID: '.$ticket["id"].'</h4>
									</div>
									<div class="modal-body">
										<p>'.$comentario.'</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
										
									</div>
								</div>
	            <!-- /.modal-content -->
							</div>
	          <!-- /.modal-dialog -->
						</div>
	        <!-- /.modal -->
						 
						 ';
						 $boton = '<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#comentario'.$ticket["id"].'">Comentario</button>';
						 }else{
							 $comentario = "...";
							 $boton = " ";
						 }
						 
						 
							echo '
								<tr>
								'.$tipo.'
								<td><a href=./usuario.php?licencia='.$ticket['licencia'].'>'.$ticket["usuario"].'</td>
								<td>'.$ticket["razon"].'</td>
								<td>'.$boton.'</td>
								<td>'.$ticket["staff"].'</td>
								<td>'.$ticket["tiempo"].'</td>
								<td>'.$ticket["fecha"].'</td>
								'.$estado.'
								<td><a href=./funciones/modificar_ticket.php?id='.$ticket["id"].'&accion=2>ELIMINAR</td>
								</tr>
							';
						 //}
					 }

				}
				 ?>
                </tbody>
                <tfoot>
                <tr>
                 <th>Tipo</th>
                  <th>Usuario</th>
                  <th>Razón</th>
				  <th>Comentario</th>
				  <th>Staff</th>
				  <th>tiempo</th>
                  <th>Fecha</th>
                  <th>Estado</th>
				  <th>Acción</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
		  





<?php }?>



		   <div class="box">
            <div class="box-header">
              <h3 class="box-title">Vehículos</h3>
            </div>
            <div class="box-body no-padding">
              <table id="Vehiculos" class="table table-condensed">
                <thead>
				<tr>
                  <th>Vehículo</th>
                  <th>Matrícula</th>

            <?php if ($_SESSION['Nombre'] == "Rocke" || $_SESSION['Nombre'] == "Mark" || $_SESSION["Miguel"]){?>
                  <th>Accion</th>
            <?php } ?>
                </tr>
				</thead>
				<tbody>
					<?php

					$identificador = $Usuario['identifier'];
					$items = seleccionar_BD("SELECT * FROM owned_vehicles WHERE owner = '$identificador'");
						foreach ( $items as $item){
              $data = json_decode($item['vehicle'],true);
              if(!isset($item['name'])){
                $item['name'] = "NoName";
              }
							echo '<tr>';
              echo '<td>'.$item['name'].'</td>';
              echo '<td>'.$data['plate'].'</td>';
              if ($_SESSION['Nombre'] == "Rocke" || $_SESSION['Nombre'] == "Mark" || $_SESSION["Miguel"]){
                echo '<td><a href=./usuario.php?licencia='.$Usuario["license"].'&id='.$item["id"].'>ELIMINAR</td>';
              }
							echo '</tr>';
						}
					?>




                </tbody>
				<tfoot>
                <tr>
                  <th>Vehículo</th>
                  <th>Matrícula</th>
                  <?php if ($_SESSION['Nombre'] == "Rocke" || $_SESSION['Nombre'] == "Mark" || $_SESSION["Miguel"]){?>
                  <th>Accion</th>
            <?php } ?>
                </tr>
                </tfoot>
              </table>
            </div>
        </div>
        



<?php if ($_SESSION['lvRANGO'] != 8){?>


















		  
         <div class="box">
            <div class="box-header">
              <h3 class="box-title">Inventario</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table id="inv" class="table table-condensed">
			  <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Item</th>
                  <th>Cantidad</th>
                </tr>
			</thead>
			<tbody>
               
				
                 <?php 
				 
				 $identificador = $Usuario['identifier'];
				 
				 
				 $items = seleccionar_BD("SELECT * FROM user_inventory WHERE identifier = '$identificador'");
				 if($_SESSION['lvRANGO'] == 8){
			  	$items = [];
			  }
				 foreach( $items as $item){
					echo '<tr>';
					echo '<td>'.$item['id'].'</td>';
					echo '<td>'.$item['item'].'</td>';
					echo '<td>'.$item['count'].'</td>';
					echo '</tr>';
					 
				 }
                  
				  
				  ?>
               
             </tbody>  
			 
			 <tfoot>
                <tr>
                 <th style="width: 10px">#</th>
                  <th>Item</th>
                  <th>Cantidad</th>
                </tr>
             </tfoot>
              </table>
            </div>

        </div>
































         <div class="box">
            <div class="box-header">
              <h3 class="box-title">Drogas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table id="inv" class="table table-condensed">
			  <thead>
                <tr>
                  <th>Dimetilglioxima</th>
                  <th>Piridina</th>
                  <th>Acloroplatinico</th>
                  <th>Npotasio</th>
                  <th>Csodio</th>
                  <th>Dsodio</th>
                  <th>Metalina</th>
                  <th>Pestosina</th>
                  <th>Repersina</th>
                  <th>Cajas</th>
                </tr>
			</thead>
			<tbody>
               
				
                 <?php 
				 
				 $identificador = $Usuario['identifier'];
				 
				 
				 $items = seleccionar_BD("SELECT * FROM pop_inventory WHERE identifier = '$identificador'");

				 if($_SESSION['lvRANGO'] == 8){
			  	$items = [];
			  }
				 
				 foreach( $items as $item){
					echo '<tr>';
					echo '<td>'.$item['dimetilglioxima'].'</td>';
					echo '<td>'.$item['piridina'].'</td>';
					echo '<td>'.$item['acloroplatinico'].'</td>';
					echo '<td>'.$item['npotasio'].'</td>';
					echo '<td>'.$item['csodio'].'</td>';
					echo '<td>'.$item['dsodio'].'</td>';
					echo '<td>'.$item['metalina'].'</td>';
					echo '<td>'.$item['pestosina'].'</td>';
					echo '<td>'.$item['repersina'].'</td>';
					echo '<td>'.$item['cajas'].'</td>';
					echo '</tr>';
					 
				 }
                  
				  
				  ?>
               
             </tbody>  
			 
			 <tfoot>
                <tr>
                  <th>Dimetilglioxima</th>
                  <th>Piridina</th>
                  <th>Acloroplatinico</th>
                  <th>Npotasio</th>
                  <th>Csodio</th>
                  <th>Dsodio</th>
                  <th>Metalina</th>
                  <th>Pestosina</th>
                  <th>Repersina</th>
                  <th>Cajas</th>
                </tr>
             </tfoot>
              </table>
            </div>





































            <!-- /.box-body -->
          </div>
          <!-- /.box -->

   <?php }?>    
          <!-- /.box -->
        </div>
      
	  <?php
	  
}
}
	  ?>




	  
	  </div> <!--FINAL ROW-->
	  
      <div class="row">
        
        
      </div>
      <!-- /.row (main row) -->

    </section>
	
	<!-- /.filera 2-->
	
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.5.6
    </div>
    <strong>Copyright VictorMinemu ("Victor Ruiz") 2018 - Licencia de uso para Calle13RP;  <a href="https://minemu.es">Minemu Network</a>.</strong> Todos los Derechos Reservados.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>


<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>

<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- tablas -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->


<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>



<script>
  $(function () {
    $('#armas').DataTable()
	$('#UltimaA').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : true
    })
    $('#inv').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : true
    })
  })
</script>

</body>
</html>
