<?PHP

$tipo = $_POST['tipo'];

if ($tipo == "js") {
	unlink('test.js');
	$numero = rand(0, 9999);

	$text = "const hrtime".$numero." =
	(typeof window !== 'undefined' &&
	typeof window.performance !== 'undefined' &&
	window.performance.now) ?
		window.performance.now.bind (window.performance) :
		(typeof require !== 'undefined') ?
		require ('perf_hooks').performance.now :
		function () {
			var h = process.hrtime".$numero." ();
			return (h[ 0 ] + (h[ 1 ] / 1e9)) * 1000;
		};

	var start = hrtime".$numero." ();

	";

	$text .= $_POST['text']."
	
	var end   = hrtime".$numero." ();
	var tiempo = (end - start);
	var tiempo2 = tiempo/1000;
	console.log ('Tiempo de ejecución:', (end - start).toString().match(/^-?\d+(?:\.\d{0,5})?/)[0], ' milisegundos');
	$('#tiempo').html('<b>Tiempo de ejecución JS:<br>'+tiempo.toString().match(/^-?\d+(?:\.\d{0,5})?/)[0]+' milisegundos <br>'+tiempo2.toString().match(/^-?\d+(?:\.\d{0,5})?/)[0]+' segundos</b>');";

	$file = fopen("test.js","a");
	fputs($file, $text) or die("No se puedo crear el Fichero.");
	fclose($file);

	echo $text;
} elseif ($tipo == "php") {
	unlink('test.php');
	$text = "<?php
	\$start = hrtime(true);
	";
	$text .= $_POST['text']."
	";

	$text .= "\$end = hrtime(true);
	\$time = \$end-\$start;
	echo \$time/1e+6; ?>";

	$file = fopen("test.php","a");
	fputs($file, $text) or die("No se puedo crear el Fichero.");
	fclose($file);
}
?>