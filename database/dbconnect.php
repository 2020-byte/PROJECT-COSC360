<?php


$host = 'cosc360.ok.ubc.ca'
$user = '88262753'
$password = '88262753'
$dbname = 'db_88262753'

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>