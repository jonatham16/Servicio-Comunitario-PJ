<?php
require_once ("../../lib/funciones.php");
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Mantener relaci&oacute;n rol-privilegio</title>
	<link rel="stylesheet" href="../../css/start/jquery-ui-1.8.17.custom.css"  />
	<link href="../../css/style.css" rel="stylesheet" type="text/css" />
    <link href="../../css/layout.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../../css/style-Formularios.css">
	<script src="../../js/jquery-1.7.1.min.js" type="text/javascript"></script>
	<script src="../../js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>
	<script src="../../js/efectos.js" ></script>
    <script src="../../js/funcionalidades.js" ></script>
	<style>
	.ui-button { margin-left: -1px; }
	.ui-button-icon-only .ui-button-text { padding: 0.35em; } 
	.ui-autocomplete-input { margin: 0; padding: 0.48em 0 0.47em 0.45em; }
	</style>
	<script>
	$(document).ready(function(){
		$('h3').addClass("ui-widget-header ui-corner-top ui-corner-bottom");
		$('th').addClass("ui-widget-header ui-corner-top");
        $('td').addClass("ui-widget-content");
	  
		agergarEfectoSelect();
		agregarCaracteristicasBotones();
		
		$("select").combobox();
		
		
		
	
	 	
          $('#formu').submit(function(evento){ //en el evento submit del fomulario
	          evento.preventDefault();  //detenemos el comportamiento por default
 			if(confirm("Esta Seguro?")){
			  var url = $(this).attr('action');  //la url del action del formulario
			//  var url = "insertar.php";  se puede usar la anterior modalidad o esta. La anterior se apega mas al uso de los formularios pero ambas hacen lo MISMO :D
			  var datos = $(this).serialize(); // los datos del formulario, nos evitamos cosas como estas> data: "nombre="+nombre+"&apellido="+apellido LO MAXIMO pa la pereza :D
			  $.ajax({
				  type: 'POST',
				  url: url,
				  data: datos, 
				  success: function(msg){
						alert(msg);    
						location.reload();                                  
					   }
			   });
 			}
          });
	  $('.botonEliminar').click(function(){
	
	                  if(confirm("Esta Seguro de eliminar?")){
						
	                     var id= $(this).attr("value");	

		                   $.ajax({
		                       url: "eliminar.php",
    	                       	       type: "POST",
		                       data: "var="+id,
		                       dataType: "JSON",
			                   success: function(msg){
			                   alert(msg);
    		                   location.reload();                                  
	 		                   }
	  	                   });
	                   } 
          });
					 
	  $('.botonModificar').click(function(){
	
	   		var id= $(this).attr("value");			  
			var sel_rol =  $("#sel_rol"+id).attr("value");
 	        var sel_privilegio = $("#sel_privilegio"+id).attr("value");
				
	    		
			        if(confirm("Esta Seguro?")){
				        $.ajax({
				           url: "modificar.php",
	    	                   	   type: "POST",
				           data: "orig="+id+"&dest="+sel_rol+"_"+sel_privilegio,
				           dataType: "JSON",
					       success: function(msg){
								alert(msg);
								location.reload();                                  
							}
		  	                });
			        }
			
           });
	
	});
	</script>
