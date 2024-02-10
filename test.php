<?php
	$start = hrtime(true);
	$varr = 8+8522+4+6+5+4+5+4+5+4+5+3+2555+55744;
sleep(2);
	$end = hrtime(true);
	$time = $end-$start;
	echo $time/1e+6; ?>