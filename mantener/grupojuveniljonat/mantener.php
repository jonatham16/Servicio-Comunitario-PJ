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
	<script src="../../js/funcionalidades.js" ></script>
	<script src="../../js/jquery.ui.datepicker-es.js" ></script>
	<style>
	.ui-button { margin-left: -1px; }
	.ui-button-icon-only .ui-button-text { padding: 0.35em; } 
	.ui-autocomplete-input { margin: 0; padding: 0.48em 0 0.47em 0.45em; }
	</style>
	<script>
	$(document).ready(function(){

	  	agergarEfectoSelect();
		$("#selectparroquia").combobox();
		agregarCaracteristicasBotones();
		$("#fecha").datepicker();
		$("#fecha").datepicker( "option", "dateFormat", "yy-mm-dd" );		 
		$("#fecha").datepicker( "option",
				$.datepicker.regional['es'] );


		$('#formu').submit(function(evento){ //en el evento submit del fomulario
			  evento.preventDefault();  //detenemos el comportamiento por default
				  var sel = $("#selectparroquia").attr("value");
				if(sel!=""){
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
				}
				else alert("Debe indicar la parroquia a la que pertenece");
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
	 	                var fecha = $("input#fecha"+id).attr("value");
 				var lema = $("input#lema"+id).attr("value");
				var datos="telefono="+telefono+"&nombre="+nombre+"&id="+id+"&fecha="+fecha+"&lema="+lema;	
				alert(datos);
		    		if(id!="" && nombre!="" && fecha!=""){
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
<body>
	<div id="formulario" class="ui-widget" >
	<form action="insertar.php" id="formu" method="post">
	<input type="text" name="nombre" id="nombre" required placeholder="Escriba aqui el nombre"/>
<br>
	<input type="text" name="telefono" id="telefono" placeholder="Escriba aqui el telefono"/>
<br>
	<input type="text" name="fecha" id="fecha" required placeholder="Indique la fecha de fundacion" />
<br>
	<input type="text" name="lema" id="lema" placeholder="Escriba aqui el lema del grupo juvenil" />
<br>
	

	<select id="selectparroquia" name="selectparroquia">
		<option value="">Seleccione una...</option>
<?php 
$parroquias=listadoParroquia();
$nfilas=count($parroquias);	
if($nfilas==0){
	echo "No hay Grupitos\n";

}else{   
	for($i=0;$i<$nfilas;$i++){ 
?>
	<option value="<? echo $parroquias[$i][0]; ?>"><? echo $parroquias[$i][2]; ?></option>

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
$gruposJuveniles=listadoGrupojuvenil();
$nfilas=count($gruposJuveniles);
if($nfilas==0){
	echo "No hay Grupitos\n";

}else{
?>
                  <table>
                    <th style="width:6%;height:30px"  colspan="2">&nbsp;</th>
                    <th >NOMBRE</th>
                    <th >TELEFONO</th>
		    <th >FECHA</th>
		    <th >LEMA</th>
<?php
	for($i=0;$i<$nfilas;$i++){
?>		
                        <tr>
                            <td><button class="botonModificar" style="width:25px; height:25px;" value="<? echo $gruposJuveniles[$i][0]; ?>">&nbsp;</button></td>
                            <td><button class="botonEliminar" style="width:25px; height:25px;" value="<? echo $gruposJuveniles[$i][0]; ?>">&nbsp;</button></td>
                           
                           
                            <td><input id="nombre<?  echo $gruposJuveniles[$i][0]; ?>" name"" type="text" value="<? echo $gruposJuveniles[$i][6]; ?>" required /></td>
                            
                            
                            <td><input id="telefono<? echo $gruposJuveniles[$i][0]; ?>" value="<? echo $gruposJuveniles[$i][5]; ?>" name="" type="text" required /></td>

                            <td><input id="fecha<? echo $gruposJuveniles[$i][0]; ?>" value="<? echo $gruposJuveniles[$i][3]; ?>" name="" type="text" required class="fecha2" /></td>
			    <td><input id="lema<? echo $gruposJuveniles[$i][0]; ?>" value="<? echo $gruposJuveniles[$i][2]; ?>" name="" type="text" required /></td>
                                                              
                        </tr>

<?php 
	}
     } 
?>
                </table>
</div>

</body>
</html>
