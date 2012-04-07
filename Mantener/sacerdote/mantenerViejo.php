<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Mantener Sacerdote</title>
	<script src="../../js/jquery-1.7.1.min.js" type="text/javascript"></script>
	<script src="../../js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>
	<script>
	$(document).ready(function(){
	
		$('#botonGuardar').click(function(){
				
						 if(confirm("Esta Seguro?")){
					  
							var nombre = $("#nombre").val();
							var apellido = $("#apellido").val();
							var cedula = $("#cedula").val();
							var correo = $("#correo").val();
						//	alert(nombre+apellido+cedula+correo);	
							$.ajax({
								 url: "insertar.php",
								 type: "POST",
								 data: "nombre="+nombre+"&apellido="+apellido+"&cedula="+cedula+"&correo="+correo,
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
<body>
	<div id="formulario">

	<input type="text" name="nombre" id="nombre" required placeholder="Escriba aqui su nombre"/>
<br>
	<input type="text" name="apellido" id="apellido" required placeholder="Escriba aqui su apellido"/>
<br>
	<input type="text" name="cedula" id="cedula" required placeholder="Escriba aqui su cedula"/>
<br>
	<input type="email" name="correo" id="correo" required placeholder="Escriba aqui su correo" />
<br>
	<input type="button" value="Guardar" id="botonGuardar" />

	</div>
</body>
</html>
