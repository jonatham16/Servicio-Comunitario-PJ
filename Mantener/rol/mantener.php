<?php
require_once ("../../lib/funciones.php");
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Mantener Roles</title>
	<link rel="stylesheet" href="../../css/start/jquery-ui-1.8.17.custom.css"  />
	<script src="../../js/jquery-1.7.1.min.js" type="text/javascript"></script>
	<script src="../../js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>
	<script>
	$(document).ready(function(){
	  
		

		  // titulos
		$('.botonModificar').attr( "title", "Modificar" );
		$('.botonEliminar').attr( "title", "Eliminar" );
		$('#botonGuardar').attr( "title", "Guardar" );
	  
	        var ui_icon_lapiz = {icons:{primary:"ui-icon-pencil"},text:false}; //icono de lapiz
                var ui_icon_tijeras = {icons:{primary:"ui-icon-scissors"},text:false};//icono de tijeras
                var ui_icon_disco = {icons:{primary:"ui-icon-disk"}}; //icono de disquete


                $('.botonModificar').button(ui_icon_lapiz);
                $('.botonEliminar').button(ui_icon_tijeras);
                $('#botonGuardar').button(ui_icon_disco);
	
	 	
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
<body>
	<div id="formulario" class="ui-widget" >
	<form action="insertar.php" id="formu" method="post">
	<input type="text" name="nombre" id="nombre" required placeholder="Escriba aqui el nombre"/>
<br>
	<input type="text" name="descripcion" id="descripcion" required placeholder="Escriba aqui la descripcion"/>
<br>
	<button type="submit" id="botonGuardar" >Guardar</button>
<!-- OJO los botones funcionan, pero no agraga el icono si se declaran de la sig manera 
	<input type="submit" value="Guardar" id="botonGuardar" />
-->	
	</form>

	</div>
<div id="listadoSacerdotes" class="ui-widget" >
<?php

$roles=listadoRol();
$nfilas=count($roles);
if($nfilas==0){
	echo "No hay Grupitos\n";

}else{
?>
                  <table>
                    <th style="width:6%;height:30px"  colspan="2">&nbsp;</th>
                    <th >NOMBRE</th>
                    <th >DESCRIPCION</th>
<?php
	for($i=0;$i<$nfilas;$i++){
?>		
                        <tr>
                            <td><button class="botonModificar" style="width:25px; height:25px;" value="<?php echo $roles[$i][0]; ?>">&nbsp;</button></td>
                            <td><button class="botonEliminar" style="width:25px; height:25px;" value="<?php echo $roles[$i][0]; ?>">&nbsp;</button></td>
                           
                           
                            <td><input id="nombre<?php  echo $roles[$i][0]; ?>" name"" type="text" value="<?php echo $roles[$i][1]; ?>" required /></td>
                            
                            
                            <td><input id="descripcion<?php echo $roles[$i][0]; ?>" value="<?php echo $roles[$i][2]; ?>" name="" type="text" required /></td>                     
                        </tr>

<?php 
	}
     } 
?>
                </table>
</div>

</body>
</html>
