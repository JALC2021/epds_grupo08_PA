<?php
	$servidor="localhost";
	$usuario_bd="root";
	$clave_bd="";
	$basedatos="todoletras";
	$sql_crearbasedatos="CREATE DATABASE $basedatos;";
	
	//TABLA LIBRO
	$tabla1="libros";
	$sql_creartabla1="CREATE TABLE $tabla1(idlibro INT PRIMARY KEY NOT NULL AUTO_INCREMENT, titulo VARCHAR(100) NOT NULL, autor VARCHAR(50) NOT NULL, editorial VARCHAR(30) NOT NULL, genero VARCHAR(20) NOT NULL, anoedicion INT(4) NOT NULL, isbn VARCHAR(30) NOT NULL, imagen VARCHAR(30) NOT NULL, precio FLOAT NOT NULL,fechahora DATETIME NOT NULL, ventas FLOAT NOT NULL);";
	$sql_insertarlibro1="INSERT INTO $tabla1 VALUES (0,'Crepusculo','Stephenie Meyer','Alfaguara','Novela',2005,'978-884-20-47113','crepusculo.jpg', 14.50,2015-01-01 12:30:12, 0);";
	$sql_insertarlibro2="INSERT INTO $tabla1 VALUES (0,'Luna Nueva','Stephenie Meyer','Alfaguara','Novela',2006,'978-8483-65-1803','lunanueva.jpg', 14.50,2015-01-01 12:30:12, 0);";
	$sql_insertarlibro3="INSERT INTO $tabla1 VALUES (0,'Eclipse','Stephenie Meyer','Alfaguara','Novela',2007,'978-884-20-46928','eclipse.jpg', 14.50,2015-01-01 12:30:12, 0);";
	$sql_insertarlibro4="INSERT INTO $tabla1 VALUES (0,'Amanecer','Stephenie Meyer','Alfaguara','Novela',2008,'978-8420-40-6268','amanecer.jpg', 17.50,2015-01-01 12:30:12, 0);";
	$sql_insertarlibro5="INSERT INTO $tabla1 VALUES (0,'The Host','Stephenie Meyer','Suma','Novela',2010,'978-842-04-72331','thehost.jpg', 20.00,2015-01-01 12:30:12, 0);";
	$sql_insertarlibro6="INSERT INTO $tabla1 VALUES (0,'La segunda vida de Bree Tanner','Stephenie Meyer','Alfaguara','Novela',2010,'978-607-11-00334','breetanner.jpg', 7.90,2015-01-01 12:30:12, 0);";
	$sql_insertarlibro7="INSERT INTO $tabla1 VALUES (0,'Apocalypse','Tim Bowler','Sin limites','Novela',2004,'978-84-9759-2907','apocalypse.jpg', 10.00,2015-01-01 12:30:12, 0);";
	$sql_insertarlibro8="INSERT INTO $tabla1 VALUES (0,'El simbolo perdido','Dan Brown','Booket','Novela',2009,'978-84-9764-4742','simboloperdido.jpg', 19.60,2015-01-01 12:30:12, 0);";
	$sql_insertarlibro9="INSERT INTO $tabla1 VALUES (0,'Los pilares de la Tierra','Ken Follet','Debolsillo','Novela',1989,'978-8437-60-7710','lospilaresdelatierra.jpg', 17.80,2015-01-01 12:30:12, 0);";
	$sql_insertarlibro10="INSERT INTO $tabla1 VALUES (0,'Cumbres Borrascosas','Emily Bronte','Edimat libros','Novela',2009,'978-8437-60-7719','cumbresborrascosas.jpg', 5.00,2015-01-01 12:30:12, 0);";
	$sql_insertarlibro11="INSERT INTO $tabla1 VALUES (0,'Bajarse al moro','Jose Luis Alonso de Santos','Catedra','Novela',2005,'978-84-08-099224','bajarsealmoro.jpg', 7.00,2015-01-01 12:30:12, 0);";
	$sql_insertarlibro12="INSERT INTO $tabla1 VALUES (0,'El curso en que me enamore de ti','Blanca Alvarez','Nautilus','Novela',2004,'84-666-2471-6527','elcurso.jpg', 6.30,2015-01-01 12:30:12, 0);";
	$sql_insertarlibro13="INSERT INTO $tabla1 VALUES (0,'La catedral','Cesar Mallorqui','SM','Novela',2000,'84-348-7239-0452','lacatedral.jpg', 8.50,2015-01-01 12:30:12, 0);";
	$sql_insertarlibro14="INSERT INTO $tabla1 VALUES (0,'A tres metros sobre el cielo','Federico Moccia','Booket','Novela',2012,'9788408110491','atresmetros.jpg', 6.99,2015-01-01 12:30:12, 0);";
	$sql_insertarlibro15="INSERT INTO $tabla1 VALUES (0,'Tengo ganas de ti','Federico Moccia','Planeta','Novela',2012,'9788408095545','tengoganasdeti.jpg', 9.95,2015-01-01 12:30:12, 0);";
	$sql_insertarlibro16="INSERT INTO $tabla1 VALUES (0,'Flor del desierto','Waris Dirie','RBA','Novela',2003,'9788492695980','flordesierto.jpg', 8.20,2015-01-01 12:30:12, 0);";
	$sql_insertarlibro17="INSERT INTO $tabla1 VALUES (0,'Un burka por amor','Reyes Monforte','Temas de hoy','Novela',2007,'9788484606499','unburkaporamor.jpg', 5.20,2015-01-01 12:30:12, 0);";
	$sql_insertarlibro18="INSERT INTO $tabla1 VALUES (0,'Perdona si te llamo amor','Federico Moccia','Planeta','Novela',2009,'9788408101741','perdonasitellamo.jpg', 9.95,2015-01-01 12:30:12, 0);";
	$sql_insertarlibro19="INSERT INTO $tabla1 VALUES (0,'Perdona pero quiero casarme contigo','Federico Moccia','Planeta','Novela',2011,'9788408101758','perdonaperoquiero.jpg', 9.95,2015-01-01 12:30:12, 0);";
	
	//TABLA USUARIO
	$tabla2="usuarios";
	$sql_creartabla2="CREATE TABLE $tabla2(usuario VARCHAR(10) PRIMARY KEY NOT NULL, contrasena VARCHAR(8) NOT NULL, nombre VARCHAR(10) NOT NULL, apellidos VARCHAR(50), sexo VARCHAR(6) NOT NULL, edad VARCHAR(10) NOT NULL, dni VARCHAR(10) NOT NULL, tipo VARCHAR(15) NOT NULL);";
	$sql_insertarusuario1="INSERT INTO $tabla2 VALUES ('admin','admin', 'Administrador', 'Anonimus Anonimus', 'Hombre', '11/08/1990', '77788819Q', 'admin');";
	$sql_insertarusuario2="INSERT INTO $tabla2 VALUES ('autor','autor', 'Autor', 'Anonimus Anonimus', 'Mujer', '27/02/1991', '77269854L', 'autor');";
	$sql_insertarusuario3="INSERT INTO $tabla2 VALUES ('user','user', 'User', 'Anonimus Anonimus', 'Mujer', '30/02/1989', '79365485K', 'user');";
	
	
	//TABLA MENSAJES
	$tabla3="mensajes";
	$sql_creartabla3 = "CREATE TABLE $tabla3(idmensa INT AUTO_INCREMENT PRIMARY KEY NOT NULL, usuario CHAR(30) NOT NULL,fechahora DATETIME NOT NULL, mensaje TEXT NOT NULL);";
	//$sql_insertarmensajes1= "INSERT INTO $tabla3 VALUES (null,'patricia','2012-06-01 12:30:12','Hola, soy la asministradora.\nAdiós.'),(null,'patry','2012-06-01 12:30:12','Hola a todos, me acabo de registrar.');";
	
	//TABLA CESTA DE LA COMPRA
	$tabla4="carro";
	$sql_creartabla4="CREATE TABLE $tabla4(idlibro INT PRIMARY KEY NOT NULL AUTO_INCREMENT, titulo VARCHAR(100) NOT NULL, autor VARCHAR(50) NOT NULL, editorial VARCHAR(30) NOT NULL, genero VARCHAR(20) NOT NULL, anoedicion INT(4) NOT NULL, isbn VARCHAR(30) NOT NULL, imagen VARCHAR(30) NOT NULL, precio FLOAT NOT NULL, usuario VARCHAR(10) NOT NULL);";
	
	//TABLA VENTAS
	$tabla5="ventas";
	$sql_creartabla5="CREATE TABLE $tabla5(idlibro INT PRIMARY KEY NOT NULL AUTO_INCREMENT, titulo VARCHAR(100) NOT NULL, autor VARCHAR(50) NOT NULL, editorial VARCHAR(30) NOT NULL, genero VARCHAR(20) NOT NULL, anoedicion INT(4) NOT NULL, isbn VARCHAR(30) NOT NULL, imagen VARCHAR(30) NOT NULL, precio FLOAT NOT NULL, dia FLOAT NOT NULL, mes FLOAT NOT NULL, anio FLOAT NOT NULL);";
	
	//TABLA NOTICIAS
	$tabla6="noticias";
	$sql_creartabla6 = "CREATE TABLE $tabla6(idnot INT AUTO_INCREMENT PRIMARY KEY NOT NULL, titulo VARCHAR(100) NOT NULL,fechahora DATETIME NOT NULL, cuerpo VARCHAR(250) NOT NULL,imagen VARCHAR(30));";

	//CONEXION
	$conexion=mysql_connect($servidor,$usuario_bd,$clave_bd);
	if(!$conexion){
		echo "ERROR: Imposible establecer conexion con el servidor<br>";
		mysql_close($conexion);
		exit();
	}
	else{
		echo "Conexion establecida con el servidor: $servidor<br>";
	}
	
	$resultado=mysql_query($sql_crearbasedatos,$conexion);
	if(!$resultado){
		echo "ERROR: Imposible crear base de datos $basedatos.<br>\n";
		mysql_close($conexion);
		exit();
	}
	else{
		echo "Base de datos $basedatos creada satisfactoriamente<br>";
	}
	
	$resultado=mysql_select_db($basedatos,$conexion);
	if(!$resultado){
		echo "ERROR: Imposible seleccionar la base de datos $basedatos<br>";
		mysql_close($conexion);
		exit();
	}
	else{
		echo "Base de datos $basedatos seleccionada correctamente<br>";
	}
	
	//CREACION DE TABLAS
	$resultado=mysql_query($sql_creartabla1,$conexion);
	if(!$resultado){
		echo "ERROR: Imposible crear la tabla $tabla1<br>";
		mysql_close($conexion);
		exit();
	}
	else{
		echo "Tabla $tabla1 creada correctamente<br>";
	}
	
	$resultado=mysql_query($sql_creartabla2,$conexion);
	if(!$resultado){
		echo "ERROR: Imposible crear la tabla $tabla2<br>";
		mysql_close($conexion);
		exit();
	}
	else{
		echo "Tabla $tabla2 creada satisfactoriamente<br>";
	}
	$resultado=mysql_query($sql_creartabla3,$conexion);
	if(!$resultado){
		echo "ERROR: Imposible crear la tabla $tabla3<br>";
		mysql_close($conexion);
		exit();
	}
	else{
		echo "Tabla $tabla2 creada satisfactoriamente<br>";
	}
	
	$resultado=mysql_query($sql_creartabla4,$conexion);
	if(!$resultado){
		echo "ERROR: Imposible crear la tabla $tabla4<br>";
		mysql_close($conexion);
		exit();
	}
	else{
		echo "Tabla $tabla4 creada satisfactoriamente<br>";
	}
	
	$resultado=mysql_query($sql_creartabla5,$conexion);
	if(!$resultado){
		echo "ERROR: Imposible crear la tabla $tabla5<br>";
		mysql_close($conexion);
		exit();
	}
	else{
		echo "Tabla $tabla5 creada satisfactoriamente<br>";
	}
	
	$resultado=mysql_query($sql_creartabla6,$conexion);
	if(!$resultado){
		echo "ERROR: Imposible crear la tabla $tabla6<br>";
		mysql_close($conexion);
		exit();
	}
	else{
		echo "Tabla $tabla6 creada satisfactoriamente<br>";
	}
	
	//INSERT DE LIBROS
	$resultado=mysql_query($sql_insertarlibro1,$conexion);
	if(!$resultado){
		echo "No se han podido insertar el resgitro en la tabla $tabla1<br>";
	}
	else{
		echo "Registros insertados con exito en la tabla $tabla1<br>";
	}
	
	$resultado=mysql_query($sql_insertarlibro2,$conexion);
	if(!$resultado){
		echo "No se han podido insertar regsitros en la tabla $tabla1<br>";
	}
	else{
		echo "Registros insertados con exito en la tabla $tabla1<br>";
	}
	
	$resultado=mysql_query($sql_insertarlibro3,$conexion);
	if(!$resultado){
		echo "No se han podido insertar regsitros en la tabla $tabla1<br>";
	}
	else{
		echo "Registros insertados con exito en la tabla $tabla1<br>";
	}
	
	$resultado=mysql_query($sql_insertarlibro4,$conexion);
	if(!$resultado){
		echo "No se han podido insertar regsitros en la tabla $tabla1<br>";
	}
	else{
		echo "Registros insertados con exito en la tabla $tabla1<br>";
	}
	
	$resultado=mysql_query($sql_insertarlibro5,$conexion);
	if(!$resultado){
		echo "No se han podido insertar regsitros en la tabla $tabla1<br>";
	}
	else{
		echo "Registros insertados con exito en la tabla $tabla1<br>";
	}
	
	$resultado=mysql_query($sql_insertarlibro6,$conexion);
	if(!$resultado){
		echo "No se han podido insertar regsitros en la tabla $tabla1<br>";
	}
	else{
		echo "Registros insertados con exito en la tabla $tabla1<br>";
	}
	
	$resultado=mysql_query($sql_insertarlibro7,$conexion);
	if(!$resultado){
		echo "No se han podido insertar regsitros en la tabla $tabla1<br>";
	}
	else{
		echo "Registros insertados con exito en la tabla $tabla1<br>";
	}
	
	$resultado=mysql_query($sql_insertarlibro8,$conexion);
	if(!$resultado){
		echo "No se han podido insertar regsitros en la tabla $tabla1<br>";
	}
	else{
		echo "Registros insertados con exito en la tabla $tabla1<br>";
	}
	
	$resultado=mysql_query($sql_insertarlibro9,$conexion);
	if(!$resultado){
		echo "No se han podido insertar regsitros en la tabla $tabla1<br>";
	}
	else{
		echo "Registros insertados con exito en la tabla $tabla1<br>";
	}
	
	$resultado=mysql_query($sql_insertarlibro10,$conexion);
	if(!$resultado){
		echo "No se han podido insertar regsitros en la tabla $tabla1<br>";
	}
	else{
		echo "Registros insertados con exito en la tabla $tabla1<br>";
	}
	
	$resultado=mysql_query($sql_insertarlibro11,$conexion);
	if(!$resultado){
		echo "No se han podido insertar regsitros en la tabla $tabla1<br>";
	}
	else{
		echo "Registros insertados con exito en la tabla $tabla1<br>";
	}
	
	$resultado=mysql_query($sql_insertarlibro12,$conexion);
	if(!$resultado){
		echo "No se han podido insertar regsitros en la tabla $tabla1<br>";
	}
	else{
		echo "Registros insertados con exito en la tabla $tabla1<br>";
	}
	
	$resultado=mysql_query($sql_insertarlibro13,$conexion);
	if(!$resultado){
		echo "No se han podido insertar regsitros en la tabla $tabla1<br>";
	}
	else{
		echo "Registros insertados con exito en la tabla $tabla1<br>";
	}
	
	$resultado=mysql_query($sql_insertarlibro14,$conexion);
	if(!$resultado){
		echo "No se han podido insertar regsitros en la tabla $tabla1<br>";
	}
	else{
		echo "Registros insertados con exito en la tabla $tabla1<br>";
	}
	
	$resultado=mysql_query($sql_insertarlibro15,$conexion);
	if(!$resultado){
		echo "No se han podido insertar regsitros en la tabla $tabla1<br>";
	}
	else{
		echo "Registros insertados con exito en la tabla $tabla1<br>";
	}
	
	$resultado=mysql_query($sql_insertarlibro16,$conexion);
	if(!$resultado){
		echo "No se han podido insertar regsitros en la tabla $tabla1<br>";
	}
	else{
		echo "Registros insertados con exito en la tabla $tabla1<br>";
	}
	
	$resultado=mysql_query($sql_insertarlibro17,$conexion);
	if(!$resultado){
		echo "No se han podido insertar regsitros en la tabla $tabla1<br>";
	}
	else{
		echo "Registros insertados con exito en la tabla $tabla1<br>";
	}
	
	$resultado=mysql_query($sql_insertarlibro18,$conexion);
	if(!$resultado){
		echo "No se han podido insertar regsitros en la tabla $tabla1<br>";
	}
	else{
		echo "Registros insertados con exito en la tabla $tabla1<br>";
	}
	
	$resultado=mysql_query($sql_insertarlibro19,$conexion);
	if(!$resultado){
		echo "No se han podido insertar regsitros en la tabla $tabla1<br>";
	}
	else{
		echo "Registros insertados con exito en la tabla $tabla1<br>";
	}
	
	
	//INSERT DE USUARIO
	$resultado=mysql_query($sql_insertarusuario1,$conexion);
	if(!$resultado){
		echo "No se han podido insertar regsitros en la tabla $tabla2<br>";
	}
	else{
		echo "Registros insertados con exito en la tabla $tabla2<br>";
	}
	
	$resultado=mysql_query($sql_insertarusuario2,$conexion);
	if(!$resultado){
		echo "No se han podido insertar regsitros en la tabla $tabla2<br>";
	}
	else{
		echo "Registros insertados con exito en la tabla $tabla2<br>";
	}
	
	$resultado=mysql_query($sql_insertarusuario3,$conexion);
	if(!$resultado){
		echo "No se han podido insertar regsitros en la tabla $tabla2<br>";
	}
	else{
		echo "Registros insertados con exito en la tabla $tabla2<br>";
	}
	
	/*//INSERT DE MENSAJES	
	$resultado=mysql_query($sql_insertarmensajes1,$conexion);
	if(!$resultado){
		echo "No se han podido insertar regsitros en la tabla $tabla3<br>";
	}
	else{
		echo "Registros insertados con exito en la tabla $tabla3<br>";
	}*/
	
	//MOSTRAR TABLA LIBROS
	$consulta1="SELECT * FROM $tabla1;";
	$resultado=mysql_query($consulta1,$conexion);
	if(!$resultado){
		echo "Imposible obtener los registros<br>";
	}
	else{
		echo"<br>REGISTROS:<br>\n";
		while($fila=mysql_fetch_row($resultado)){
			echo "$fila[0] : $fila[1] : $fila[2] : $fila[3] : $fila[4] : $fila[5] : $fila[6] : $fila[7] : $fila[8] : $fila[9] : $fila[10]<br>";
		}
	}
	
	//MOSTRAR TABLA USUARIO
	$consulta2="SELECT * FROM $tabla2;";
	$resultado=mysql_query($consulta2,$conexion);
	if(!$resultado){
		echo "Imposible obtener los registros<br>";
	}
	else{
		echo"<br>REGISTROS:<br>\n";
		while($fila=mysql_fetch_row($resultado)){
			echo "$fila[0] : $fila[1] : $fila[2]<br>";
		}
	}
	
	//MOSTRAR TABLA MENSAJES
	$consulta3="SELECT * FROM $tabla3;";
	$resultado=mysql_query($consulta3,$conexion);
	if(!$resultado){
		echo "Imposible obtener los registros<br>";
	}
	else{
		echo"<br>REGISTROS:<br>\n";
		while($fila=mysql_fetch_row($resultado)){
			echo "$fila[0] : $fila[1] : $fila[2] : $fila[3]<br>";
		}
	}

	mysql_close($conexion);
	echo "<br>FIN.<br>";
?>