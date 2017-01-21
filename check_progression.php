#!/usr/bin/php
<?php
// if the input parameters were passed when calling the script
if ($argc>1) {
	$input = trim($argv[1]);
} else {
	// otherwise, get input from STDIN
	$input = getSTDIN();
}
checkProgression($input);

// get input from STDIN 
function getSTDIN() {
	echo "Please input numbers separated by comma: ";
	$input = trim(fgets(STDIN));
	return $input;
}

// check for progression
function checkProgression($input) {
	
	$row=array_map('trim',explode(',',$input));
	
	if (count($row)>2 && is_numeric($row[0]) && is_numeric($row[1])) {
		
		// arithmetic progression
		$isAP = true;
		// d - the common difference of an arithmetic progression
		$d = $row[1]-$row[0];
		
		// geometric progression
		$isGP = false;
		if ($row[0]!=0 && $row[1]!=0) {
			// r - the common ratio of a geometric progression
			$r = $row[1]/$row[0];
			$isGP = true;
		}
		
		for ($i=1;$i<count($row);$i++) {
			if ($isAP && $row[$i]!=$row[$i-1]+$d) {
				$isAP = false;
			}
			if ($isGP && $row[$i]!=$row[$i-1]*$r) {
				$isGP = false;
			}
		}
		
		if (!$isAP && !$isGP) {
			echo $input." is not a progression".PHP_EOL;
		} else {
			if ($isAP) echo $input." is an arithmetic progression and the common difference is ".$d.PHP_EOL;
			if ($isGP) echo $input." is a geometric progression and the common ratio is ".$r.PHP_EOL;
		}
	} else {
		echo "Please check your input: ".$input.PHP_EOL;
	}
	return checkProgression(getSTDIN());
}
?>