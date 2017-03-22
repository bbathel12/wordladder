<?php
function wordLadder($strBeginWord, $strEndWord, $aryWordList) {
	$intWordLength  = strlen($strBeginWord);//get length of words all words have same length
	$dblGoldenRatio = round( ($intWordLength - 1) / $intWordLength ,2 );// this number is the ratio of one letter change
	$strCurrentWord = $strBeginWord; // current word will be used for comparison start at begin word
	$arySortedList  = [$strBeginWord]; // container for sorted words
	$bolFinished    = false; // flag to stop while loop
	$i              = 0; // traverse wordlist array
	$intIterations  = 0; // need this because I can't think of any other way to determine impossibility
	$intFactorial   = factorial( count($aryWordList) ); // max number of steps before impossible (I think) probably not actually
	$arySolutions   = []; //multiple possible solutions need to only return shortest;
    
	while( !$bolFinished ){
        
		if( !in_array( $strEndWord,$aryWordList ) ) return 0; // if end word is not in wordlist this can't be done. 0 is the answer
		if( count($arySolutions) > count($aryWordList) ) { $bolFinished = true; break; }// probably not more solutions than words maybe
		

		if( $i >= count($aryWordList) ){
            
			$i = 0;
            
		}elseif( diffRatio( $strCurrentWord,$aryWordList[$i] ) === $dblGoldenRatio ){
            
			array_push($arySortedList,$aryWordList[$i]);
			$strCurrentWord = $aryWordList[$i];
			
		}
		if( diffRatio( $strCurrentWord, $strEndWord ) === $dblGoldenRatio ){
            
			array_push( $arySortedList,$strEndWord );
                        $arySolutions[count($arySortedList)] = $arySortedList;
                        if( count($arySortedList) === 2 ){
                            $bolFinished = true;
                        }else{
                
                            $strFirstWord = array_shift($aryWordList);// move first word
                            array_push( $aryWordList, $strFirstWord );// to end of wordlist to get another solution
                            $strCurrentWord = $strBeginWord;
                            $i = 0; // start at the begining of the wordlist;
                            $arySortedList = [$strBeginWord]; //clear out sorted list;
                        }
			
		}
		if( $intIterations > $intFactorial ){
            
			$bolFinished = true;

		}
        
		$i++;
		$intIterations++;
		
	}
        if( !empty($arySolutions) ){
            $intMinCount = smallest_array($arySolutions);
            return $intMinCount;
        }else{
            return 0;
        }
}

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

// copied most of this off of stack overflow 
// gets the smallest array in an array and returns
// the length of smallest array
function smallest_array($arr){
    $counts = array_map('count', $arr);
    $min = min($counts);
    $key = array_flip($counts)[$min];
    $smallest_arr = $arr[$key];
    print_r($smallest_arr);
    return count($smallest_arr);
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
