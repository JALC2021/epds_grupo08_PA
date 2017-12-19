<?php 
session_start();
if(isset($_SESSION['rol'])==NULL or ($_SESSION['rol']!='admin' and $_SESSION['rol']!='socio' and $_SESSION['rol']!='monitor')){
    header("Location:404.html");
}
if(isset($_POST['editUser'])){
	
	if(!isset($_POST['username']) or $_POST['username'] == ""){
		$fails[] = "El nombre de usuario es incorrecto";
	}else{
		$datos['username'] = filter_var(filter_input(INPUT_POST, 'username',FILTER_SANITIZE_MAGIC_QUOTES));
	}

	if(!isset($_POST['apellidos']) or $_POST['apellidos'] == ""){
		$fails[] = "El apellido es incorrecto";
	}else{
		$datos['apellidos'] = filter_var(filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_MAGIC_QUOTES));
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
		$datos['direccion'] = filter_var(filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_MAGIC_QUOTES));
	}
	
	
	if(!isset($_POST['descuento']) or $_POST['descuento'] == ""){
		$fails[] = "El descuento es incorrecto";
	}else{
		$datos['descuento'] = filter_var(filter_input(INPUT_POST, 'descuento', FILTER_SANITIZE_MAGIC_QUOTES));
	}
	if(!isset($_POST['nick']) or $_POST['nick'] == ""){
		$fails[] = "El nick es incorrecto";
	}else{
		$datos['nick'] = filter_var(filter_input(INPUT_POST, 'nick', FILTER_SANITIZE_MAGIC_QUOTES));
	}
	
	if(!isset($_POST['password']) or $_POST['password'] == ""){
		$fails[] = "El password es incorrecto";
	}else{
		$datos['password'] = filter_var(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_MAGIC_QUOTES));
	}
	if(!isset($_POST['correo']) or $_POST['correo'] == ""){
		$fails[] = "El correo es incorrecto";
	}else{
		$datos['correo'] = filter_var(filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_MAGIC_QUOTES));
	}
	
	$datos['tarifa'] = $_POST['tarifa'];
	$datos['monitor'] = $_POST['monitor'];
	$datos['idUser'] = $_POST['idUsuario'];


	print_r($datos);
	if(isset($fails)){
		
	}else{
		
		actualizarUsuario($datos);
		actualizarSocio($datos);
		header("Location:listaSocioAdmin.php");
	}

}

