<?php

// Task 2: Display combined album sales per artist
include 'db_connection.php';

$query = "SELECT Artist, SUM(`2022 Sales`) as sales FROM album_sales GROUP BY Artist";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "Combined Album Sales Per Artist \n";
    while ($row = $result->fetch_assoc()) {
        echo $row['Artist'] . " - " . $row['sales'] . "\n";
    }
} 

$conn->close();
?>