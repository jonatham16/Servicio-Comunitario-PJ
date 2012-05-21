<?php
require_once ("../../lib/funciones.php");
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Mantener Parroquia</title>
<style type="text/css">

          
          #testTable { 
            width : 350px;
            margin-left: auto; 
            margin-right: auto; 
          }
          
          #tablePagination { 
            font-size: 0.8em; 
            padding: 0px 5px; 
            height: 20px
          }
          
          #tablePagination_paginater { 
            margin-left: auto; 
            margin-right: auto;
          }
          
          #tablePagination img { 
            padding: 0px 2px; 
          }
          
          #tablePagination_perPage { 
            float: left; 
          }
          
          #tablePagination_paginater { 
            float: right; 
          }
</style>
	<link rel="stylesheet" href="../../css/start/jquery-ui-1.8.17.custom.css"  />
	<link href="../../css/style.css" rel="stylesheet" type="text/css" />
        <link href="../../css/layout.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="../../css/style-Formularios.css">
	<script src="../../js/jquery-1.7.1.min.js" ></script>
	<script src="../../js/jquery-ui-1.8.17.custom.min.js" ></script>
	<script src="../../js/jquery.tablePagination.0.5.js" ></script>
	<script src="../../js/efectos.js" ></script>
	<script src="../../js/funcionalidades.js" ></script>
	<style>
	.ui-button { margin-left: -1px; }
	.ui-button-icon-only .ui-button-text { padding: 0.35em; } 
	.ui-autocomplete-input { margin: 0; padding: 0.48em 0 0.47em 0.45em; }
	/*.titulo{ background:url(../../css/images/tile1.gif) left top repeat-x; }*/
	</style>
	<script>
	$(document).ready(function(){

		$('h3').addClass("ui-widget-header ui-corner-top ui-corner-bottom");
		$('th').addClass("ui-widget-header ui-corner-top");
        	$('td').addClass("ui-widget-content");
	  	
	  	agergarEfectoSelect();
		$("#selectvicaria").combobox();
		agregarCaracteristicasBotones();
		
	  	var options = {
              		optionsForRows : [3,10,20],
              		rowsPerPage : 10
            	}
            	$('table').tablePagination(options);		 

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
				var telefono =  $("input#telefono"+id).attr("value");
	 	                var correo = $("input#correo"+id).attr("value");
				var datos="telefono="+telefono+"&nombre="+nombre+"&id="+id+"&correo="+correo;	
			
		    		if(id!="" && nombre!="" && telefono!=""){
				       if(confirm("Esta Seguro?")){
						$.ajax({
						   url: "modificar.php",
		    	                   	   type: "POST",
						   data: datos,
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
               <li><a href="index-1.html">nuestra misión</a></li>
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
		<div id="content">
			<div style="height:50px"></div>
                <!-- Empieza codigo especifico-->
                <div class="titulo">
                    <h3 style="text-align:center">MANTENER PARROQUIA</h3>
                </div>
        	<div class="row-2">
        		<form action="insertar.php" id="formu" method="post">

        			<div class="ui-widget-content contenido" style="width:49%;">
         				Nombre:
						<input type="text" name="nombre" id="nombre" style="width:84%;text-transform: uppercase" required placeholder="Escriba aqui el nombre" />
				    </div>
				    <div class="ui-widget-content contenido" style="width:22%;">
						Telefono:
						<input type="text" name="telefono" id="telefono" required placeholder="Escriba aqui su telefono" required style="width:70%" />
					</div>
					<div class="ui-widget-content contenido" style="width:25%;">
						Correo:
						<input type="email" name="correo" id="correo" placeholder="Escriba aqui su correo" style="width:60%" required  />
					</div>
					
					<div class="ui-widget-content contenido" style="width:98%;">
						Vicaria:
						
	<select id="selectvicaria" name="selectvicaria">
		<option value="">Seleccione una...</option>
<?php 
$vicarias=listadoVicaria();
$nfilas=count($vicarias);	
if($nfilas==0){
	echo "No hay Grupitos\n";

}else{   
	for($i=0;$i<$nfilas;$i++){ 
?>
	<option value="<? echo $vicarias[$i][0]; ?>"><? echo $vicarias[$i][1]; ?></option>

<?php 
	}
     } 
?>
	</select>
					</div>
					<div style="height:20px;clear:both"></div>
	                <p align="center">
						<button type="submit" id="botonGuardar" >Guardar</button>
					</p>	
        		</form>

        		<div id="listadoSacerdotes" class="ui-widget" >
				<?php
$parroquias=listadoParroquia();
$nfilas=count($parroquias);
if($nfilas==0){
	echo "No hay Grupitos\n";

}else{
?>
                  <table id="table">
		  <thead>
		   <tr>
                    <th style="width:6%;height:30px"  colspan="2">&nbsp;</th>
                    <th >NOMBRE</th>
                    <th >TELEFONO</th>
		    <th >CORREO</th>
		   </tr>
	    	  </thead>
<?php
	for($i=0;$i<$nfilas;$i++){
?>		
                        <tr>
                            <td><button class="botonModificar" style="width:25px; height:25px;" value="<? echo $parroquias[$i][0]; ?>">&nbsp;</button></td>
                            <td><button class="botonEliminar" style="width:25px; height:25px;" value="<? echo $parroquias[$i][0]; ?>">&nbsp;</button></td>
                           
                           
                            <td><input id="nombre<?  echo $parroquias[$i][0]; ?>" name"" type="text" value="<? echo $parroquias[$i][2]; ?>" required /></td>
                            
                            
                            <td><input id="telefono<? echo$parroquias[$i][0]; ?>" value="<? echo $parroquias[$i][1]; ?>" name="" type="text" required /></td>

                            <td><input id="correo<? echo $parroquias[$i][0]; ?>" value="<? echo $parroquias[$i][3]; ?>" name="" type="text" required /></td>
                                                              
                        </tr>

<?php 
	}
     } 
?>
                </table>
				</div>
         	
         	</div> 
		</div>
		<!-- footer -->
		<div id="footer">
      	<div class="left">
         	<div class="right">
            	<div class="indent">
                  <ul id="footer-nav">
                     <li><a href="index.html">inicio</a></li>
                     <li><a href="index-1.html">nuestra misión</a></li>
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
