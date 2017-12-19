<?php
session_start();
if(isset($_SESSION['rol'])==NULL or $_SESSION['rol']!='socio'){
    header("Location:404.html");
}
if(isset($_POST['negativo'])){
    include 'conexion.php';
                    $id = sacarIdSocio();
                    $sql = "SELECT id_monitor FROM socios where id_usuario=$id";
                    $result = mysql_query($sql, $conexion);
                    $fila = mysql_fetch_array($result);
                    $idmonitor = $fila[0];
                   
                    if ($idmonitor == 0) {
                       
                    } else {
                        
                        $sql1 = "SELECT numero_votos,popularidad from monitores where id_usuario=$idmonitor";
                        $result1 = mysql_query($sql1, $conexion);
                        $fila1 = mysql_fetch_array($result1);
                        $numerovotos = $fila1[0];
                        $popularidad = $fila1[1];

                        $numerovotos +=1;
                        $popularidad +=1;

                        $sql2 = "update monitores set popularidad= $popularidad, numero_votos=$numerovotos where id_usuario=$idmonitor";
                        $result2 = mysql_query($sql2,$conexion);
                        
                    }


                    mysql_close($conexion);
                   
                   
}
if(isset($_POST['positivo'])){
    include 'conexion.php';
                    $id = sacarIdSocio();
                    $sql = "SELECT id_monitor FROM socios where id_usuario=$id";
                    $result = mysql_query($sql, $conexion);
                    $fila = mysql_fetch_array($result);
                    $idmonitor = $fila[0];
                   
                    if ($idmonitor == 0) {
                       
                    } else {
                        
                        $sql1 = "SELECT numero_votos,popularidad from monitores where id_usuario=$idmonitor";
                        $result1 = mysql_query($sql1, $conexion);
                        $fila1 = mysql_fetch_array($result1);
                        $numerovotos = $fila1[0];
                        $popularidad = $fila1[1];

                        $numerovotos +=1;
                        $popularidad +=10;

                        $sql2 = "update monitores set popularidad= $popularidad, numero_votos=$numerovotos where id_usuario=$idmonitor";
                        $result2 = mysql_query($sql2,$conexion);
                        
                    }


                    mysql_close($conexion);
                  
}
function morosos(){
    $cont = 0;
    include 'conexion.php';
    $sql = "SELECT t2.pago_restante FROM socios as t1 join pago as t2 where t1.id_usuario = t2.id_socio and t2.pago_restante > 0";

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
function fotoSocio($user)
{
    include 'conexion.php';
    $sql="select t1.foto_usuario from socios as t1 join usuarios as t2 where t1.id_usuario = t2.id and t2.id=".$_SESSION['id']."";
    $result=mysql_query($sql,$conexion);
    $r=mysql_fetch_row($result);
   
    if($r>1)
    {
       
        echo  "<img src='./fotos/$r[0]' alt='foto monitor' class='img-circle' data-lock-picture='./fotos/$r[0]' />";
    }
    else{
         echo  "<img src='./assets/images/sinFoto.jpg' alt='foto monitor' class='img-circle' data-lock-picture='./assets/images/sinFoto.jpg' />";

    }
	mysql_close($conexion);

}
function sacarSumaPagoMes($mes) {
                include 'conexion.php';
                $anyo = date("Y");
                $sql = "SELECT pago_realizado FROM pago WHERE fecha_pago >= '$anyo-$mes-01 00:00:00' and fecha_pago <'$anyo-$mes-31 23:59:59'";
                $result = mysql_query($sql, $conexion);
                $sumaPago = 0;


                while ($fila = mysql_fetch_array($result)) {
                    $sumaPago += $fila[0];
                }

                mysql_close($conexion);
                return $sumaPago;
            }

            function porcentajePagoMes($mes) {
                include 'conexion.php';
                $anyo = date("Y");
                $sql = "SELECT pago_total, pago_realizado FROM pago WHERE fecha_pago >= '$anyo-$mes-01 00:00:00' and fecha_pago <'$anyo-$mes-31 23:59:59'";
                $result = mysql_query($sql, $conexion);
                $pagoTotal = 0;
                $pagoRestante = 0;
                $porcentaje = 0;

                while ($fila = mysql_fetch_array($result)) {
                    $pagoTotal += $fila[0];
                    $pagoRestante += $fila[1];
                }

                mysql_close($conexion);

                if ($pagoTotal == 0) {
                    $porcentaje = 100;
                } else {
                    $porcentaje = ($pagoRestante * 100) / $pagoTotal;
                    $porcentaje = number_format($porcentaje, 0);
                }
                return $porcentaje;
            }

            function totalDinero() {
                include 'conexion.php';
                $sql = "SELECT pago_realizado FROM pago";
                $result = mysql_query($sql, $conexion);
                $totalDinero = 0;

                while ($fila = mysql_fetch_array($result)) {
                    $totalDinero += $fila[0];
                }
                mysql_close($conexion);
                return $totalDinero;
            }

            function porcentajePagoAnyo() {
                $porcentajeAnyo = 0;
                for ($index = 1; $index < 13; $index++) {
                    $porcentajeAnyo += porcentajePagoMes($index);
                }
                return ($porcentajeAnyo / 12);
            }

            function totalSocios() {
                include 'conexion.php';
                $sql = "SELECT * FROM socios";
                $result = mysql_query($sql);

                $totalSocios = mysql_num_rows($result);

                return $totalSocios;
            }

            function totalMonitores() {
                include 'conexion.php';
                $sql = "SELECT * FROM monitores";
                $result = mysql_query($sql);

                $totalMonitores = mysql_num_rows($result);

                return $totalMonitores;
            }
?>

<!doctype html>
<html class="fixed">
    <head>

        <!-- Basic -->
            <meta charset="UTF-8">

            <title>Panel de Socio Seven Gym</title>
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

            <!-- Specific Page Vendor CSS -->       
            <link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />       
            <link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />      
            <link rel="stylesheet" href="assets/vendor/morris/morris.css" />

            <!-- Theme CSS -->
            <link rel="stylesheet" href="assets/stylesheets/theme.css" />

            <!-- Theme Custom CSS -->
            <link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

            <!-- Head Libs -->
            <script src="assets/vendor/modernizr/modernizr.js"></script>
             <script src="assets/javascripts/dashboard/panelSocio.js"></script>

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
                               fotoSocio($_SESSION['nick']);
                               ?>
                            </figure>
                            <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                                <span class="name"><?php echo $_SESSION['nick'];?></span>
                                <span class="role"><?php echo $_SESSION['rol'];?></span>
                            </div>
            
                            <i class="fa custom-caret"></i>
                        </a>
            
                        <div class="dropdown-menu">
                            <ul class="list-unstyled">
                                <li class="divider"></li>
                               
                                <li>
                                    <a role="menuitem" tabindex="-1" href="lockPerfil.php" ><i class="fa fa-lock"></i> Bloquear Perfil</a>
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
                        <h2>Principal</h2>
                    
                        <div class="right-wrapper pull-right">
                            <ol class="breadcrumbs">
                                <li>
                                    <a href="index.html">
                                        <i class="fa fa-home"></i>
                                    </a>
                                </li>
                                <li><span>Principal</span></li>
                            </ol>
                    
                            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
                        </div>
                    </header>

                    <!-- start page-->

            <div class="row">
              
                <?php

                function nombreTarifaContratada() {
                    include 'conexion.php';
                    $id = sacarIdSocio();
                    $sql = "SELECT id_tarifa FROM socios where id_usuario=$id";
                    $result = mysql_query($sql, $conexion);
                    $fila = mysql_fetch_array($result);
                    $idtarifa = $fila[0];

                    $sql1 = "select nombre from tarifa where id=$idtarifa";
                    $result = mysql_query($sql1, $conexion);
                    $fila = mysql_fetch_array($result);
                    $nombreTarifa = $fila[0];

                    mysql_close($conexion);
                    return $nombreTarifa;
                }

                function tieneMonitor() {
                    include 'conexion.php';
                    $id = sacarIdSocio();
                    $sql = "SELECT id_monitor FROM socios where id_usuario=$id";
                    $result = mysql_query($sql, $conexion);
                    $fila = mysql_fetch_array($result);
                    $idmonitor = $fila[0];
                    $nombreMonitor = "";
                    if ($idmonitor == 0) {
                        $nombreMonitor = "no dispone de monitor";
                    } else {
                        $sql1 = "select nombre from monitores where id_usuario=$idmonitor";
                        $result = mysql_query($sql1, $conexion);
                        $fila = mysql_fetch_array($result);
                        $nombreMonitor = $fila[0];
                    }


                    mysql_close($conexion);
                    return $nombreMonitor;
                }
                
                function descuento(){
                    include 'conexion.php';
                    $id = sacarIdSocio();
                    $sql = "SELECT descuento FROM socios where id_usuario=$id";
                    $result = mysql_query($sql, $conexion);
                    $fila = mysql_fetch_array($result);
                    $descuento = $fila[0];

                    

                    mysql_close($conexion);
                    return $descuento;
                }
                ?>
                <div class="col-md-6 col-lg-12 col-xl-6">
                    <div class="row">
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <section class="panel panel-featured-left panel-featured-primary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-primary">
                                                <i class="fa fa-life-ring"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Tarifa Contratada</h4>
                                                <div class="info">
                                                    <strong class="amount"><?php echo nombreTarifaContratada() ?></strong>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <section class="panel panel-featured-left panel-featured-secondary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-secondary">
                                                <i class="fa fa-eur"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Descuento</h4>
                                                <div class="info">
                                                    <strong class="amount"><?php echo descuento(); ?> % </strong>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <section class="panel panel-featured-left panel-featured-tertiary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-tertiary">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Monitor</h4>
                                                <div class="info">
                                                    <strong class="amount"><?php echo tieneMonitor() ?></strong>
                                                </div>
                                            </div>
                                            <div class="summary-footer">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                          <div class="col-md-12 col-lg-6 col-xl-6">
                            <section class="panel panel-featured-left panel-featured-tertiary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-tertiary">
                                                <i class="fa fa-thumbs-up"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Evalua tu monitor</h4>
                                                <div class="info">
                                                    
                                                    <form action="#" method="post">
                        <button type="submit" class="mb-xs mt-xs mr-xs btn btn-success" name="positivo" > <i class="fa fa-thumbs-up"></i> </button>
                       <button type="submit" class="mb-xs mt-xs mr-xs btn btn-danger" name="negativo" > <i class="fa fa-thumbs-down"></i> </button>
                       </form>
                                                </div>
                                            </div>
                                            <div class="summary-footer">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                       
                       
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <section class="panel">
                        <header class="panel-heading">
                            <div class="panel-actions">
                                <a href="#" class="fa fa-caret-down"></a>
                                <a href="#" class="fa fa-times"></a>
                            </div>

                            <h2 class="panel-title">Progreso Inicial</h2>
                            <p class="panel-subtitle">En esta grafica podemos ver nuestros progresos anterior para poder compararlo con la grafica de los progresos actuales</p>
                        </header>
                        <div class="panel-body">
<?php

function getMedidas() {
    include 'conexion.php';
    $id = sacarIdSocio();
    $sql = "SELECT * FROM medidas where id_socio=$id";
    $result = mysql_query($sql, $conexion);

    $resultados;
    $cont = 0;
    while ($fila = mysql_fetch_array($result)) {
        $resultados[$cont] = $fila;
        $cont++;
    }
    mysql_close($conexion);
    return $resultados;
}

function sacarIdSocio() {
    $nick = $_SESSION['nick'];

    include 'conexion.php';
    $sql = "SELECT id FROM usuarios where nick='$nick'";
    $result = mysql_query($sql);

    $fila = mysql_fetch_array($result);

    $id = $fila[0];

    return $id;
}
?>
                            <!-- Flot: Basic -->
                            <div class="chart chart-md" id="flotDashBasic"></div>
                            <script>

                                var flotDashBasicData = [
                                    {
                                        data: [
<?php
$res = getMedidas();

$tam = sizeof($res) - 2;

echo "['altura'," . $res[$tam][3] . "],";
echo "['peso', " . $res[$tam][4] . "],";
echo "['antebrazo', " . $res[$tam][5] . "],";
echo "['hombro', " . $res[$tam][6] . "],";
echo "['pecho', " . $res[$tam][7] . "],";
echo "['cintura', " . $res[$tam][8] . "],";
echo "['espalda', " . $res[$tam][9] . "],";
echo "['cuadriceps', " . $res[$tam][10] . "],";
echo "['gemelos', " . $res[$tam][11] . "],";
echo "['%grasa', " . $res[$tam][12] . "],";
echo "['fuerza', " . $res[$tam][13] . "],";
echo "['resistencia', " . $res[$tam][14] . "],";

?>

                                        ],
                                        label: 'Anterior',
                                        color: '#CCCCCC'
                                    }


                                ];

                                // See: assets/javascripts/dashboard/examples.dashboard.js for more settings.

                            </script>

                        </div>
                    </section>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="fa fa-caret-down"></a>
                                    <a href="#" class="fa fa-times"></a>
                                </div>

                                <h2 class="panel-title">Progreso Actual</h2>
                                <p class="panel-subtitle">Esta grafica muestra tu progreso actual</p>
                            </header>
                            <div class="panel-body">

                                <!-- Flot: Basic -->
                                <div class="chart chart-md" id="flotDashBasic1"></div>
                                <script>

                                    var flotDashBasicData1 = [
                                        {
                                            data: [
<?php
$res = getMedidas();

$tam = sizeof($res) - 1;

echo "['altura'," . $res[$tam][3] . "],";
echo "['peso', " . $res[$tam][4] . "],";
echo "['antebrazo', " . $res[$tam][5] . "],";
echo "['hombro', " . $res[$tam][6] . "],";
echo "['pecho', " . $res[$tam][7] . "],";
echo "['cintura', " . $res[$tam][8] . "],";
echo "['espalda', " . $res[$tam][9] . "],";
echo "['cuadriceps', " . $res[$tam][10] . "],";
echo "['gemelos', " . $res[$tam][11] . "],";
echo "['%grasa', " . $res[$tam][12] . "],";
echo "['fuerza', " . $res[$tam][13] . "],";
echo "['resistencia', " . $res[$tam][14] . "],";
?>

                                            ],
                                            label: 'Actual',
                                            color: '#12fe2'
                                        }


                                    ];

                                    // See: assets/javascripts/dashboard/examples.dashboard.js for more settings.

                                </script>

                            </div>
                        </section>
                    
                    </div>
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
                <script src="assets/vendor/jquery/jquery.js"></script>      <script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>        <script src="assets/vendor/jquery-cookie/jquery.cookie.js"></script>        <script src="assets/vendor/style-switcher/style.switcher.js"></script>      <script src="assets/vendor/bootstrap/js/bootstrap.js"></script>     <script src="assets/vendor/nanoscroller/nanoscroller.js"></script>      <script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>       <script src="assets/vendor/magnific-popup/magnific-popup.js"></script>      <script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

                <!-- Specific Page Vendor -->       <script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>       <script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>        <script src="assets/vendor/jquery-appear/jquery.appear.js"></script>        <script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>        <script src="assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>        <script src="assets/vendor/flot/jquery.flot.js"></script>       <script src="assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>       <script src="assets/vendor/flot/jquery.flot.pie.js"></script>       <script src="assets/vendor/flot/jquery.flot.categories.js"></script>        <script src="assets/vendor/flot/jquery.flot.resize.js"></script>        <script src="assets/vendor/jquery-sparkline/jquery.sparkline.js"></script>      <script src="assets/vendor/raphael/raphael.js"></script>        <script src="assets/vendor/morris/morris.js"></script>      <script src="assets/vendor/gauge/gauge.js"></script>        <script src="assets/vendor/snap-svg/snap.svg.js"></script>      <script src="assets/vendor/liquid-meter/liquid.meter.js"></script>      <script src="assets/vendor/jqvmap/jquery.vmap.js"></script>     <script src="assets/vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>     <script src="assets/vendor/jqvmap/maps/jquery.vmap.world.js"></script>      <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>      <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>        <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>       <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>      <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>       <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>

                <!-- Theme Base, Components and Settings -->
                <script src="assets/javascripts/theme.js"></script>

                <!-- Theme Custom -->
                <script src="assets/javascripts/theme.custom.js"></script>

                <!-- Theme Initialization Files -->
                <script src="assets/javascripts/theme.init.js"></script>
                <!-- Analytics to Track Preview Website -->     

                <!-- Examples -->
                <script src="assets/javascripts/dashboard/panelSocio.js"></script>
    </body>
</html>
<!-- Localized -->