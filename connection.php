<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpassword = '';
$dbname = 'my_wavesound';

// Create connection
$connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

?>