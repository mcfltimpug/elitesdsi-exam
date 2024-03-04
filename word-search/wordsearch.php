<?php
function searchWord($target, $words){
    $foundIndexes = [];

    //run through the provided words
    for($i = 0; $i < count($words); $i++){
        //if word is equivalent to target, insert word to array
        if($words[$i] === $target){ 
            $foundIndexes[] = $i;
        }
    }

    //if there data found
    if(count($foundIndexes) > 0){

        //print according to number of found data
        if(count($foundIndexes) == 1){
            echo 'INDEX ' . $foundIndexes[0];

        }else{
            //run through found data, check if last
            foreach($foundIndexes as $key => $index){
                if($key == count($foundIndexes) - 1){
                    echo 'INDEX ' . $index;
                } else {
                    echo 'INDEX ' . $index . " and ";
                }
            }
        }
    }
}

$words = array("I","TWO","FORTY","THREE","JEN","TWO", "tWo", "Two");
$target = "TWO";

//execute function
searchWord($target, $words);

?>
