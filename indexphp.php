<?php
/*Pagina que permita pegar en un textbox codigo php o js.
El mismo cree un archivo con el codigo enviado y mida el tiempo de ejecución.
En lo posible que el archivo lo cree con ajax y lo ejecute y solo devuelva el tiempo, nada mas que eso.
*/
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Elección aleatoria</title>
		<script src="js/jquery-3.7.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script>
			$(document).ready(function(e) {
				$("#formulario").on('submit', function(e) {
					e.preventDefault();
					$.ajax( {
						method: 'POST',
						url: 'crear.php',
						data: $('form').serialize() + '&tipo=php',
						success: function(response2) {
							$.ajax( {
								method: 'POST',
								url: 'test.php',
								success: function(response3) {
									console.log ('Tiempo de ejecución:', (response3).toString().match(/^-?\d+(?:\.\d{0,5})?/)[0], 'segundos');
									$('#prog2').html('<b>Tiempo de ejecución PHP: '+response3+' segundos</b>');				
								}
							});				
						}
					});
				});
			});
		</script>
	</head>
	<body>
		<div class="container">
			<header class="d-flex justify-content-center py-3">
				<ul class="nav nav-pills">
					<li class="nav-item"><a href="index.html" class="nav-link">Calcular JS</a></li>
					<li class="nav-item"><a href="indexphp.php" class="nav-link active" aria-current="page">Calcular PHP</a></li>
				</ul>
			</header>
		</div>
		<div class="container text-center mt-2">
			<h1>Calcular tiempo ejecución PHP</h1>
			<form id="formulario">
				<textarea name="text" id="text" rows="8" class="form-control text-center"></textarea>
				<button class="btn btn-primary mt-3" type="submit" id="save-btn">Calcular</button>
			</form>
			<a id="prog2"></a>
		</div>
	</body>
</html>