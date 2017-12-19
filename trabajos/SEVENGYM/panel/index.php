<?php 
session_start();
if(isset($_POST['logUser'])){

	$usuario = filter_input(INPUT_POST, 'userlogin',FILTER_SANITIZE_STRING);
	$pass = filter_input(INPUT_POST, 'userpass',FILTER_SANITIZE_STRING);


	if(!isset($usuario) or $usuario == ""){
		$fails[] = "Introduce un nombre de usuario";

	}
	if(!isset($pass) or $pass == ""){
		$fails[] = "Introduce un password";
	}

	if(isset($fails)){
		echo "<ul> Errores:";
		foreach ($fails as $v) {
			echo "<li>".$v." </li>";

		}
		echo "</ul>";
}else{

	$datos = comprobar($usuario,$pass);


	if(count($datos)>1){
		$opcion = $datos[2];
		$_SESSION['rol']=$datos[2];
		$_SESSION['nick']=$datos[0];
		$_SESSION['id'] = $datos[3];
		
		if($opcion == 'admin'){

			header("Location: indexAdmin.php");

		}else if($opcion == 'socio'){
			header("Location: indexSocio.php");

		}else if($opcion == 'monitor'){
			header("Location: indexMonitor.php");

		}

	}else{
		
		?> <div class="alert alert-danger"><p class="m-none text-semibold h6">Error el usuario o contraseña es incorrecta</p></div>  <?php
	}


}

}

function comprobar($nick,$pass){
	$codePass=md5($pass);
	include 'conexion.php';
	$sql = "select nick,password,rol,id from usuarios where nick = '$nick' and password = '$codePass'";
	$result = mysql_query($sql,$conexion);
	$filas = mysql_fetch_row($result);
	mysql_close($conexion);
	return $filas;
}




?>

<!doctype html>
<html class="fixed">
	<head>
	<title>Administración Seven Gym</title>
		<!-- Basic -->
		<meta charset="UTF-8">

		
		<meta name="description" content="Login">
		<meta name="author" content="Equipo5PA">

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
					<img src="assets/images/logo.png" height="54" alt="Administracion Seven Gym" />
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i>Login</h2>
					</div>
					<div class="panel-body">
						<form action="#" method="post">
							<div class="form-group mb-lg">
								<label>Usuario</label>
								<div class="input-group input-group-icon">
									<input name="userlogin" type="text" class="form-control input-lg" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="form-group mb-lg">
								<div class="clearfix">
									<label class="pull-left">Contraseña</label>
									<a href="restaurarPass.php" class="pull-right">¿Ha perdido su contraseña?</a>
								</div>
								<div class="input-group input-group-icon">
									<input name="userpass" type="password" class="form-control input-lg"/>
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="row">
								
								<div class="col-sm-4 ">
									<button type="submit" class="btn btn-primary hidden-xs btn-lg btn-warning" name="logUser">Login</button>
									
								</div>
							</div>
<!--Tener Facebook Integrado													
							<span class="mt-lg mb-lg line-thru text-center text-uppercase">
								<span>or</span>
							</span>
							
							<div class="mb-xs text-center">
								<a class="btn btn-facebook mb-md ml-xs mr-xs">Connect with <i class="fa fa-facebook"></i></a>
								<a class="btn btn-twitter mb-md ml-xs mr-xs">Connect with <i class="fa fa-twitter"></i></a>
							</div>
							
							<p class="text-center">Don't have an account yet? <a href="pages-signup.html">Sign Up!</a>-->

						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">&copy; Copyright 2014. Todos los derechos reservados.</p>
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
		<!-- Analytics to Track Preview Website -->		<script>		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');		  ga('create', 'UA-42715764-8', 'auto');		  ga('send', 'pageview');		</script>
	</body>
</html>
<!-- Localized -->