<?php

if(isset($_POST['restaurar'])){
	$email = filter_var(filter_input(INPUT_POST, 'email',FILTER_SANITIZE_EMAIL));

	if(isset($email)){
		$datos=comprobar($email);
		$newPass = generateRandomString();
		if(count($datos)>1){
			$para      = $email;
			$titulo    = 'Datos de acceso Seven Gym';
			$mensaje   = "Hola su nick es $datos[0] y su nuevo password es $newPass";
			$cabeceras = "From: $email" . "\r\n" .
    		'Reply-To: info@sevengym.com' . "\r\n";
			if(mail($para, $titulo, $mensaje, $cabeceras)){
				?>
				<div class="alert alert-info">
							<p class="m-none text-semibold h6">Se ha enviado el correo correctamente</p>
						</div>
						<?
			}
			actualizarPass(md5($newPass),$datos[2]);
		}
		else{
			?>
			<div class="alert alert-danger">
							<p class="m-none text-semibold h6">Error los datos son erroneos, verifiquelo</p>
						</div>
			<?
		}
		
	}
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function actualizarPass($pass,$id){
include 'conexion.php';
$sql="update  usuarios set password='".$pass."' where id=".$id."";
mysql_query($sql,$conexion);
mysql_close($conexion);
}



function comprobar($email){
	include 'conexion.php';
	$sql = "select nick,password,id from usuarios where email = '$email'";
	$result = mysql_query($sql,$conexion);
	$filas = mysql_fetch_row($result);
	mysql_close($conexion);
	return $filas;
}
?>

<!doctype>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>

	</head>
	<body>
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="../../index.html" class="logo pull-left">
					<img src="assets/images/logo.png" height="54" alt="Porto Admin" />
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Recuperar contraseña</h2>
					</div>
					<div class="panel-body">
						<div class="alert alert-info">
							<p class="m-none text-semibold h6">Introduzca su email para recuperar la contraseña</p>
						</div>

						<form method="post" action="restaurarPass.php">
							<div class="form-group mb-none">
								<div class="input-group">
									<input name="email" type="email" placeholder="E-mail" class="form-control input-lg" />
									<span class="input-group-btn">
										<button class="btn btn-primary btn-lg btn-warning" type="submit" name="restaurar">Enviar</button>
									</span>
								</div>
							</div>

							<p class="text-center mt-lg"> <a href="index.php">Loguearse!</a>
						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">&copy; Copyright 2014. Todos los derechos estan reservados.</p>
			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>		<script src="assets/vendor/jquery-cookie/jquery.cookie.js"></script>		<script src="assets/vendor/style-switcher/style.switcher.js"></script>		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>
		</body>
</html>

