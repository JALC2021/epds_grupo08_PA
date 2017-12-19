<?php 
session_start();
if(isset($_SESSION['rol'])==NULL or $_SESSION['rol']!='admin'){
    header("Location:404.html");
}
if(isset($_POST['altauser'])){
	
	if(!isset($_POST['username']) or $_POST['username'] == ""){
		$fails[] = "El nombre de usuario es incorrecto";
	}else{
		$datos['username'] = filter_var(filter_input(INPUT_POST, 'username',FILTER_SANITIZE_SPECIAL_CHARS));
	}

	if(!isset($_POST['apellidos']) or $_POST['apellidos'] == ""){
		$fails[] = "El apellido es incorrecto";
	}else{
		$datos['apellidos'] = filter_var(filter_input(INPUT_POST, 'apellidos',FILTER_SANITIZE_SPECIAL_CHARS));
	}

	if(!isset($_POST['nacimiento']) or $_POST['nacimiento'] == ""){
		$fails[] = "La fecha de nacimiento es incorrecta";
	}else{
		$datos['nacimiento'] = filter_var(filter_input(INPUT_POST, 'nacimiento', FILTER_SANITIZE_SPECIAL_CHARS));
	}

	if(!isset($_POST['sexo']) or $_POST['sexo'] == ""){
		$fails[] = "El sexo elegido es incorrecto";
	}else{
		$datos['sexo'] = filter_var(filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_SPECIAL_CHARS));
	}

	if(!isset($_POST['movil']) or $_POST['movil'] == "" or !preg_match('/^[0-9]*$/', $_POST['movil'] )){
		$fails[] = "El numero de movil es incorrecto";
	}else{
		$datos['movil'] = filter_var(filter_input(INPUT_POST, 'movil',FILTER_SANITIZE_NUMBER_INT));
	}
	if(!isset($_POST['fijo']) or $_POST['fijo'] == "" or !preg_match('/^[0-9]*$/', $_POST['fijo'] )){
		$fails[] = "El numero de telefono fijo es incorrecto";
	}else{
		$datos['fijo'] = filter_var(filter_input(INPUT_POST, 'fijo',FILTER_SANITIZE_NUMBER_INT));
	}
	if(!isset($_POST['direccion']) or $_POST['direccion'] == ""){
		$fails[] = "La direccion es incorrecta";
	}else{
		$datos['direccion'] = filter_var(filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_SPECIAL_CHARS));
	}
	if(!isset($_POST['poblacion']) or $_POST['poblacion'] == ""){
		$fails[] = "La poblacion es incorrecta";
	}else{
		$datos['poblacion'] = filter_var(filter_input(INPUT_POST, 'poblacion',FILTER_SANITIZE_SPECIAL_CHARS));
	}
	if(!isset($_POST['provincia']) or $_POST['provincia'] == ""){
		$fails[] = "La provincia es incorrecta";
	}else{
		$datos['provincia'] = filter_var(filter_input(INPUT_POST, 'provincia',FILTER_SANITIZE_SPECIAL_CHARS));
	}
	if(!isset($_POST['descuento']) or $_POST['descuento'] == ""){
		$fails[] = "El descuento es incorrecto";
	}else{
		$datos['descuento'] = filter_var(filter_input(INPUT_POST, 'descuento',FILTER_SANITIZE_SPECIAL_CHARS));
	}
	if(!isset($_POST['nick']) or $_POST['nick'] == ""){
		$fails[] = "El nick es incorrecto";
	}else{
		$datos['nick'] = filter_var(filter_input(INPUT_POST, 'nick', FILTER_SANITIZE_SPECIAL_CHARS));
	}
	
	if(!isset($_POST['password']) or $_POST['password'] == ""){
		$fails[] = "El password es incorrecto";
	}else{
		$datos['password'] = md5(filter_var(filter_input(INPUT_POST, 'password',FILTER_SANITIZE_SPECIAL_CHARS)));
	}
	if(!isset($_POST['correo']) or $_POST['correo'] == ""){
		$fails[] = "El correo es incorrecto";
	}else{
		$datos['correo'] = filter_var(filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_SPECIAL_CHARS));
	}
	$datos['foto'] = $_SESSION['userfoto'];
	$datos['tarifa'] = $_POST['tarifa'];
	$datos['monitor'] = $_POST['monitor'];



	if(isset($fails)){
		
	}else{
		
		insertarUsuario($datos);
		insertarSocio($datos);
		header("Location:listaSocioAdmin.php");
	}

}

