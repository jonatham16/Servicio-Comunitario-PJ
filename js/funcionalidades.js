function funcionalidadAgregar(){
	 	
          //en el evento submit del fomulario
	            //detenemos el comportamiento por default
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
 				//		location.reload();   
					   }
			   });
 			}
         
};
function funcionalidadEliminar(){
	
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
};

function funcionalidadModificar(){


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
};
