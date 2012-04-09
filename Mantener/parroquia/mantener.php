<?php
require_once ("../../lib/funciones.php");
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Mantener Parroquia</title>
	<link rel="stylesheet" href="../../css/start/jquery-ui-1.8.17.custom.css"  />
	<script src="../../js/jquery-1.7.1.min.js" ></script>
	<script src="../../js/jquery-ui-1.8.17.custom.min.js" ></script>
	<script src="../../js/efectos.js" ></script>
	
	<style>
	.ui-button { margin-left: -1px; }
	.ui-button-icon-only .ui-button-text { padding: 0.35em; } 
	.ui-autocomplete-input { margin: 0; padding: 0.48em 0 0.47em 0.45em; }
	</style>
	<script>
	$(document).ready(function(){

	  	agergarEfectoSelect();
		$("#selectvicaria").combobox();
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
			var telefono =  $("input#telefono"+id).attr("value");
 	                var correo = $("input#correo"+id).attr("value");
							
	    		if(id!="" && nombre!="" && telefono!=""){
			        if(confirm("Esta Seguro?")){
				        $.ajax({
				           url: "modificar.php",
	    	                   	   type: "POST",
				           data: "telefono="+telefono+"&nombre="+nombre+"&id="+id+"&correo="+correo,
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
	<input type="text" name="telefono" id="telefono" required placeholder="Escriba aqui su telefono"/>
<br>
	<input type="email" name="correo" id="correo" placeholder="Escriba aqui su correo" />
<br>
	

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
<br>

	<button type="submit" id="botonGuardar" >Guardar</button>
<!-- OJO los botones funcionan, pero no agraga el icono si se declaran de la sig manera 
	<input type="submit" value="Guardar" id="botonGuardar" />
-->	
	</form>

	</div>
<div id="listadoSacerdotes" class="ui-widget" >
<?php
$parroquias=listadoParroquia();
$nfilas=count($parroquias);
if($nfilas==0){
	echo "No hay Grupitos\n";

}else{
?>
                  <table>
                    <th style="width:6%;height:30px"  colspan="2">&nbsp;</th>
                    <th >NOMBRE</th>
                    <th >TELEFONO</th>
		    <th >CORREO</th>
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

</body>
</html>