function actualizarUsuario($datos){ 
	
	include 'conexion.php';
		$sql = "update usuarios set nick='".$datos['nick']."',password='".$datos['password']."',email='".$datos['correo']."' where id = ".$datos['idUser']."";
		mysql_query($sql,$conexion);
		mysql_close($conexion);
}
function actualizarSocio($datos){
	
	include 'conexion.php';
		$sql = "update socios set id_monitor=".$datos['monitor'].",id_tarifa=".$datos['tarifa'].",nombre='".$datos['username']."',apellidos='".$datos['apellidos']."',telefono_movil='".$datos['movil']."',telefono_fijo='".$datos['fijo']."',direccion='".$datos['direccion']."',descuento='".$datos['descuento']."' where id_usuario =".$datos['idUser']."";
		
		mysql_query($sql,$conexion);
		mysql_close($conexion);
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
	$sql = "SELECT t2.pago_restante FROM socios as t1 join pago as t2 where t1.id_usuario = t2.id_socio ";

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
function mostrarSocios($id){
include 'conexion.php';
$sql = "select nombre,apellidos,sexo,foto_usuario from socios where id_usuario != ".$id."";
$result = mysql_query($sql,$conexion);
while(($fila = mysql_fetch_assoc($result)) != null){
	?> 
	<li>
				<figure class="image rounded">
				<img src="<?php echo "./fotos/".$fila['foto_usuario']; ?>" alt="Foto socio" class="img-circle2">
				</figure>
				<span class="title"><?php echo $fila['nombre']." ".$fila['apellidos']; ?></span>
				<span class="message truncate"><?php echo "Sexo:".$fila['sexo']; ?></span>
				</li>


	<?php }
	mysql_close($conexion);
}	



function fotoMonitor($user)
{
    include 'conexion.php';
    $sql="select t1.foto from monitores as t1 join usuarios as t2 where t1.id_usuario = t2.id  and t2.id=".$_SESSION['id']."";
    $result=mysql_query($sql,$conexion);
    $r=mysql_fetch_row($result);
    if($r>1 && $r[0]!="")
    {
       
        echo  "<img src='$r[0]' alt='foto monitor' class='img-circle' data-lock-picture='$r[0]' />";
    }
    else{
         echo  "<img src='assets/images/sinFoto.jpg' alt='foto monitor' class='img-circle' data-lock-picture='assets/images/sinFoto.jpg' />";

    }

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
function fotoSocio($user)
{
    include 'conexion.php';
    $sql="select t1.foto_usuario from socios as t1 join usuarios as t2 where t1.id_usuario = t2.id";
    $result=mysql_query($sql,$conexion);
    $r=mysql_fetch_row($result);
   
    if($r>1 && $r[0]!="")
    {
       
        echo  "<img src='./fotos/$r[0]' alt='foto monitor' class='img-circle user-image' data-lock-picture='./fotos/$r[0]' />";
    }
    else{
         echo  "<img src='./assets/images/sinFoto.jpg' alt='foto monitor' class='img-circle user-image' data-lock-picture='./assets/images/sinFoto.jpg' />";

    }
	mysql_close($conexion);

}

?>


<!doctype html>
<html class="fixed">
	<head>
<title>Seven Gym</title>
		
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
                                            if($_SESSION['rol']=="admin"){
                                                 fotoAdmin($_SESSION['nick']);
                                                
                                            }
                                            else if($_SESSION['rol']=="monitor"){
                                                fotoMonitor($_SESSION['nick']);
                                              
                                            }else if($_SESSION['rol']=="socio")
                                            {
                                                fotoSocio($_SESSION['nick']);
                                               
                                            }

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
              
				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Perfil Usuario</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Gestionar Socio</span></li>
								<li><span>Perfil Usuario</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
					<?php if($_SESSION['rol'] == 'admin' /*  and isset($_POST['perfil']*/){

						
						?>
						<?php if(isset($fails)){
		echo "<div class ='alert alert-danger'>";
		echo "<ul>";
		foreach ($fails as $f ) {
			echo "<li><p class = 'm-none text-semibold h6'>".$f."</p></li>";
		}
		echo "</ul></div>";
	}?>

					<div class="row">
						<div class="col-md-4 col-lg-3">

							<section class="panel">
								<div class="panel-body">
									<div class="thumb-info mb-md">
										<img src="fotos/<?php echo $_POST['foto_usuario']; ?>" class="rounded img-responsive" alt="John Doe">
										<div class="thumb-info-title">
											<span class="thumb-info-inner"><?php echo $_POST['nombre']; ?></span>
											<span class="thumb-info-type"><?php echo $_POST['apellidos']; ?></span>
										</div>
									</div>

									<div class="widget-toggle-expand mb-md">
										<div class="widget-header">
											<h6>¿Le queda algo por rellenar?</h6>
											<div class="widget-toggle">+</div>
										</div>
										
										<div class="widget-content-expanded">
											<ul class="simple-todo-list">
												<?php
												$completado = 0;

												if($_POST['nombre'] == ""){
													echo "<li >Falta por introducir el nombre de usuario</li>";
												}else{
													echo "<li class='completed'>El nombre esta completado</li>";
													$completado += 20;
												}
												if($_POST['apellidos'] == ""){
												echo "<li>No esta introducido el apellido</li>";
												}else{
													echo "<li class='completed'>Los apellidos estan rellenos</li>";
													$completado += 20;
												}
												if($_POST['fecha_nacimiento'] == ""){
													echo "<li class='completed'>No ha introducido la fecha de nacimiento</li>";
												}else{
													echo "<li class='completed'>La fecha de nacimiento esta introducida</li>";
													$completado += 20;
												}
												if($_POST['sexo'] == ""){
													echo "<li class='completed'>Falta por rellenar el sexo</li>";	
												}else{
													echo "<li class='completed'>El usuario ha introducido su sexo</li>";
													$completado += 20;
												}
												if($_POST['foto_usuario'] == ""){
												echo "<li class='completed'>No tiene foto de perfil</li>";
												}else{
													echo "<li class='completed'>Existe una foto de usuario</li>";
													$completado += 20;
												}






												 ?>
												
											</ul>
										</div>
										<div class="widget-content-collapsed">
											<div class="progress progress-xs light">

												<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $completado; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $completado; ?>%;">
													<?php echo $completado; ?>
												</div>
											</div>
										</div>
									</div>

							</section>


							<section class="panel">
								<header class="panel-heading">
									<div class="panel-actions">
										<a href="#" class="fa fa-caret-down"></a>
										<a href="#" class="fa fa-times"></a>
									</div>

									<h2 class="panel-title">
										<span class="label label-primary label-sm text-normal va-middle mr-sm">198</span>
										<span class="va-middle">Gente en tu gimnasio</span>
									</h2>
								</header>
								<div class="panel-body">
									<div class="content">
										<ul class="simple-user-list">
											<?php mostrarSocios($_POST['id']); ?>
										</ul>
										<hr class="dotted short">
										
									</div>
								</div>
							
							</section>

							

						</div>
						<div class="col-md-8 col-lg-6">

							<div class="tabs">
								<ul class="nav nav-tabs tabs-primary">
									
									<li class="active">
										<a href="#edit" data-toggle="tab">Editar Perfil</a>
									</li>
								</ul>
								<div class="tab-content">
									
									<div id="edit" class="tab-pane active">

										 <form class="form-horizontal" action="#" method = "post">
											<h4 class="mb-xlg">Cambiar Servicios</h4>
											<fieldset>
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
                                            <label class="col-md-3 control-label" for="inputDefault">Descuento</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="inputDefault" name = "descuento" value = "<?php echo $_POST['descuento']; ?>">
                                            </div>
                                        </div>
											</fieldset>
											<hr class="dotted tall">
											<h4 class="mb-xlg">Informacion Personal</h4>
											<fieldset>
												<div class="form-group">
                                            <label class="col-md-3 control-label" for="inputDefault">Nombre</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="inputDefault" name = "username" value = "<?php echo $_POST['nombre']; ?>">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="inputDefault">Apellidos</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="inputDefault" name = "apellidos" value = "<?php echo $_POST['apellidos']; ?>">
                                            </div>
                                        </div>


                                       
                                   

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Telefono Movil</label>
                                            <div class="col-md-6 control-label">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-phone"></i>
                                                    </span>
                                                    <input id="phone" data-plugin-masked-input data-input-mask="999999999" placeholder="6XXXXXXXX" class="form-control" name = "movil" >
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
                                                    <input id="phone" data-plugin-masked-input data-input-mask="999999999" placeholder="9XXXXXXXX" class="form-control" name = "fijo" >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="inputDefault">Direccion</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="inputDefault" name = "direccion" value = "<?php echo $_POST['direccion']; ?>">
                                            </div>

                                        </div>
											</fieldset>
											<hr class="dotted tall">
											<h4 class="mb-xlg">Informacion de Usuario</h4>
											<fieldset class="mb-xl">
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
                                                        <input class="form-control" type="text" placeholder="Password" name = "password">
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
											</fieldset>
											<div class="panel-footer">
												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														<input type = "hidden" name = "idUsuario" value= "<?php echo $_POST['id']; ?>">
														<input type="submit" class="mb-xs mt-xs mr-xs btn btn-warning btn-lg" name="editUser"></input>
														<input type="reset" class="mb-xs mt-xs mr-xs btn btn-warning btn-lg" name="reset"></input>
														
													</div>
												</div>
											</div>

										</form>

									</div>
								</div>
							</div>
						</div>
					

					</div>
					<?php }else{ ?>

                    	<div class="alert alert-danger"><p class="m-none text-semibold h6">No tienes permiso para acceder a este área</p></div>  <?php                	
                    }
                    ?>
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
		
		<!-- Specific Page Vendor -->		<script src="assets/vendor/jquery-autosize/jquery.autosize.js"></script>
		
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