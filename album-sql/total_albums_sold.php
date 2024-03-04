<?php

// Task 1: Display total number of albums sold per artist

include 'db_connection.php';

$query = "SELECT Artist, COUNT(`ALBUM`) AS album_count FROM album_sales GROUP BY Artist";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "Total Number of Albums Sold Per Artist \n";
    while ($row = $result->fetch_assoc()) {
        echo $row['Artist'] . " - " . $row['album_count'] . "\n";
    }
} 

$conn->close();
?>