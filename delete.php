<?php
//Require music data & image helpers to use variable in this file
require_once "includes/database.php";

//Retrieve the GET parameter from the 'Super global'
$rowId = $_GET['id'];


//Remove from the database
$query = "DELETE FROM loan_list WHERE id = " . mysqli_escape_string($db, $rowId);

mysqli_query($db, $query) or die ('Error: '.mysqli_error($db));

//Close connection
mysqli_close($db);

//Redirect to homepage after deletion & exit script
header("Location: loanlist.php");
exit;
