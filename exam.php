<?php
/*
 * Calculator application
 * The task was to take a arithmetic equation and find the total without using the eval() or similar methods  
 * @Author Peter Yim
 */

//record the order of evalution in array 
$pemdas = array('*','/', '%', '+', '-');
//string of the inputed equation
$string = '1 + 1 - 4 * 4';
echo '<h2>' . $string . '</h2>';
//remove the white spaces from the string and convert it into a char array;
$equation = str_replace(' ', '', $string);
$breakout = str_split($equation);

//I wanted to have a new array that will combind the numbers together from a char array to a math array 
$math = array();
$number = '';
foreach ($breakout as $data){
	 if (preg_match('/^[1-9][0-9]*$/', $data)) {
	 	$number .=  $data;
	 } else {
	 	$math[] = $number; 
	 	$math[] = $data;
	 	$number = '';
	 }

}
 $math[] = $number; 
 $number = '';



//the is two foreach, the first loop goes though PEMDAS

foreach ($pemdas as $location => $value) {
	$prevnum = '';
	$prevKey = '';
	$do_math = FALSE;
	//the second loop evaluates the numbers and truncate the array;
	foreach ($math as $key => $data) {
		if($do_math){

			switch ($location) {
				case '0': $solve = $prevnum * $data; break;
				case '1': $solve = $prevnum / $data; break;
				case '2': $solve = $prevnum % $data; break;
				case '3': $solve = $prevnum + $data; break;
				case '4': $solve = $prevnum - $data; break;
			}
			
			$do_math = FALSE;
			$math[$prevKey] = '';
			$math[$prevKey+1] = '';
			$math[$key] = $solve;

		}
		if ($data == $value ){
			$do_math = TRUE;
		} else {
			$prevnum = $data;
			$prevKey = $key;
		}
		
	}
	$math = array_filter($math);

} 

echo '<br /><h1>Total:' . implode('', $math) . '</h1>';

