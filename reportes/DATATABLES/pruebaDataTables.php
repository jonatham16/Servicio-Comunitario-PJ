<?php
require_once ("../../lib/funciones.php");
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>LISTADO PARROQUIAS</title>
	<link rel="stylesheet" href="../../css/demo_table.css"  />
	<link rel="stylesheet" href="../../css/demo_table_jui.css"  />
	<link rel="stylesheet" href="../../css/TableTools_JUI.css"  />
	<link rel="stylesheet" href="../../css/start/jquery-ui-1.8.17.custom.css"  />
	<script src="../../js/jquery-1.7.1.min.js" ></script>
	<script src="../../js/jquery-ui-1.8.17.custom.min.js" ></script>
	<script src="../../js/jquery.dataTables.js" ></script>

	<script src="../../js/ZeroClipboard.js" ></script>
	<script src="../../js/TableTools.js" ></script>

	<script src="../../js/efectos.js" ></script>
	<script src="../../js/funcionalidades.js" ></script>
	
	<style>
	.ui-button { margin-left: -1px; }
	.ui-button-icon-only .ui-button-text { padding: 0.35em; } 
	.ui-autocomplete-input { margin: 0; padding: 0.48em 0 0.47em 0.45em; }
	</style>
	<script>
	$(document).ready(function(){
	
		$('#tabla').dataTable( {
			"bJQueryUI": true,
			"sPaginationType": "full_numbers",
			"sDom": '<"H"Tfr>t<"F"ip>',
			"oLanguage": {
			"sInfo": "Mostrando _START_ al _END_ de _TOTAL_ entradas",
			"sSearch": "Buscar:",
			"sEmptyTable": "No hay datos disponibles en las tablas",
			"oPaginate": {
				"sLast": "Ult",
				"sFirst": "Primera",
				"sNext": "Sig",
				"sPrevious": "Ant"
			      }
			},
			"oTableTools": {
				"sSwfPath": "../../swf/copy_csv_xls_pdf.swf",
				"aButtons": [
					"copy", "csv", "xls", "pdf",
					{
						"sExtends":    "collection",
						"sButtonText": "Save",
						"aButtons":    [ "csv", "xls", "pdf" ]
					}
					]
			}
		} );



	});
	</script>
</head>
<body>

<div id="listadoParroquias" class="ui-widget" >
<?php
$parroquias=listadoParroquia();
$nfilas=count($parroquias);
if($nfilas==0){
	echo "No hay Grupitos\n";

}else{
?>
      <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla">
		  <thead>
		     <tr>  
		            <th >NOMBRE</th>
		            <th >TELEFONO</th>
			    <th >CORREO</th>
		     </tr>
		  </thead>
		  <tbody>
<?php
	for($i=0;$i<$nfilas;$i++){
?>		
		  
                        <tr class="gradeA">                                                    
                            <td><? echo $parroquias[$i][2]; ?></td>                                                       
                            <td><? echo $parroquias[$i][1]; ?></td>
                            <td><? echo $parroquias[$i][3]; ?></td>                                                             
                        </tr>
<?php 
	}
     } 
?>
                </tbody>
	        <tfoot>
		     <tr>  
		            <th >NOMBRE</th>
		            <th >TELEFONO</th>
			    <th >CORREO</th>
		     </tr>
	        </tfoot>
       </table>
</div>
</body>
</html>
