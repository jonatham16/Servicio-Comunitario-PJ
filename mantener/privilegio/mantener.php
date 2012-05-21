<?php
require_once ("../../lib/funciones.php");
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Mantener Privilegios</title>
	<link rel="stylesheet" href="../../css/start/jquery-ui-1.8.17.custom.css"  />
	<link href="../../css/style.css" rel="stylesheet" type="text/css" />
    <link href="../../css/layout.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../../css/style-Formularios.css">
	<script src="../../js/jquery-1.7.1.min.js" type="text/javascript"></script>
	<script src="../../js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>
	<script src="../../js/efectos.js" ></script>
    <script src="../../js/funcionalidades.js" ></script>
	<script>
	$(document).ready(function(){
		$('h3').addClass("ui-widget-header ui-corner-top ui-corner-bottom");
		$('th').addClass("ui-widget-header ui-corner-top");
        $('td').addClass("ui-widget-content");
		
		agergarEfectoSelect();
		agregarCaracteristicasBotones();
	 	
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
					   }
			   });
 			}
          });
	  $('.botonEliminar').click(function(){
	
	                  if(confirm("Esta Seguro?")){
	
	                     var id= $(this).attr("value");	
	                     
		                   $.ajax({
		                       url: "eliminar.php",
    	                       	       type: "POST",
		                       data: "id="+id,
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
			var nombre =  $("input#nombre"+id).attr("value");
 	                var descripcion = $("input#descripcion"+id).attr("value");
			
	    		if(id!="" && nombre!="" && descripcion!=""){
			        if(confirm("Esta Seguro?")){
				        $.ajax({
				           url: "modificar.php",
	    	                   	   type: "POST",
				           data: "id="+id+"&descripcion="+descripcion+"&nombre="+nombre,
				           dataType: "JSON",
					       success: function(msg){
					       alert(msg);
	    		               location.reload();                                  
		 		               }
		  	                });
			        }
			}else alert("Debe rellenar todos los campos");
           });
	
	});
	</script>
</head>
<body id="page6">
	<div id="main">
		<!-- header -->
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
                    <h3 style="text-align:center">MANTENER PRIVILEGIOS</h3>
                </div>
		<div class="row-2">
			<form action="insertar.php" id="formu" method="post">
				<div class="ui-widget-content contenido" style="width:84%;">
					Nombre:<input type="text" name="nombre" id="nombre" required placeholder="Escriba aqui el nombre" style="width:90%; float:right;"/>
				</div>
				<div class="ui-widget-content contenido" style="width:84%;">
					Descripci&oacute;n:<input type="text" name="descripcion" id="descripcion" required placeholder="Escriba aqui la descripcion"style="width:90%; float:right;"/>
				</div>
				<div style="height:20px;clear:both"></div>
	                <p align="center"><button type="submit" id="botonGuardar" >Guardar</button></p>				
			</form>
		</div>

		<?php

					$privilegio=listadoPrivilegio();
					$nfilas=count($privilegio);
					if($nfilas==0){
						echo "No hay Grupitos\n";

					}else{
					?>
									  <table>
										<th style="width:6%;height:30px"  colspan="2">&nbsp;</th>
										<th >NOMBRE</th>
										<th >DESCRIPCI&Oacute;N</th>
					<?php
						for($i=0;$i<$nfilas;$i++){
					?>		
											<tr>
												<td><button class="botonModificar" style="width:25px; height:25px;" value="<?php echo $privilegio[$i][0]; ?>">&nbsp;</button></td>
												<td><button class="botonEliminar" style="width:25px; height:25px;" value="<?php echo $privilegio[$i][0]; ?>">&nbsp;</button></td>
											   
											   
												<td><input id="nombre<?php  echo $privilegio[$i][0]; ?>" name"" type="text" value="<?php echo $privilegio[$i][1]; ?>" required /></td>						
												
												<td><input id="descripcion<?php echo $privilegio[$i][0]; ?>" value="<?php echo $privilegio[$i][2]; ?>" name="" type="text" required /></td>                     
											</tr>

					<?php 
						}
						 } 
					?>
					</table>
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
