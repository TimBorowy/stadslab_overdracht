<?php
//Require database in this file
require_once "includes/database.php";

//$studentEmail, $items, $dateStart, $dateEnd



//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $id = mysqli_escape_string($db, $_POST['id']);
    $studentEmail = mysqli_escape_string($db, $_POST['email']);
    $items = mysqli_escape_string($db, $_POST['items']);
    $dateStart = mysqli_escape_string($db, $_POST['date-start']);
    $dateEnd = mysqli_escape_string($db, $_POST['date-end']);

    // Does the name of the function. It gives errors back when fields are left open
    function getErrorsForEmptyFields($studentEmail, $items, $dateStart, $dateEnd)
    {
        $errors = [];
        if ($studentEmail == "") {
            $errors[] = 'E-mail moet worden ingevuld';
        }
        if ($items == "") {
            $errors[] = 'Je moet een item selecteren';
        }
        if ($dateStart == "") {
            $errors[] = 'De start datum moet worden ingevuld';
        }
        if ($dateEnd == "") {
            $errors[] = 'De eind datum moet worden ingevuld';
        }

        return $errors;
    }


    if (empty($errors)) {
        //Update the record in the database
        $query = "UPDATE loan_list
                  SET student_number = '$studentEmail', items = '$items', datum_uit = '$dateStart', datum_in = '$dateEnd'
                  WHERE id = '$id'";
        $result = mysqli_query($db, $query);

        if ($result) {
            //Set success message
            $success = true;
        } else {
            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }
    } else {
        //Retrieve the GET parameter from the 'Super global'
        $id = $_GET['id'];

        //Get the record from the database result
        $query = "SELECT * FROM loan_list WHERE id = " . mysqli_escape_string($db, $id);
        $result = mysqli_query($db, $query);
        $album = mysqli_fetch_assoc($result);
        }


}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
<h1>Edit "<?= $loan['id']; ?>"</h1>

</body>
</html>
