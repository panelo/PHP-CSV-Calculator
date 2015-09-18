<?php

function __autoload($class) {
	include_once($class.".php");
}

try {
	$calc = new calculator();
	echo "Mean:".$calc->getMean()."\n";
	echo "Median:".$calc->getMedian()."\n";
	echo "Mode:".$calc->getMode()."\n";
	echo "Standard Deviation:".$calc->getSD()."\n";
}
catch (Exception $e) {
    echo $e->getMessage()."\n";
}



?>