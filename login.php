<?php

require_once 'Recursos/BD.php';
require_once 'api.php';
 
session_start();

$usuario = $pass = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(true) {
	   if(empty(trim($_POST["usuario"]))){
        $msgerror_u = 'Introduzca un usuario.';
    } else{
        $usuario = trim($_POST["usuario"]);
    }
	
	if(empty(trim($_POST['pass']))){
        $msgerror_p = 'Introduzca una contraseña.';
    } else{
        $pass = hash("sha256", trim($_POST['pass']));
    }

	$conexion = conexion_bd();
	$stmt = $conexion->prepare("SELECT * FROM panel_users WHERE USUARIO = ? AND PASS = ?");
	$stmt->bind_param("ss", $usuario, $pass);
	$stmt->execute();
	$resultados = $stmt->get_result();
	$stmt->close();
	
	if(!$resultados === false){
		
		foreach($resultados as $resultado) {
      /*
        Caragmos la sesión
      */
			if($resultado['ACTIVO'] == 1){
				$_SESSION['Nombre'] = $resultado['USUARIO'];
				$_SESSION['SteamID'] = $resultado['STEAMID'];
				$_SESSION['LICENCIA'] = $resultado['LICENCIA'];
				$_SESSION['RANGO'] = $resultado['RANGO'];
				$_SESSION['lvRANGO'] = $resultado['lvRANGO'];
        $_SESSION['logeado'] = "1";
        $ip = $_SERVER['REMOTE_ADDR'];
        $query = request_BD("UPDATE panel_users SET LastIP = '$ip' WHERE USUARIO = '$usuario' AND PASS = '$pass'");
				echo "<script>location.href='index.php';</script>";
				die();
			}else{	
				echo "<script>location.href='login.php';</script>";
				die();
			}
		
    }
    
	}else{
		
	}
	
	
    } else {
      //Error de captcha
        echo'<div>Error, no se ha podido comprobar si eres un robot :[]</div>';
    }
	
	
	
}
 
 
 ?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Calle13 Panel | Log in</title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
     <script>
       function onSubmit(token) {
         document.getElementById("login").submit();
       }
     </script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    
	<b>Calle13</b>Panel</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Logeate</p>

    <form id="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="usuario" placeholder="Usuario">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="pass" placeholder="Contraseña">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
			
          <button data-callback='onSubmit'>Logeate</button>
        </div>
		 
        <!-- /.col -->
      </div>
    </form>

    
    <!-- /.social-auth-links -->

   

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/api.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>


</body>
</html>
