<?php

// Task 4: Display the top 10 albums per year based on their number of sales

include 'db_connection.php';

$query = 
"SELECT 
    CONCAT('20', SUBSTRING(`Date Released`, 1, 2)) AS Year,
    Album,
    `2022 Sales`,
    `Date Released`
FROM 
    album_sales AS a1
WHERE 
    (SELECT COUNT(*) FROM album_sales AS a2 WHERE SUBSTRING(a2.`Date Released`, 1, 2) = SUBSTRING(a1.`Date Released`, 1, 2) AND a2.`2022 Sales` >= a1.`2022 Sales`) <= 10
ORDER BY 
    SUBSTRING(`Date Released`, 1, 2), `2022 Sales` DESC";

$result = $conn->query($query);

if ($result) {
    $albums_by_year = [];
    
    while ($row = $result->fetch_assoc()) {
        $year = substr($row['Year'], 0, 4);
        $albums_by_year[$year][] = $row;
    }
    
    foreach ($albums_by_year as $year => $albums) {
        echo "Top 10 Albums in " . $year . "\n";
        $top = 1;
        foreach ($albums as $album) {
            echo "Top " . $top . ": " . $album['Album'] . " - " . $album['2022 Sales'] . "\n";
            $top++;
        }
        echo "\n";
    }
} else {
    echo "Error executing query: " . $conn->error;
}

$conn->close();
?>
