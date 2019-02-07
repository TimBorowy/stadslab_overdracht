<?php
//Credentials
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'stadslab';

//Create connection
$db = mysqli_connect($host, $user, $password, $database)
or die("Connection Error: " . mysqli_connect_error());











////Create query for db & fetch result
//$queryAll = "SELECT * FROM inventory";
//$result = mysqli_query($db, $queryAll);
////print_r($result);
//
////Create array & store from the database, we use while because it's unclear how much data we have
//$items = [];
//while($row = mysqli_fetch_assoc($result)) {
//    $items[] = $row;
//}
