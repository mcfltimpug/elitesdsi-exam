<?php

// Task 5: Display list of albums based on the searched artist

include 'db_connection.php';

function searchAlbums($artist){
    global $conn;

    $query = "SELECT Album FROM album_sales WHERE Artist = '$artist'";

    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        echo "Albums by " . $artist . ": \n";
        while ($row = $result->fetch_assoc()) {
            echo $row['Album'] . "\n";
        }
    } 

}

$artist = 'SMTOWN';
searchAlbums($artist);

$conn->close();
?>