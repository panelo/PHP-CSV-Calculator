<?php

class calculator {
	
	private $filename;
	private $column;
	
	public function __construct() {
		global $argv;
		
		if (empty($argv[1])) {
	        throw new Exception('Error: File not found!');
	    }
		elseif (empty($argv[2])) {
			throw new Exception('Error: Column not found!');
		}
		
		$this->filename = $argv[1];
		$this->column = $argv[2];
		$this->csv = $this->getCSV();
		$this->col = $this->getColumn();
	}

 	public function getCSV(){
		$file = fopen($this->filename, 'r');
		while (!feof($file) ) {
			$lines[] = fgetcsv($file);
		}
		fclose($file);
		return $lines;
	}
	
	public function getColumn(){
		$header = array_shift($this->csv);
		$col = array_search($this->column, $header); 
		foreach ($this->csv as $row) {      
			$array[] = $row[$col]; 
		}
		$numeric = array_filter($array,'is_numeric');
		if($numeric == FALSE) {
			throw new Exception('Error: Accepts numeric characters only!');
		}
		return $array;
	}
	
	public function getMean(){
		$total = array_sum($this->col) / count($this->col);
		return $total;
	}
	
	public function getMedian(){
		rsort($this->col); 
	    $middle = round(count($this->col) / 2); 
	    $total = $this->col[$middle-1];
		return $total;
	}
	
	public function getMode(){
		$list = array_replace($this->col,array_fill_keys(array_keys($this->col, null),''));
		$value = array_count_values($list); 
	    arsort($value); 
	    foreach($value as $key => $value){
	    	$total = $key; 
	    	break;
		}
		return $total;
	}
	
	public function getSDSquare($x, $mean) {
		return pow($x - $mean,2); 
	}
	
	public function getSD() {
	    return sqrt(array_sum(array_map(array($this, "getSDSquare"), $this->col, array_fill(0,count($this->col), (array_sum($this->col) / count($this->col)) ) ) ) / (count($this->col)-1) );
	}

}
?>