function insertarUsuario($datos){
	include 'conexion.php';
		$sql = "insert into usuarios (nick,password,email,rol) values ( '".$datos['nick']."','".$datos['password']."','".$datos['correo']."','socio')";
		mysql_query($sql,$conexion);
		mysql_close($conexion);
}
function insertarSocio($datos){
	$idUsuario = getIdUsuario($datos['nick']);
	include 'conexion.php';
		$sql = "insert into socios (id_usuario,id_monitor,id_tarifa,nombre,apellidos,fecha_nacimiento,sexo,telefono_movil,telefono_fijo,direccion,poblacion,provincia,foto_usuario,descuento) values ( ".$idUsuario.",".$datos['monitor'].",".$datos['tarifa'].",'".$datos['username']."','".$datos['apellidos']."','".$datos['nacimiento']."','".$datos['sexo']."','".$datos['movil']."','".$datos['fijo']."','".$datos['direccion']."','".$datos['poblacion']."','".$datos['provincia']."','".$datos['foto']."','".$datos['descuento']."')";
		
		mysql_query($sql,$conexion);
		mysql_close($conexion);
}
function getIdUsuario($nick){
	include 'conexion.php';
	$result = mysql_query("select id from usuarios where nick = '".$nick."'",$conexion);
	$fila = mysql_fetch_row($result);
	mysql_close($conexion);
	return $fila[0];

}

function tarifasDisponibles(){
	include 'conexion.php';
	$sql = "select id,nombre,precio from tarifa";
	$result = mysql_query($sql,$conexion);
	while(($fila = mysql_fetch_assoc($result))!= NULL){
		?>  <option value="<?php echo $fila['id']; ?>"><?php echo $fila['nombre']."/".$fila['precio']."€"; ?></option> <?php

	}

}
function monitoresDisponibles(){
	include 'conexion.php';
	$sql = "select id_usuario,nombre,especialidad from monitores";
	$result = mysql_query($sql,$conexion);
	while(($fila = mysql_fetch_assoc($result))!= NULL){
		?>  <option value="<?php echo $fila['id_usuario']; ?>"><?php echo $fila['nombre']."/".$fila['especialidad']; ?></option> <?php

	}

}


function morosos(){
	$cont = 0;
	include 'conexion.php';
	$sql = "SELECT t2.pago_restante FROM socios as t1 join pago as t2 where t1.id_usuario = t2.id_socio and t2.pago_restante > 0 ";

	$result=mysql_query($sql,$conexion);
	while($res=mysql_fetch_row($result)){
		$cont++;
	}
	mysql_close($conexion);
	return $cont;
	
}
function numUsuarios(){
	$cont=0;
	include 'conexion.php';
	$sql = "select nick,password from usuarios where rol = 'socio'";
	$result=mysql_query($sql,$conexion);
	while($res=mysql_fetch_row($result)){
		$cont++;
	}
	mysql_close($conexion);
	return $cont;

}


function fotoAdmin($user)
{
    include 'conexion.php';
    $sql="select nick,password from usuarios where rol='admin' and nick='$user'";
    $result=mysql_query($sql,$conexion);
    $r=mysql_fetch_row($result);
    if($r>1)
    {
        echo  '<img src="assets/images/admin.jpg" alt="foto admin" class="img-circle user-image" data-lock-picture="assets/images/admin.jpg" />';
    }
	mysql_close($conexion);

}

