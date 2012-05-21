<?php
require_once ("../../lib/funciones.php");
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Listado de parroquias</title>
	<link rel="stylesheet" href="../../css/start/jquery-ui-1.8.17.custom.css"  />
	<link href="../../css/style.css" rel="stylesheet" type="text/css" />
   	<link href="../../css/layout.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="../../css/style-Formularios.css">
	<link rel="stylesheet" href="../../css/demo_table.css"  />
	<link rel="stylesheet" href="../../css/demo_table_jui.css"  />
	<link rel="stylesheet" href="../../css/TableTools_JUI.css"  />
	<script src="../../js/jquery-1.7.1.min.js" ></script>
	<script src="../../js/jquery-ui-1.8.17.custom.min.js" ></script>
	<script src="../../js/jquery.dataTables.js" ></script>

	<script src="../../js/ZeroClipboard.js" ></script>
	<script src="../../js/TableTools.js" ></script>
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
						"sButtonText": "Guardar",
						"aButtons":    [ "csv", "xls", "pdf" ]
					}
					]
			}
		} );

	});
	</script>
</head>
<body>
<div id="main">
		<!-- header -->
		<div id="header">
			<div class="row-1">
         	<div class="indent"><a href="index.html"><img alt="" src="images/logo.jpg" /></a></div>
         </div>
			<div class="row-2">
         	<ul id="site-nav">
            	<li><a href="index.html">main page</a></li>
               <li><a href="index-1.html">our mission</a></li>
               <li><a href="index-2.html">community</a></li>
               <li><a href="index-3.html">donations</a></li>
               <li><a href="index-4.html">news &amp; events</a></li>
               <li><a href="index-5.html">contacts</a></li>
            </ul>
         </div>
         <div class="row-3">
         	<em id="slogan">You were Shaped for Serving God</em>
            <strong>Fusce feugiat malesuada odibi nunc odgravida arsus</strong><br />
            <p>Tulorecenas tristique orci ac ss ultricies pharetra nec accumsan orcnec sit ameter erorem ipsum dolor sit ansectetueripiscing elitauristum.</p>
            <div class="wrapper"><a class="link1" href="#"><b>read more</b></a></div>
         </div>
		</div>
		<!-- content -->
		<div id="content">
<div class="ui-widget-header titulo">
                    <h3 style="text-align:center">Listado de parroquias</h3>
                </div>
		    <div class="row-2">

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
                     <li><a href="index-4.html">noticias &amp; eventos</a></li>
                     <li><a href="index-5.html">contacto</a></li>
                  </ul> 
               </div>
            </div>
         </div>
      </div>
	</div>
</body>
</html>
