<?php
require_once ("../../lib/funciones.php");
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Mantener Sacerdote</title>
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
	<script src="../../js/jquery-1.7.1.min.js" ></script>
	<script src="../../js/jquery-ui-1.8.17.custom.min.js" ></script>
	<script src="../../js/jquery.tablePagination.0.5.js" ></script>
	<script src="../../js/efectos.js" ></script>

	<script>
	$(document).ready(function(){

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
 	                var apellido = $("input#apellido"+id).attr("value");
			var cedula =  $("input#cedula"+id).attr("value");
 	                var correo = $("input#correo"+id).attr("value");
							
	    		if(id!="" && nombre!="" && apellido!="" && cedula!=""){
			        if(confirm("Esta Seguro?")){
				        $.ajax({
				           url: "modificar.php",
	    	                   	   type: "POST",
				           data: "apellido="+apellido+"&nombre="+nombre+"&id="+id+"&cedula="+cedula+"&correo="+correo,
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
<body>
	<div id="formulario" class="ui-widget" >
	<form action="insertar.php" id="formu" method="post">
	<input type="text" name="nombre" id="nombre" required placeholder="Escriba aqui su nombre"/>
<br>
	<input type="text" name="apellido" id="apellido" required placeholder="Escriba aqui su apellido"/>
<br>
	<input type="text" name="cedula" id="cedula" required placeholder="Escriba aqui su cedula"/>
<br>
	<input type="email" name="correo" id="correo" required placeholder="Escriba aqui su correo" />
<br>
	
	<button type="submit" id="botonGuardar" >Guardar</button>
<!-- OJO los botones funcionan, pero no agraga el icono si se declaran de la sig manera 
	<input type="submit" value="Guardar" id="botonGuardar" />
-->	
	</form>

	</div>
<div id="listadoSacerdotes" class="ui-widget" >
<?php

$sacerdotes=listadoSacerdotes();
$nfilas=count($sacerdotes);
if($nfilas==0){
	echo "No hay Grupitos\n";

}else{
?>
                  <table>
		   <thead>
		   <tr>
                    <th style="width:6%;height:30px"  colspan="2">&nbsp;</th>
                    <th >NOMBRE</th>
                    <th >APELLIDO</th>
		    <th >CEDULA</th>
                    <th >CORREO</th>
		   </tr>
	    	  </thead>
<?php
	for($i=0;$i<$nfilas;$i++){
?>		
			
                        <tr>
                            <td><button class="botonModificar" style="width:25px; height:25px;" value="<? echo $sacerdotes[$i][0]; ?>">&nbsp;</button></td>
                            <td><button class="botonEliminar" style="width:25px; height:25px;" value="<? echo $sacerdotes[$i][0]; ?>">&nbsp;</button></td>
                           
                           
                            <td><input id="nombre<?  echo $sacerdotes[$i][0]; ?>" name"" type="text" value="<? echo $sacerdotes[$i][1]; ?>" required /></td>
                            
                            
                            <td><input id="apellido<? echo $sacerdotes[$i][0]; ?>" value="<? echo $sacerdotes[$i][2]; ?>" name="" type="text" required /></td>

 <td><input id="cedula<? echo $sacerdotes[$i][0]; ?>" value="<? echo $sacerdotes[$i][3]; ?>" name="" type="text" required /></td>
 <td><input id="correo<? echo $sacerdotes[$i][0]; ?>" value="<? echo $sacerdotes[$i][4]; ?>" name="" type="email" required /></td>
                                    
                            
                        </tr>
			

<?php 
	}
     } 
?>
                </table>
</div>

</body>
</html>