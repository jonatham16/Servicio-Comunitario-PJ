<?php
require_once ("../../lib/funciones.php");
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Asignar Parroquias</title>
	<link rel="stylesheet" href="../../css/start/jquery-ui-1.8.17.custom.css"  />
	<script src="../../js/jquery-1.7.1.min.js" ></script>
	<script src="../../js/jquery-ui-1.8.17.custom.min.js" ></script>
	<script src="../../js/efectos.js" ></script>
	<script src="../../js/n.js" ></script>
	<style>
	.ui-button { margin-left: -1px; }
	.ui-button-icon-only .ui-button-text { padding: 0.35em; } 
	.ui-autocomplete-input { margin: 0; padding: 0.48em 0 0.47em 0.45em; }
	</style>
	<script>	
	$(document).ready(function(){

	  	selectEfecto();
		$("#selectsacerdote").combobox();
		$("#selectparro").combobox();
    		$("#fechaini").datepicker({ dateFormat: 'yy-mm-dd' });
		$("#fechafin").datepicker({ dateFormat: 'yy-mm-dd' });
		colocarTitulosBotones();



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

	<th >Seleccionar Sacerdote</th>

	<select id="selectsacerdote" name="selectsacerdote">
		<option value="">Seleccione una...</option>
<?php 
$sar=listadoSacerdotes();
$nfilas=count($sar);	
if($nfilas==0){
	echo "No hay Grupitos\n";

}else{   
	for($i=0;$i<$nfilas;$i++){ 
?>
	<option value="<? echo $sar[$i][0]; ?>"><? echo $sar[$i][1]; ?></option>

<?php 
	}
     } 
?>
	</select>
<br>
	<th >Seleccionar Parroquia</th>

	<select id="selectparro" name="selectparro">
		<option value="">Seleccione una...</option>
<?php 
$par=listadoParroquia();
$nfilas=count($par);	
if($nfilas==0){
	echo "No hay Grupitos\n";

}else{   
	for($i=0;$i<$nfilas;$i++){ 
?>
	<option value="<? echo $par[$i][0]; ?>"><? echo $par[$i][2]; ?></option>

<?php 
	}
     } 
?>
	</select>
<br>
<th >Desde el</th>
<input type="text" name="fechaini" id="fechaini" />
<br>
<th >Hasta el</th>
<input type="text" name="fechafin" id="fechafin" />
<br>

	<button type="submit" id="botonGuardar" >Guardar</button>
<!-- OJO los botones funcionan, pero no agraga el icono si se declaran de la sig manera 
	<input type="submit" value="Guardar" id="botonGuardar" />
-->	
	</form>

	</div>
<div id="listadoSacerdotes" class="ui-widget" >
<?php
$SARPA=listadoparroquia_sacerdore();
$nfilas=count($SARPA);
if($nfilas==0){
	echo "No hay Grupitos\n";

}else{
?>
                  <table>
                    <th style="width:6%;height:30px"  colspan="2"></th>
                  
<?php
	for($i=0;$i<$nfilas;$i++){
?>		
                        <tr>
                            
                          
                           
                           
                            <td><input id="sacerdote<?  echo $SARPA[$i][0]; ?>" name"" type="text" value="<? echo $SARPA[$i][0]; ?>" required /></td>
                            
                            
                            <td><input id="parroquia<? echo$SARPA[$i][0]; ?>" value="<? echo $SARPA[$i][1]; ?>" name="" type="text" required /></td>

                            <td><input id="desde<? echo $SARPA[$i][0]; ?>" value="<? echo $SARPA[$i][2]; ?>" name="" type="text" required /></td>
  				<td><input id="hasta<? echo $SARPA[$i][0]; ?>" value="<? echo $SARPA[$i][3]; ?>" name="" type="text" required /></td>
                                                              
                        </tr>

<?php 
	}
     } 
?>
                </table>
</div>

</body>
</html>
