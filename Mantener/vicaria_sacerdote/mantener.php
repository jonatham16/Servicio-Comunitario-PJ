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
<form action="insertar.php" id="formu" method="post">
<div id="formulario" class="ui-widget" >
<?php
$vic = listadoVicaria();
echo 'Selecciona Vicaria <select name="sel_vica">';
$nfilas = count($vic);
for($i=0;$i<$nfilas;$i++){
	echo '<option value="'.$vic[$i][0].'">'.$vic[$i][1].'</option>';
}
echo '</select> <br />' ;


$sac = listadoSacerdotes();
echo 'Selecciona Sacerdote <select name="sel_sace">';
$nfilas = count($sac);
for($i=0;$i<$nfilas;$i++){
	echo '<option value="'.$sac[$i][0].'">'.$sac[$i][1].'</option>';
}


echo '</select> <br />';


$vs = listadoVicaria_Sacerdote();
$nfilas=count($vs);
?>
<br />
<button type="submit" id="botonGuardar" >Guardar</button>
<?php
if($nfilas==0){
		echo "No hay Grupitos\n";
}else {
?>

</div>
</form>
<div id="listadoSacerdotes" class="ui-widget" >
	<table>			
                    <th style="width:6%;height:30px" >&nbsp;</th>
                    <th >Vicaria</th>
                    <th >Sacerdote</th>
					<th >Fecha</th>
					<?php 
					for ($i=0;$i<$nfilas;$i++){
					?>
					<tr>
					 <td><button class="botonEliminar" style="width:25px; height:25px;" value="<?php echo $vs[$i][0]."_".$vs[$i][2]; ?>">&nbsp;</button></td>
					 <td><input id="nombre<?php  echo $vs[$i][0]; ?>" name"" type="text" value="<?php echo $vs[$i][1]; ?>" required  readonly="readonly"/></td>
					 <td><input id="nombre<?php  echo $vs[$i][2]; ?>" name"" type="text" value="<?php echo $vs[$i][3]; ?>" required  readonly="readonly"/></td>
					 <td><input id="nombre<?php  echo $vs[$i][2]; ?>" name"" type="text" value="<?php echo $vs[$i][4]; ?>" required  readonly="readonly"/></td>
					</tr>
					<?php
					}			
					
					?>
	</table>
</div>
<?php


}
?>


</body>
</html>
