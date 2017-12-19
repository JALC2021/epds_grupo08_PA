<?php
session_start();
if(isset($_SESSION['rol'])==NULL or $_SESSION['rol']!='monitor'){
    header("Location:404.html");
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

        <!-- Specific Page Vendor CSS -->       <link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />       <link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />      <link rel="stylesheet" href="assets/vendor/morris/morris.css" />

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
                               fotoMonitor($_SESSION['nick']);
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
            <?php
            
            function sacarIdMonitor() {
                $nick = $_SESSION['nick'];

                include 'conexion.php';
                $sql = "SELECT id FROM usuarios where nick='$nick'";
                $result = mysql_query($sql);

                $fila = mysql_fetch_array($result);

                $id = $fila[0];

                return $id;
            }

            function totalSociosAsociadosMonitor() {
                include 'conexion.php';

                $id = sacarIdMonitor();

                $sql = "SELECT * FROM socios where id_monitor=$id";
                $result = mysql_query($sql);

                $totalSocios = mysql_num_rows($result);

                return $totalSocios;
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

            function notaTotalMonitor() {
                include 'conexion.php';
                $id = sacarIdMonitor();
                $sql = "SELECT popularidad, numero_votos FROM monitores where id_usuario=$id";
                $result = mysql_query($sql);

                $fila = mysql_fetch_array($result);

                $popularidad = $fila[0];
                $totalVotos = $fila[1];

                if ($totalVotos == 0) {
                    $notaFinal = 0;
                } else {
                    $notaFinal = $popularidad / $totalVotos;
                }
                return $notaFinal;
            }

            function totalVotos() {
                include 'conexion.php';
                $id = sacarIdMonitor();
                $sql = "SELECT numero_votos FROM monitores where id_usuario=$id";
                $result = mysql_query($sql);

                $fila = mysql_fetch_array($result);


                $totalVotos = $fila[0];



                return $totalVotos;
            }

            function numeroEntrenamientos() {
                include 'conexion.php';
                $id = sacarIdMonitor();
                $sql = "SELECT * FROM entrenamiento where id_entrenador=$id";
                $result = mysql_query($sql);
                $entrenamientos = mysql_num_rows($result);
                return $entrenamientos;
            }

            function nombreEntrenamiento() {
                include 'conexion.php';
                $id = sacarIdMonitor();
                $sql = "SELECT nombre, num_ejercicio from entrenamiento where id_entrenador=$id";

                $result = mysql_query($sql);
                $array[] = null;
                $cont = 0;
                while ($fila = mysql_fetch_array($result)) {
                    $nombre = $fila[0];
                    $array[$cont] = $nombre;
                    $cont++;
                }
                return $array;
            }

            function ejerciciosEntrenamiento($nombre) {
                include 'conexion.php';
                $sql = "SELECT num_ejercicio from entrenamiento where nombre='$nombre'";
                $result = mysql_query($sql);

                $fila = mysql_fetch_array($result);
                $numEjercicios = $fila[0];

                return $numEjercicios;
            }

            function prueba() {
                $retu = nombreEntrenamiento();
                for ($index = 0; $index < sizeof($retu); $index++) {
                    $nombre = $retu[$index];
                    $numEjer = ejerciciosEntrenamiento($nombre);

                    $strin = "['$nombre', 23]";
                    echo $strin;
                }
            }
            ?>
            <div class="row">
                <div class="col-md-6 col-lg-12 col-xl-6">
                    <section class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="chart-data-selector" id="salesSelectorWrapper">
                                        <h2>
                                            Entrenamientos:
                                            <strong>
                                                <select class="form-control" id="salesSelector">
                                                    <option value="Porto Admin" selected>Numero Ejercicios</option>

                                                </select>
                                            </strong>
                                        </h2>

                                        <div id="salesSelectorItems" class="chart-data-selector-items mt-sm">
                                            
                                            <div class="chart chart-sm" data-sales-rel="Porto Admin" id="flotDashSales1" class="chart-active"></div>


                                           
                                            

                                            <script>

                                                var flotDashSales1Data = [{
                                                        data: [
                                                            //flotDashSales1Data.push(["abc",312]);
<?php
$retu = nombreEntrenamiento();
for ($index = 0; $index < sizeof($retu); $index++) {
    
    $nombre = $retu[$index];
    $numEjer = ejerciciosEntrenamiento($nombre);
    echo " ['  $nombre ',  $numEjer] ,";
}
?>



                                                        ],
                                                        color: "#EFA740"
                                                    }];
// See: assets/javascripts/dashboard/examples.dashboard.js for more settings.

                                            </script>


                                        </div>

                                    </div>
                                </div>



                                <div class="col-lg-4 text-center">
                                    <h2 class="panel-title mt-md">Nota</h2>
                                    <div class="liquid-meter-wrapper liquid-meter-sm mt-lg">
                                        <div class="liquid-meter">
                                            <meter min="0" max="5" value="<?php echo notaTotalMonitor(); ?>" id="meterSales"></meter>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-6 col-lg-12 col-xl-6">
                    <div class="row">
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <section class="panel panel-featured-left panel-featured-primary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-primary">
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Nota Monitor</h4>
                                                <div class="info">
                                                    <strong class="amount"><?php
echo notaTotalMonitor();
echo "/10";
?></strong>
                                                    <span class="text-primary">(<?php echo totalVotos(); ?> votos)</span>
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
                            <section class="panel panel-featured-left panel-featured-secondary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-secondary">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Socios Monitor</h4>
                                                <div class="info">
                                                    <strong class="amount"><?php echo totalSociosAsociadosMonitor(); ?></strong>
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
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Entrenamientos</h4>
                                                <div class="info">
                                                    <strong class="amount"><?php echo numeroEntrenamientos() ?></strong>
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
        <!-- Analytics to Track Preview Website -->     <script>          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)         })(window,document,'script','//www.google-analytics.com/analytics.js','ga');        ga('create', 'UA-42715764-8', 'auto');          ga('send', 'pageview');       </script>

        <!-- Examples -->
        <script src="assets/javascripts/dashboard/examples.dashboard.js"></script>
    </body>
</html>
<!-- Localized -->