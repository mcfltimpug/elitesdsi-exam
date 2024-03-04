<?php
// Task 3: Display the top 1 artist who sold most combined album sales
include 'db_connection.php';

$query = "SELECT Artist, SUM(`2022 Sales`) as sales FROM album_sales GROUP BY Artist ORDER BY sales DESC LIMIT 1";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "Top Artist by Combined Album Sales\n";
    while ($row = $result->fetch_assoc()) {
        echo $row['Artist'] . " - " . $row['sales'] . "\n";
    }
} 

$conn->close();

?>