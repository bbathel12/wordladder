<?php

wordLadder($beginWord,$endWord,$wordList);



function wordLadder($strBeginWord, $strEndWord, $aryWordList) {
	$intWordLength  = strlen($strBeginWord);//get length of words all words have same length
	$dblGoldenRatio = round( ($intWordLength - 1) / $intWordLength ,2 );// this number is the ratio of one letter change
	$strCurrentWord = $strBeginWord; // current word will be used for comparison start at begin word
	$arySortedList  = [$strBeginWord]; // container for sorted words
	$bolFinished    = false; // flag to stop while loop
	$i              = 0; // traverse wordlist array
	$intIterations     = 0; // need this because I can't think of any other way to determine impossibility
	$intFactorial   = factorial( count($aryWordList) ); // max number of steps before impossible (I think) probably not actually
	$arySolutions   = []; //multiple possible solutions need to only return shortest;

	while(!$bolFinished  ){

		if( $i >= count($aryWordList) ){

			$i = 0;

		}elseif( diffRatio( $strCurrentWord,$aryWordList[$i] ) === $dblGoldenRatio ){

			array_push($arySortedList,$aryWordList[$i]);
			echo "1";
			print_r($arySortedList);
			$strCurrentWord = $aryWordList[$i];
			
		}

		if( diffRatio( $strCurrentWord, $strEndWord ) === $dblGoldenRatio ){

			array_push( $arySortedList,$strEndWord );
			echo "2";
			print_r($arySortedList);
			$bolFinished = true;

		}

		if( $intIterations > $intFactorial ){

			return 0;
		
		}

		$i++;
		$intIterations++;
		
	}
	print_r($arySortedList);
	return count( $arySortedList ) ;

}


//takes two words returns the ratio difference
function diffRatio($strWordOne,$strWordTwo){
	$intSame       = 0;
	$intWordLength = strlen($strWordOne);
	for($i = 0 ; $i < $intWordLength; $i++){
		if($strWordOne[$i] === $strWordTwo[$i]){
			$intSame+=1;
		}
	}
	return round( $intSame / $intWordLength , 2 );
}


// rolling my own factorial because php doesn't have one
function factorial($intNumber){

	$factorial = 1;
	for ($x=$intNumber; $x>=1; $x--) 
	{
	  $factorial = $factorial * $x;
	}
	return $factorial;
}