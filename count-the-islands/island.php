<?php

function countIslands($matrix){
    //determine length of $rows and $cols
    $rows = count($matrix);
    $cols = count($matrix[0]);
    $islandCount = 0;

    //run through each data using $rows and $columns
    for($i = 0; $i < $rows; $i++){
        for($j = 0; $j < $cols; $j++){

            //check if data is equivalent to 1 and return X, else return ~
            if($matrix[$i][$j] == 1){
                echo 'X';
                //increment count to $islandCount
                $islandCount++;
            }else{
                echo '~';
            }
        }
        //add new line after each row
        echo "\n";
    }

    //print number of island count
    echo "There are " . $islandCount . " islands in the image.";
}

//given matrix
$matrix = [
    [1, 1, 1, 1],
    [0, 1, 1, 0],
    [0, 1, 0, 1],
    [1, 1, 0, 0]
];

//execute function
countIslands($matrix);

?>