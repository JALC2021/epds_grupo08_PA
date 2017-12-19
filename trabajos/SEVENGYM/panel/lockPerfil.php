<?php
session_start();
$nick=$_SESSION['nick'];
$rol=$_SESSION['rol'];

if(isset($_POST['desbloquear'])){
    comprobar($nick,$rol);
}
function comprobar($nick,$rol){
    $contrasena=md5($_POST['pwd']);
   	
    include 'conexion.php';
	if(!isset($contrasena)){
		  ?><div class="alert alert-danger"><p class="m-none text-semibold h6">Error la contraseña es incorrecta</p></div> <?
	}else{
			
		$sql = "select nick,rol,password from usuarios where nick = '$nick' and rol = '$rol' and password='$contrasena'";
		$result = mysql_query($sql,$conexion);
		$filas = mysql_fetch_row($result);
		if($filas[2]==$contrasena && $rol=="admin"){
			header("Location:indexAdmin.php");
		}else if($filas[2]==$contrasena && $rol=="monitor"){
			 header("Location:indexMonitor.php");
		}else if($filas[2]==$contrasena && $rol=="socio"){
			 header("Location:indexSocio.php");
		}
		else{
			?><div class="alert alert-danger"><p class="m-none text-semibold h6">Error la contraseña es incorrecta</p></div> <?
		}
	}
    mysql_close($conexion);
    return $filas;
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

}
function fotoSocio($user)
{
    include 'conexion.php';
    $sql="select t1.foto_usuario from socios as t1 join usuarios as t2 where t1.id_usuario = t2.id and t2.id=".$_SESSION['id']."";
    $result=mysql_query($sql,$conexion);
    $r=mysql_fetch_row($result);
   
    if($r>1 && $r[0]!="")
    {
       
        echo  "<img src='./fotos/$r[0]' alt='foto monitor' class='img-circle user-image' data-lock-picture='./fotos/$r[0]' />";
    }
    else{
         echo  "<img src='./assets/images/sinFoto.jpg' alt='foto monitor' class='img-circle user-image' data-lock-picture='./assets/images/sinFoto.jpg' />";

    }

}
?>
<!doctype html>
<html class="fixed">
    <head>

        <!-- Basic -->
        <meta charset="UTF-8">

        <title>Panel de Administración Seven Gym</title>
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

    <body class="show-lock-screen">
       <div class="mfp-bg mfp-lock-screen mfp-ready"></div>
       <div class="mfp-wrap mfp-auto-cursor mfp-lock-screen mfp-ready">
        <div class="mfp-container mfp-s-ready mfp-inline-holder">
        <section  class="body-sign body-locked body-locked-inline">
                        <div class="center-sign">
                            <div class="panel panel-sign">
                                <div class="panel-body">
                                    <form action="#" method="post">
                                        <div class="current-user text-center">
                                            <?php 
                                            if($rol=="admin"){
                                                fotoAdmin($nick);
                                                
                                            }
                                            else if($rol=="monitor"){
                                                fotoMonitor($nick);
                                              
                                            }else if($rol=="socio")
                                            {
                                                fotoSocio($nick);
                                               
                                            }

                                            ?>
                                            <!--<img id="LockUserPicture" src="" alt="foto" class="img-circle user-image" />-->
                                            <h2  class="user-name text-dark m-none"><?php echo $nick;?></h2>
                                            <!--<p  id="LockUserEmail" class="user-email m-none">email</p>-->
                                        </div>
                                        <div class="form-group mb-lg">
                                            <div class="input-group input-group-icon">
                                                <input  name="pwd" type="password" class="form-control input-lg" placeholder="Password" />
                                                <span class="input-group-addon">
                                                    <span class="icon icon-lg">
                                                        <i class="fa fa-lock"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-6">
                                                <p class="mt-xs mb-none">
                                                    <a href="restaurarPass.php">¿Ha olvidado su contraseña?</a>
                                                </p>
                                            </div>
                                            <div class="col-xs-6 text-right">
                                                <button type="submit" class="btn btn-primary" name="desbloquear">Desbloquear</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
              </div>
          </div>
          <!-- Vendor -->
        <script src="assets/vendor/jquery/jquery.js"></script>      <script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>        <script src="assets/vendor/jquery-cookie/jquery.cookie.js"></script>        <script src="assets/vendor/style-switcher/style.switcher.js"></script>      <script src="assets/vendor/bootstrap/js/bootstrap.js"></script>     <script src="assets/vendor/nanoscroller/nanoscroller.js"></script>      <script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>       <script src="assets/vendor/magnific-popup/magnific-popup.js"></script>      <script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
        
        <!-- Specific Page Vendor -->       <script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>       <script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>        <script src="assets/vendor/jquery-appear/jquery.appear.js"></script>        <script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>        <script src="assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>        <script src="assets/vendor/flot/jquery.flot.js"></script>       <script src="assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>       <script src="assets/vendor/flot/jquery.flot.pie.js"></script>       <script src="assets/vendor/flot/jquery.flot.categories.js"></script>        <script src="assets/vendor/flot/jquery.flot.resize.js"></script>        <script src="assets/vendor/jquery-sparkline/jquery.sparkline.js"></script>      <script src="assets/vendor/raphael/raphael.js"></script>        <script src="assets/vendor/morris/morris.js"></script>      <script src="assets/vendor/gauge/gauge.js"></script>        <script src="assets/vendor/snap-svg/snap.svg.js"></script>      <script src="assets/vendor/liquid-meter/liquid.meter.js"></script>      <script src="assets/vendor/jqvmap/jquery.vmap.js"></script>     <script src="assets/vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>     <script src="assets/vendor/jqvmap/maps/jquery.vmap.world.js"></script>      <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>      <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>        <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>       <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>      <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>       <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>
        
     
    </body>
</html>
<!-- Localized -->