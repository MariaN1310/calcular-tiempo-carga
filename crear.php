<?PHP

$tipo = $_POST['tipo'];

if ($tipo == "js") {

	unlink('test.js');

	$codeJS = "
	try {
		const hrtime =
		(typeof window !== 'undefined' &&
		typeof window.performance !== 'undefined' &&
		window.performance.now) ?
			window.performance.now.bind (window.performance) :
			(typeof require !== 'undefined') ?
			require ('perf_hooks').performance.now :
			function () {
				var h = process.hrtime ();
				return (h[ 0 ] + (h[ 1 ] / 1e9)) * 1000;
			};
		var start = hrtime ();
		
		".$_POST['text']."

		var end   = hrtime ();
		var tiempo = (end - start);
		var tiempo2 = tiempo/1000;
		console.log ('Tiempo de ejecución:', (end - start).toString().match(/^-?\d+(?:\.\d{0,5})?/)[0], ' milisegundos');
		$('#tiempo').html('<b>Tiempo de ejecución JS:<br>'+tiempo.toString().match(/^-?\d+(?:\.\d{0,5})?/)[0]+' milisegundos <br>'+tiempo2.toString().match(/^-?\d+(?:\.\d{0,5})?/)[0]+' segundos</b>');
	} catch (error) {
		console.log ('El codigo tiene un error');
		$('#tiempo').html('<b>El codigo tiene un error</b>');
	}";

	$file = fopen("test.js","a");
	fputs($file, $codeJS) or die("No se puedo crear el Fichero.");
	fclose($file);

	echo $codeJS;

} elseif ($tipo == "php") {

	unlink('test.php');
	
	$codePHP = "<?php
	\$start = hrtime(true);
	";
	$codePHP .= $_POST['text']."
	";

	$codePHP .= "\$end = hrtime(true);
	
	echo (\$end-\$start)/1e+6; ?>";

	$file = fopen("test.php","a");
	fputs($file, $codePHP) or die("No se puedo crear el Fichero.");
	fclose($file);

}
?>