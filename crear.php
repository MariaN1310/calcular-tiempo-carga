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
	console.log ('Tiempo de ejecución:', (end - start).toString().match(/^-?\d+(?:\.\d{0,5})?/)[0], 'segundos');
	var tiempo = (end - start);
	$('#prog2').html('<b>Tiempo de ejecución JS: '+tiempo+' segundos</b>')";

	$file = fopen("test.js","a");
	fputs($file, $text) or die("No se puedo crear el Fichero.");
	fclose($file);

	echo $text;
} elseif ($tipo == "php") {
	unlink('test.php');
	$text = "<?php
	\$start = microtime(true);
	";
	$text .= $_POST['text']."
	";

	$text .= "\$end = microtime(true);
	\$time = \$end-\$start;
	echo \$time; ?>";
	/*$start = microtime(true);

	for ($i = 0; $i < 1000; $i++) {
		// Solo como código demostrativo.
		preg_match('/^0{3}\b/', $number);
	}

	$end = microtime(true);
	$time = $end-$start;
	echo $time;*/

	$file = fopen("test.php","a");
	fputs($file, $text) or die("No se puedo crear el Fichero.");
	fclose($file);
}
?>