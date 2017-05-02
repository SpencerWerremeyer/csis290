<?php 
	define("NUMBER_OF_DIE", "1");
	define("NUMBER_OF_ROLLS", "50");
	
	$masterArray = array();
	$arrayOne = array();
	$arrayTwo = array();
	$arrayThree = array();
	$arrayFour = array();
	$arrayFive = array();
	$arraySix = array();
	$outputArray = array();
	$allArrays = array();

	
	
	function diceRoll($startRoll, $maxRoll) {
		global $arrayOne, $arrayTwo, $arrayThree, $arrayFour, $arrayFive, $arraySix;
		
		$rollNumber = $startRoll;

		$currentRoll = rand(1,6);
		$rollNumber++;
		
		if ($currentRoll == 1) {
			$arrayOne[] = $rollNumber;
		} else if ($currentRoll == 2) {
			$arrayTwo[] = $rollNumber;			
		}else if ($currentRoll == 3) {
			$arrayThree[] = $rollNumber;			
		}else if ($currentRoll == 4) {
			$arrayFour[] = $rollNumber;			
		}else if ($currentRoll == 5) {
			$arrayFive[] = $rollNumber;			
		}else if ($currentRoll == 6) {			
			$arraySix[] = $rollNumber;
		}
		
		if ($rollNumber < $maxRoll) {
			diceRoll ($rollNumber, $maxRoll);
		}
	}
	
	function calc($currentArray){
		if (sizeof($currentArray) == 0) {
			return;
		}
		global $masterArray, $arrayOne, $arrayTwo, $arrayThree, $arrayFour, $arrayFive, $arraySix, $timesToRollEachDie, $allArrays;
		$test = NUMBER_OF_ROLLS;
		$lastAppearance = end($currentArray);
		$totalAppearances = sizeof($currentArray);
		$formater = new NumberFormatter('en_US', NumberFormatter::PERCENT);
		$percentage = ((float)number_format((float)(sizeof($currentArray) / NUMBER_OF_ROLLS), 4, '.', ''));
		$percentage = $formater->format($percentage);
		
		if ($currentArray == $arrayOne) {
			$diceSide = 1;
		} else if ($currentArray == $arrayTwo) {
			$diceSide = 2;
		} else if ($currentArray == $arrayThree) {
			$diceSide = 3;
		} else if ($currentArray == $arrayFour) {
			$diceSide = 4;
		} else if ($currentArray == $arrayFive) {
			$diceSide = 5;
		} else if ($currentArray == $arraySix) {
			$diceSide = 6;
		}
		
		
		$arrayToReturn = array( "Dice Side" => $diceSide, "First Appearance" => $currentArray[0], "Last Appearance" => $lastAppearance, "Total Appearances" => $totalAppearances, "Percentage" => $percentage);

		return $arrayToReturn;
		
		
	}
	
	$timesToRollEachDie = constant("NUMBER_OF_ROLLS") / constant("NUMBER_OF_DIE");

	diceRoll(0, $timesToRollEachDie);
	
	array_push($allArrays, $arrayOne, $arrayTwo, $arrayThree, $arrayFour, $arrayFive, $arraySix);
	foreach ($allArrays as $array) {
		if (sizeof($array) > 0) {
			array_push($masterArray, $array);
		}
	}
	
	for($i = 0; $i < sizeof($masterArray); $i++) {
		$outputArray[] = calc($masterArray[$i]);
	}
?>
<html>
    <head>
      <title>Home</title>
      <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
    <div id="content">
      <div id="nav">
        <a href="index.html">Home</a> |
        <a href="c++.html">C++</a> |
        <a href="JavaScript.html">JavaScript</a> |
        <a href="PHP.html">PHP</a> |
        <a href="SQL.htl">SQL</a>
      </div>
      <div id="about">
	<p>Number of Die <?php echo(constant("NUMBER_OF_DIE")) ?></p>
	<p>Number of Rolls <?php echo(constant("NUMBER_OF_ROLLS")) ?></p>
		<table>
		  <thead>
			<tr>
			  <th><?php echo implode('</th><th>', array_keys(current($outputArray))); ?></th>
			</tr>
		  </thead>
		  
		  <tbody> 
			
			<?php foreach ($outputArray as $key => $row):?>
				<tr>
					<td><?php echo implode('</td><td>', $row); ?></td>
				</tr>
			<?php endforeach; ?>
		  </tbody>
		</table>
    </div>
	</body>
</html>