?>


 <!doctype html>
<html class="fixed">
	<head>
<title>Panel de Administración Seven Gym</title>
		<!-- Basic -->
		<meta charset="UTF-8">

		
		<meta name="description" content="Portal de administracion del gimnasio Seven Gym">
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

		<!-- Specific Page Vendor CSS -->		<link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />		<link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />		<link rel="stylesheet" href="assets/vendor/morris/morris.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">
        <!-- Head Libs -->
        <script src="assets/vendor/modernizr/modernizr.js"></script>
		<script type="text/javascript" src="webcam.js"></script>


	</head>

	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="../index.html" class="logo">
						<img src="assets/images/logo.png" height="35" alt="Porto Admin" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
					
					<span class="separator"></span>
			
					
                    <div id="userbox" class="userbox">
                        <a href="#" data-toggle="dropdown">
                            <figure class="profile-picture">
                   
                               <?php 
                               fotoAdmin($_SESSION['nick']);
                               ?>
                            </figure>
                            <div class="profile-info">
                                <span class="name"><?php echo $_SESSION['nick'];?></span>
                                <span class="role"><?php echo $_SESSION['rol'];?></span>
                            </div>
            
                            <i class="fa custom-caret"></i>
                        </a>
            
                        <div class="dropdown-menu">
                            <ul class="list-unstyled">
                                <li class="divider"></li>
                               
                                <li>
                                    <a role="menuitem" tabindex="-1" href="lockPerfil.php"><i class="fa fa-lock"></i> Bloquear Perfil</a>
                                </li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<div class="inner-wrapper">
																<!-- start: sidebar -->
                <aside id="sidebar-left" class="sidebar-left">

                    <div class="sidebar-header">
                        <div class="sidebar-title">
                            Menú
                        </div>
                        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                        </div>
                    </div>
                
                    <div class="nano">
                        <div class="nano-content">
                            <nav id="menu" class="nav-main" role="navigation">
                                <ul class="nav nav-main">
                                    <li class="nav-active">
                                        <?php
                                        if($_SESSION['rol']=='admin'){
                                            
                                            ?>
                                            <a href="indexAdmin.php"> <!-- vista de admin, monitor, socio-->
                                            <i class="fa fa-home" aria-hidden="true"></i>
                                            <span>Principal</span>
                                            </a>    
                                            <?php

                                        }else if($_SESSION['rol']=='monitor'){
                                            ?>
                                            <a href="indexMonitor.php"> <!-- vista de admin, monitor, socio-->
                                            <i class="fa fa-home" aria-hidden="true"></i>
                                            <span>Principal</span>
                                            </a>    
                                            <?php

                                        }else if($_SESSION['rol']=='socio'){
                                            ?>
                                            <a href="indexSocio.php"> <!-- vista de admin, monitor, socio-->
                                            <i class="fa fa-home" aria-hidden="true"></i>
                                            <span>Principal</span>
                                            </a>    
                                            <?php

                                        }
                                        ?>
                                        
                                    </li>
                                    <li>
                                        <a href="mailBox.php">
                                            
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                            <span>Correo</span>
                                        </a>
                                    </li>
                                
                                <?php if($_SESSION['rol'] == 'admin'){ ?>
                                    <li class="nav-parent">
                                        <a>
                                            <i class="fa fa-group" aria-hidden="true"></i>
                                            <span>Gestionar Socios</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="altaSocio.php">
                                                     Alta Socio
                                                </a>
                                            </li>
                                            <li>
                                                <a href="listaSocioAdmin.php">
                                                     Listar Socios
                                                </a>
                                            </li>
                                            
                                        </ul>
                                    </li>

                                    <li class="nav-parent">
                                        <a>
                                            <i class="fa fa-male" aria-hidden="true"></i>
                                            <span>Gestionar Monitores</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="altaMonitor.php">
                                                     Alta Monitor
                                                </a>
                                            </li>
                                            <li>
                                                <a href="listarMonitores.php">
                                                     Listar Monitores
                                                </a>
                                            </li>
                                            
                                        </ul>
                                    </li>

                                    <li class="nav-parent">
                                        <a>
                                            <i class="fa fa-bar-chart-o" aria-hidden="true"></i>
                                            <span>Gestionar Tarifas</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="altaTarifa.php">
                                                     Alta Tarifa
                                                </a>
                                            </li>
                                            <li>
                                                <a href="listarTarifa.php">
                                                     Listar Tarifas
                                                </a>
                                            </li>
                                            
                                        </ul>
                                    </li>
                                    <?php }?>

                                    <?php if($_SESSION['rol'] == 'monitor'){ ?>
                                    <li class="nav-parent">
                                        <a>
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                            <span>Mis Entrenamientos</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="listarEntrenamientos.php">
                                                     Listar Entrenamientos
                                                </a>
                                            </li>
                                            

                                            <li class="nav-parent">
                                        <a>
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                            <span>Gestionar Ejercicios</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="altaEjercicio.php">
                                                     Alta Ejercicio
                                                </a>
                                            </li>
                                            <li>
                                                <a href="listarEjercicios.php">
                                                     Mostrar Ejercicios
                                                </a>
                                            </li>
                                            
                                        </ul>
                                    </li>                       
                                    
                                        </ul>
                                    </li>

                                        <li class="nav-parent">
                                        <a>
                                            <i class="fa fa-bar-chart-o" aria-hidden="true"></i>
                                            <span>Socios Afiliados</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="listarSocios.php">
                                                     Lista Socios
                                                </a>
                                            </li>
                                        
                                            
                                        </ul>
                                    </li>

                                    <?php }?>
                                    <?php if($_SESSION['rol'] == 'admin'){ ?>
                                    <li class="nav-parent">
                                        <a>
                                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                                            <span>Gestionar Pagos</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="PrePago.php">
                                                    Realizar Pago
                                                </a>
                                            </li>
                                            <li>
                                                <a href="pagoPendiente.php">
                                                     Pagos Pendiente
                                                </a>
                                            </li>
                                            <li>
                                                <a href="pagoRealizado.php">
                                                     Pagos Realizados
                                                </a>
                                            </li>
                                            
                                        </ul>
                                    </li>
                                    <?php }?>
                                    <?php if($_SESSION['rol'] == 'socio'){ ?>

                                    <li class="nav-parent">
                                        <a>
                                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                                            <span>Asignar Monitor</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="seleccionarMonitor.php">
                                                    Seleccionar Monitor
                                                </a>
                                            </li>
                                            
                                        </ul>
                                    </li>
                                    
                                

                                <li class="nav-parent">
                                        <a>
                                            <i class="fa fa-bar-chart-o" aria-hidden="true"></i>
                                            <span>Mi Progreso</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="altaMedidas.php">
                                                    Actualizar Datos
                                                </a>
                                            </li>

                                          
                                            
                                        </ul>
                                    </li>

                                    <li class="nav-parent">
                                        <a>
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                            <span>Zona Sana</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="dietas.php">
                                                    Dietas
                                                </a>
                                            </li>

                                            <li>
                                                <a href="suplementos.php">
                                                    Suplementos
                                                </a>
                                            </li>
                                            
                                        </ul>
                                    </li>
                                    
                                </ul>


                                <?php }?>
                            </nav>
                
                            <?php if($_SESSION['rol'] == 'admin'){ ?>
                            <hr class="separator" />
                
                            <div class="sidebar-widget widget-stats">
                                <div class="widget-header">
                                    <h6>Gimnasio Seven Gym</h6>
                                    <div class="widget-toggle">+</div>
                                </div>
                                <div class="widget-content">
                                    <ul>
                                        <li>
                                            <span class="stats-title">Numero de clientes</span>
                                            <span class="stats-complete"><?php $n=numUsuarios(); echo $n ;?></span>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: <?echo $n."%";?>">
                                                    
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="stats-title">Numero de impagos</span>
                                            <span class="stats-complete"><?php  $m=morosos(); echo $m;?></span>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: <?echo $m."%";?>">
                                                    
                                                </div>
                                            </div>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                
                    </div>
                
                </aside>
                <!-- end: sidebar -->

				<section role="main" class="content-body">

					<header class="page-header">
						<h2>Gestionar Socios</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Gestionar Socios</span></li>
								<li><span>Alta Socio</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<?php if(isset($fails)){
		echo "<div class ='alert alert-danger'>";
		echo "<ul>";
		foreach ($fails as $f ) {
			echo "<li><p class = 'm-none text-semibold h6'>".$f."</p></li>";
		}
		echo "</ul></div>";
	}?>
					<!-- start: page -->
                    <div class="row">
                        <div class="col-xs-12">
                            <section class="panel">

                                <div class="panel-body">
                                    <form class="form-horizontal form-bordered" action="#" method = "post">


                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Tarifas</label>
                                            <div class="col-md-6">
                                                <select data-plugin-selectTwo class="form-control populate" name = "tarifa">

                                                    <optgroup label="Tarifa/Precio">
                                                        <?php tarifasDisponibles(); ?>

                                                    </optgroup>    
                                                </select>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-md-3 control-label">Asignacion Monitor</label>
                                            <div class="col-md-6">
                                                <select data-plugin-selectTwo class="form-control populate" name="monitor">

                                                    <optgroup label="Nombre/Especialidad">
                                                        <?php monitoresDisponibles(); ?>

                                                    </optgroup>    
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="inputDefault">Nombre</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="inputDefault" name = "username">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="inputDefault">Apellidos</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="inputDefault" name = "apellidos">
                                            </div>
                                        </div>


			 <div class="form-group">
                                         <label class="col-md-3 control-label" for="inputDefault">Foto Usuario:</label>
										<div class="col-md-6">
											<script language="JavaScript">
		document.write( webcam.get_html(300, 220) );
</script>
<script language="JavaScript">
    webcam.set_api_url( 'capturaFoto.php' );
		webcam.set_quality( 100 ); // JPEG quality (1 - 100)
		webcam.set_shutter_sound( true ); // play shutter click sound
		webcam.set_hook( 'onComplete', 'my_completion_handler' );

		function take_snapshot(){
			// take snapshot and upload to server
			webcam.snap();
			

		}

		
	</script>
	
		
		<input type="button"   value="Tomar Fotografía" onClick="take_snapshot()">	

		
										</div></div>





                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Fecha de Nacimiento</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" data-plugin-datepicker class="form-control" name = "nacimiento">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <label class="col-sm-4 control-label">Sexo</label>

                                            <div class="col-sm-8">
                                                <div class="radio-custom">
                                                    <input type="radio" id="radioExample1" name="sexo" value = "hombre">
                                                    <label for="sexo">Masculino</label>
                                                </div>

                                                <div class="radio-custom">
                                                    <input type="radio" id="radioExample1" name="sexo" value = "mujer">
                                                    <label for="sexo">Femenino</label>
                                                </div>

                                            </div> 

                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Telefono Movil</label>
                                            <div class="col-md-6 control-label">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-phone"></i>
                                                    </span>
                                                    <input id="phone" data-plugin-masked-input data-input-mask="999999999" placeholder="6XXXXXXXX" class="form-control" name = "movil">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Telefono Fijo</label>
                                            <div class="col-md-6 control-label">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-phone"></i>
                                                    </span>
                                                    <input id="phone" data-plugin-masked-input data-input-mask="999999999" placeholder="9XXXXXXXX" class="form-control" name = "fijo">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="inputDefault">Direccion</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="inputDefault" name = "direccion">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="inputDefault">Poblacion</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="inputDefault" name = "poblacion">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="inputDefault">Provincia</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="inputDefault" name = "provincia">
                                            </div>
                                        </div>

                                    

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="inputDefault">Descuento</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="inputDefault" name = "descuento">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Credenciales</label>
                                            <div class="col-md-6">
                                                <section class="form-group-vertical">
                                                    <div class="input-group input-group-icon">
                                                        <span class="input-group-addon">
                                                            <span class="icon"><i class="fa fa-user"></i></span>
                                                        </span>
                                                        <input class="form-control" type="text" placeholder="Username" name = "nick">
                                                    </div>
                                                    <div class="input-group input-group-icon">
                                                        <span class="input-group-addon">
                                                            <span class="icon"><i class="fa fa-key"></i></span>
                                                        </span>
                                                        <input class="form-control" type="password" placeholder="Password" name = "password">
                                                    </div>
                                                </section>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="inputDefault">Email</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="inputDefault" name = "correo">
                                            </div>
                                        </div>


                                        <div class="form-group" align="center">
                                            <input type="submit" class="mb-xs mt-xs mr-xs btn btn-warning btn-lg" name="altauser"></input>
                                            <input type="reset" class="mb-xs mt-xs mr-xs btn btn-warning btn-lg" name="reset"></input>

                                        </div>
                                    </form>
                                </div>

                            </section>
                        </div>
                    </div>
                    <!-- end: page -->
                    
                </section>
					
				
			</div>

			<aside id="sidebar-right" class="sidebar-right">
				<div class="nano">
					<div class="nano-content">
						<a href="#" class="mobile-close visible-xs">
							Collapse <i class="fa fa-chevron-right"></i>
						</a>
			
						<div class="sidebar-right-wrapper">
			
							<div class="sidebar-widget widget-calendar">
								<h6>Calendario</h6>
								<div data-plugin-datepicker data-plugin-skin="dark" ></div>
			
								<ul>
									<li>
										<time datetime="2014-04-19T00:00+00:00">04/19/2014</time>
										<span>Seven Gym</span>
									</li>
								</ul>
							</div>
			
					
			
						</div>
					</div>
				</div>
			</aside>
		</section>

		 <!-- Vendor -->
        <script src="assets/vendor/jquery/jquery.js"></script>		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>		<script src="assets/vendor/jquery-cookie/jquery.cookie.js"></script>		<script src="assets/vendor/style-switcher/style.switcher.js"></script>		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

        <!-- Specific Page Vendor -->		<script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>		<script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>		<script src="assets/vendor/select2/select2.js"></script>		<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>		<script src="assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>		<script src="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>		<script src="assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>		<script src="assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>		<script src="assets/vendor/fuelux/js/spinner.js"></script>		<script src="assets/vendor/dropzone/dropzone.js"></script>		<script src="assets/vendor/bootstrap-markdown/js/markdown.js"></script>		<script src="assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>		<script src="assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>		<script src="assets/vendor/codemirror/lib/codemirror.js"></script>		<script src="assets/vendor/codemirror/addon/selection/active-line.js"></script>		<script src="assets/vendor/codemirror/addon/edit/matchbrackets.js"></script>		<script src="assets/vendor/codemirror/mode/javascript/javascript.js"></script>		<script src="assets/vendor/codemirror/mode/xml/xml.js"></script>		<script src="assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>		<script src="assets/vendor/codemirror/mode/css/css.js"></script>		<script src="assets/vendor/summernote/summernote.js"></script>		<script src="assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>		<script src="assets/vendor/ios7-switch/ios7-switch.js"></script>

        <!-- Theme Base, Components and Settings -->
        <script src="assets/javascripts/theme.js"></script>

        <!-- Theme Custom -->
        <script src="assets/javascripts/theme.custom.js"></script>

        <!-- Theme Initialization Files -->
        <script src="assets/javascripts/theme.init.js"></script>
       
        <!-- Examples -->
        <script src="assets/javascripts/forms/examples.advanced.form.js" /></script>
	</body>
</html>
<!-- Localized -->