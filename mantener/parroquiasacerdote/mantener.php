<?php
require_once ("../../lib/funciones.php");
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>ASIGNAR SACERDOTES A PARROQUIAS</title>
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
		$("#fechaini").datepicker({ dateFormat: 'yy-mm-dd' });
		$("#fechafin").datepicker({ dateFormat: 'yy-mm-dd' });
		
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
			var sel_sar =  $("#sel_sar"+id).attr("value");
 	       		 var sel_par = $("#sel_par"+id).attr("value");
			var ini=$("#desde"+id).attr("value");	
	    		var fin=$("#hasta"+id).attr("value");
	
			        if(confirm("Esta Seguro?")){
				        $.ajax({
				           url: "modificar.php",
	    	                   	   type: "POST",
				           data: "orig="+id+"&dest="+sel_sar+"_"+sel_par+"&inicio="+ini+"&fin="+fin,
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
                    <h3 style="text-align:center">ASIGNAR SACERDOTES A PARROQUIAS</h3>
                </div>
			<div class="row-2">	
				<form action="insertar.php" id="formu" method="post">
					<div id="formulario" class="ui-widget" >
					<div class="ui-widget-content contenido" style="width:49%;">
					<?php
					$sar = listadoSacerdotes();
					echo 'Seleccione sacerdote <select name="sel_sar" id = "sel_sar">';
						$nfilas = count($sar);
						for($i=0;$i<$nfilas;$i++){
							echo '<option value="'.$sar[$i][0].'">'.$sar[$i][1].'</option>';
						}
					echo '</select> <br />' ;

					?> 
					</div>
					<div class="ui-widget-content contenido" style="width:45%;">
					<?php
					$par = listadoParroquia();
					echo 'Selecciona Parroquia <select name="sel_par" id = "sel_par">';
						$nfilas = count($par);
						for($i=0;$i<$nfilas;$i++){
							echo '<option value="'.$par[$i][0].'">'.$par[$i][2].'</option>';
						}
					echo '</select> <br />';
					$rp = listadoparroquia_sacerdore();
					$nfilas=count($rp);
					?>
					</div>
					<div class="ui-widget-content contenido" style="width:49%;">
					Fecha de Inicio de Actividades:<input type="text" name="fechaini" id="fechaini" />
					</div>	
					<div class="ui-widget-content contenido" style="width:45%;">
					Fecha de Fin de Actividades:<input type="text" name="fechafin" id="fechafin" />
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
								<th >Sacerdote</th>
								<th >Parroquia</th>
								<th >Fecha de Inicio de Actividades</th>
								<th >Fecha de Fin de Actividades</th>
								</tr>
								<?php 
								for ($i=0;$i<$nfilas;$i++){
								?>
								<tr>
									<td>
										<button class="botonModificar" style="width:25px; height:25px;" value="<?php echo $rp[$i][0]."_".$rp[$i][1]; ?>">&nbsp;</button>
									</td>
									<td>
										<button class="botonEliminar" style="width:25px; height:25px;" value="<?php echo $rp[$i][0]."_".$rp[$i][1]; ?>">&nbsp;
										</button>
									</td>								 
									<td>
											<?php  
										 //rol
											echo '<select name="sel_sar'.$rp[$i][0]."_".$rp[$i][1].'" id = "sel_sar'.$rp[$i][0]."_".$rp[$i][1].'">';
												$nfilassar = count($sar);
												for($j=0;$j<$nfilassar;$j++){										
													echo '<option value="'.$sar[$j][0].'"';
														if($rp[$i][0] == $sar[$j][0]) echo " selected";
													echo '>'.$sar[$j][1].'</option>';													
												}
											echo '</select>' ;
										 
										 ?>
									</td>
									<td>
									 <?php  
										echo '<select name="sel_par'.$rp[$i][0]."_".$rp[$i][1].'" id = "sel_par'.$rp[$i][0]."_".$rp[$i][1].'">';
											$npar = count($par);
											for($j=0;$j<$npar;$j++){												
												echo '<option value="'.$par[$j][0].'"';
													if($rp[$i][1] == $par[$j][0]) echo " selected";
												echo '>'.$par[$j][2].'</option>';
											}
										echo '</select>';
									 
									 ?>
									</td>
									<td>
									<?php
									echo '<input id="desde'.$rp[$i][0]."_".$rp[$i][1].'" value='.$rp[$i][4].' name="" type="text" required />';
									?>
									
									</td>
									<td>
									<?php
									echo '<input id="hasta'.$rp[$i][0]."_".$rp[$i][1].'" value='.$rp[$i][5].' name="" type="text" required />';
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
