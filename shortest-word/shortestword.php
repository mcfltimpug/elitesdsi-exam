<?php

function shortestWord($string){
    //convert string to an array of words
    $words = str_word_count($string, 1);

    //initialize shortest length
    $shortestLength = PHP_INT_MAX;
    $shortestWord = "";

    //check length of each words
    foreach($words as $word){
        $wordLength = strlen($word);

        //if length is less than the $shortestLength
        if($wordLength < $shortestLength){
            $shortestLength = $wordLength;
            $shortestWord = $word;
        }
    }

    //give results
    return array("word" => $shortestWord, "length" => $shortestLength);
}

//execute function

$string = "TRUE FRIENDS ARE ME AND YOU";
$result = shortestWord($string);

echo $string . "\n";
echo $result['length'] . '- BECAUSE THE SHORTEST WORD IS "' . $result['word'] . '"';

?>