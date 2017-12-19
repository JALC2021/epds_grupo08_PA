<?php
session_start();

?>
<html>
<head>
<meta charset="UTF-8">

<style>



</style>


</head>
<body>
		<div class="panel">
			<div class="panel-body">
										<div>
										
											<h2 style="font-size:40px">Factura</h2>
											<h4 class="h4 m-none text-dark text-bold" ><?php echo $_SESSION['idPago'];  ?></h4>
										


											<table>
											<td style="width:400;">
												Seven Gym
												<br/>
												C/paraiso nº 25
												<br/>
												Telefono: 695646255
												<br/>
												sevengym@sevengym.com
											</td>

											<td style="width:1000px;">
												<img src="assets/images/logo.png" alt="OKLER Themes" />
											</td>	
											
											</table>
												
										</div>
										

										<br>
										<br>
										<br>
										<br>
								
											<div>
												<p style="font-size:15px">Socio:</p>
												<address>
													<?php
														echo $_SESSION['datoSocio1'];
														echo "<br>";
														echo $_SESSION['datoSocio2'];
														echo "<br>";
														echo $_SESSION['datoSocio3'];
														echo "<br>";
														echo $_SESSION['datoSocio4'];
														echo "<br>";
														echo $_SESSION['datoSocio5'];
														echo "<br>";
													?>
												</address>
											</div>
									


								<br>
								<br>
								<br>
								<br>
										<table>
											<thead>
												<tr>
													<th style="width=500px" class="text-dark" >Fecha Actual:</th>
													<th style="width=500px" class="text-dark">Fecha Factura:</th>
												</tr> 

											</thead>
											<tbody>
												<tr>
													<td class="value"><?php echo $_SESSION['fechaActual']?></td>
													<td class="value"><?php echo $_SESSION['fechaPago'] ?></td>
												</tr>
											</tbody>
										</table>
							
								<br>
								<br>
								<br>
							
								<div >
									<table style="font-size:20px">
										<thead>
											<tr >
												<th id="cell-id"    style="width:200px;"  class="text-semibold">#</th>
												<th id="cell-item"  style="width:200px;" class="text-semibold">Tarifa</th>
												<th id="cell-desc"  style="width:200px;" class="text-semibold">Descripcion</th>
												<th id="cell-price" style="width:200px;" class="text-center text-semibold">Precio</th>
												<th id="cell-total" style="width:200px;" class="text-center text-semibold">Pagado</th>
											</tr>
										</thead>
										<tbody>
											<tr >
												<?php 
													echo $_SESSION['datosFactura1'];
													echo $_SESSION['datosFactura2'];
													echo $_SESSION['datosFactura3'];
													echo $_SESSION['datosFactura4'];
													echo $_SESSION['datosFactura5'];
												?>
											</tr>
											
										</tbody>
									</table>
								</div>
								<br>
								
								
											<table >
												<thead>
												<tr>
														<th colspan="2" style="font-size:25px" >Total:</th>
												</tr>
												</thead>
												<tbody>
													<tr >
														
														<td style="font-size:20px" ><?php echo $_SESSION['totalPagado'] ?> €</td>
													</tr>
												</tbody>
											</table>

								
										
							
</div>	
							
</div>	
</body>
</html>



