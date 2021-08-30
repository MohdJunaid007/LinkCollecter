<?php
//connect to database
// hostName , userName ,password ,databaseName
$conn = mysqli_connect('localhost', 'junaid', 'test1234', 'game');

// check connection
if (!$conn) {
    echo 'connection error: ' . mysqli_connect_error();
}
?>