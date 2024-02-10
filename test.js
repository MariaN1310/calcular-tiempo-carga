const hrtime9039 =
	(typeof window !== 'undefined' &&
	typeof window.performance !== 'undefined' &&
	window.performance.now) ?
		window.performance.now.bind (window.performance) :
		(typeof require !== 'undefined') ?
		require ('perf_hooks').performance.now :
		function () {
			var h = process.hrtime9039 ();
			return (h[ 0 ] + (h[ 1 ] / 1e9)) * 1000;
		};

	var start = hrtime9039 ();

	
	
	var end   = hrtime9039 ();
	var tiempo = (end - start);
	var tiempo2 = tiempo/1000;
	console.log ('Tiempo de ejecución:', (end - start).toString().match(/^-?\d+(?:\.\d{0,5})?/)[0], ' milisegundos');
	$('#tiempo').html('<b>Tiempo de ejecución JS:<br>'+tiempo.toString().match(/^-?\d+(?:\.\d{0,5})?/)[0]+' milisegundos <br>'+tiempo2.toString().match(/^-?\d+(?:\.\d{0,5})?/)[0]+' segundos</b>');