</head>
<body id="page6">
	<div id="main">
		<div id="header">
			<div class="row-1">
         	<div class="indent"><a href="index.html"><img alt="" src="images/logo.jpg" /></a></div>
         </div>
			<div class="row-2">
         	<ul id="site-nav">
            	<li><a href="index.html">inicio</a></li>
               <li><a href="index-1.html">nuestra misi&oacute;n</a></li>
               <li><a href="index-2.html">comunidad</a></li>
               <li><a href="index-3.html">donaciones</a></li>
               <li><a href="index-4.html">noticias y eventos</a></li>
               <li><a href="index-5.html">contacto</a></li>
            </ul>
         </div>
         <div class="row-3">
         	<em id="slogan">Dios Te Ha Elegido</em>
            <strong>Fusce feugiat malesuada odibi nunc odgravida arsus</strong><br />
            <p>Tulorecenas tristique orci ac ss ultricies pharetra nec accumsan orcnec sit ameter erorem ipsum dolor sit ansectetueripiscing elitauristum.</p>
            <div class="wrapper"><a class="link1" href="#"><b>leer mas</b></a></div>
         </div>
		</div>
		<!-- content -->
		<div id="content" >
		<!-- Empieza codigo especifico-->
                <div class="titulo">
                    <h3 style="text-align:center">MANTENER RELACI&Oacute;N ROL-PRIVILEGIO</h3>
                </div>
			<div class="row-2">	
				<form action="insertar.php" id="formu" method="post">
					<div id="formulario" class="ui-widget" >
					<div class="ui-widget-content contenido" style="width:84%;">
					<?php
					$rol = listadoRol();
					echo 'Selecciona Rol <select name="sel_rol" id = "sel_rol">';
						$nfilas = count($rol);
						for($i=0;$i<$nfilas;$i++){
							echo '<option value="'.$rol[$i][0].'">'.$rol[$i][1].'</option>';
						}
					echo '</select> <br />' ;

					?> 
					</div>
					<div class="ui-widget-content contenido" style="width:84%;">
					<?php
					$pri = listadoPrivilegio();
					echo 'Selecciona Privilegio <select name="sel_privilegio" id = "sel_privilegio">';
						$nfilas = count($pri);
						for($i=0;$i<$nfilas;$i++){
							echo '<option value="'.$pri[$i][0].'">'.$pri[$i][1].'</option>';
						}
					echo '</select> <br />';
					$rp = listadoRol_Privilegio();
					$nfilas=count($rp);
					?>
					</div>
					<div style="height:20px;clear:both"></div>
					<p align="center">					
						<button type="submit" id="botonGuardar" >Guardar</button>
					</p>
					<?php
					if($nfilas==0){
							echo "No hay Grupitos\n";
					}else {
					?>

					</div>
				</form>
			</div>
			<div id="listadoSacerdotes" class="ui-widget" >
				<table>			<tr>
								<th style="width:6%;height:30px" colspan="2">&nbsp;</th>
								<th >Rol</th>
								<th >Privilegio</th>
								</tr>
								<?php 
								for ($i=0;$i<$nfilas;$i++){
								?>
								<tr>
									<td>
										<button class="botonModificar" style="width:25px; height:25px;" value="<?php echo $rp[$i][0]."_".$rp[$i][2]; ?>">&nbsp;</button>
									</td>
									<td>
										<button class="botonEliminar" style="width:25px; height:25px;" value="<?php echo $rp[$i][0]."_".$rp[$i][2]; ?>">&nbsp;
										</button>
									</td>								 
									<td>
											<?php  
										 //rol
											echo '<select name="sel_rol'.$rp[$i][0]."_".$rp[$i][2].'" id = "sel_rol'.$rp[$i][0]."_".$rp[$i][2].'">';
												$nfilasRol = count($rol);
												for($j=0;$j<$nfilasRol;$j++){										
													echo '<option value="'.$rol[$j][0].'"';
														if($rp[$i][0] == $rol[$j][0]) echo " selected";
													echo '>'.$rol[$j][1].'</option>';													
												}
											echo '</select>' ;
										 
										 ?>
									</td>
									<td>
									 <?php  
										echo '<select name="sel_privilegio'.$rp[$i][0]."_".$rp[$i][2].'" id = "sel_privilegio'.$rp[$i][0]."_".$rp[$i][2].'">';
											$nPriv = count($pri);
											for($j=0;$j<$nPriv;$j++){												
												echo '<option value="'.$pri[$j][0].'"';
													if($rp[$i][2] == $pri[$j][0]) echo " selected";
												echo '>'.$pri[$j][1].'</option>';
											}
										echo '</select>';
									 
									 ?>
									</td>
								</tr>
								<?php
								}								
								?>
				</table>
			</div>
			<?php


			}
			?>
		</div>
					<!-- footer -->		
						<div id="footer">
						<div class="left">
							<div class="right">
								<div class="indent">
								  <ul id="footer-nav">
									 <li><a href="index.html">inicio</a></li>
									 <li><a href="index-1.html">nuestra misi&oacute;n</a></li>
									 <li><a href="index-2.html">Comunidad</a></li>
									 <li><a href="index-3.html">donaciones</a></li>
									 <li><a href="index-4.html">noticias y eventos</a></li>
									 <li><a href="index-5.html">contacto</a></li>
								  </ul> 
							   </div>
							</div>
						 </div>
					</div>

	</div>
</body>
</html>
