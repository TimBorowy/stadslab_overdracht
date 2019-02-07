<?php
require_once('server.php');
require_once('includes/database.php');
require_once('errors.php');

if (isset($_POST['submit'])) {
//Postback with the data showed to the user, first retrieve data from 'Super global'
    $firstname =    mysqli_real_escape_string($db, $_POST['firstname']);
    $studentEmail = mysqli_real_escape_string($db, $_POST['email']);
    $items =        mysqli_real_escape_string($db, $_POST['items']);
    $items2 =       mysqli_real_escape_string($db, $_POST['items2']);
    $dateStart =    mysqli_real_escape_string($db, $_POST['date-start']);
    $dateEnd =      mysqli_real_escape_string($db, $_POST['date-end']);

    $errors = getErrorsForFields($firstname, $studentEmail, $items, $items2, $dateStart, $dateEnd);

    $hasErrors = !empty($errors);

    if (!$hasErrors) {
        insertReservationIntoDatabase($db, $firstname, $studentEmail, $items, $items2, $dateStart, $dateEnd);
    }
}
// Does the name of the function. It gives errors back when fields are left open
    function getErrorsForFields($firstname, $studentEmail, $items, $items2, $dateStart, $dateEnd)
    {
        $errors = [];
        if ($firstname == "") {
            $errors[] = 'Je voornaam moet worden ingevuld';
        }
        if ($studentEmail == "") {
            $errors[] = 'E-mail moet worden ingevuld';
        }
        if (!filter_var($studentEmail, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Je email adres is geen geldig email adres";
        }else{
            $explodedEmail = explode("@",$studentEmail);
            if ($explodedEmail[1] != "hr.nl" ){
                $errors[] = "Je email adres moet een HR email adres zijn";
            }
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

function insertReservationIntoDatabase($db, $firstname, $studentEmail, $items, $items2, $dateStart, $dateEnd)
{

    $query = "INSERT INTO loan_list (first_name, student_number, items, items2, datum_uit, datum_in)
                  VALUES ('$firstname', '$studentEmail', '$items', '$items2', '$dateStart', '$dateEnd')";
    $result = mysqli_query($db, $query)
    or die('Error: ' . $query);
//When you inserted data into the table you'll get redirected to the index.php page
    if ($result) {
        header('Location: success.php');
        exit;
    } else {
        $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
    }
}
//Close connection
mysqli_close($db);


?>


<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">



</head>
<body>
<title>Reserveren</title>

<nav class="topnav" id="myTopnav">
    <a href="https://www.stadslabrotterdam.nl" class="inactive">Stadslab</a>
    <a href="index.php" class="active">Reserveren</a>
    <a href="admin.php" class="inactive">Login</a>
    <a href="javascript:void(0);" class="icon" onclick="jsNav()">
        <i class="fa fa-bars"></i>
    </a>
</nav>

<div class="header">
    <h2>Artikelen Reserveren</h2>
</div>

<form method="post" action="">
    <div>
        <?php include('errors.php')?>
    </div>
    <div class="input-group">
        <label for="firstname">Voornaam</label>
        <input type="text" name="firstname" id="firstname">
    </div>
    <div class="input-group">
        <label for="email">HR E-mail</label>
        <input type="email" name="email" id="email">
    </div>

    <select class="input-group2" name="items" onmousedown="if(this.options.length>8){this.size=8;}"  onchange='this.size=0;' onblur="this.size=0;">
        <option value="1x Arduino">1x Arduino</option>
        <option value="2x Arduino">2x Arduino</option>
        <option value="3x Arduino">3x Arduino</option>
        <option value="1x Raspberry Pi v2">1x Raspberry Pi v2</option>
        <option value="2x Raspberry Pi v2">2x Raspberry Pi v2</option>
        <option value="3x Raspberry Pi v2">3x Raspberry Pi v2</option>
        <option value="1x Bread Board">1x Bread board</option>
        <option value="2x Bread Board">2x Bread board</option>
        <option value="3x Bread Board">3x Bread board</option>
        <option value="1x Force sensing resistor">1x Force sensing resistor</option>
        <option value="2x Force sensing resistor">2x Force sensing resistor</option>
        <option value="3x Force sensing resistor">3x Force sensing resistor</option>
    </select>

    <select class="input-group2" name="items2" onmousedown="if(this.options.length>8){this.size=8;}"  onchange='this.size=0;' onblur="this.size=0;">
        <option value="Geen">Geen</option>
        <option value="1x Arduino">1x Arduino</option>
        <option value="2x Arduino">2x Arduino</option>
        <option value="3x Arduino">3x Arduino</option>
        <option value="1x Raspberry Pi v2">1x Raspberry Pi v2</option>
        <option value="2x Raspberry Pi v2">2x Raspberry Pi v2</option>
        <option value="3x Raspberry Pi v2">3x Raspberry Pi v2</option>
        <option value="1x Bread Board">1x Bread board</option>
        <option value="2x Bread Board">2x Bread board</option>
        <option value="3x Bread Board">3x Bread board</option>
        <option value="1x Force sensing resistor">1x Force sensing resistor</option>
        <option value="2x Force sensing resistor">2x Force sensing resistor</option>
        <option value="3x Force sensing resistor">3x Force sensing resistor</option>
    </select>


    <div class="input-group">
        <label for="date-start">Begin datum</label>
        <input type="date" name="date-start" id="date-start">
    </div>
    <div class="input-group">
        <label for="date-end">Eind datum</label>
        <input type="date" name="date-end" id="date-end">
    </div>
    <p class="error-date" id="date-verified">Het leentermijn is 2 weken</p>
    <div class="btn1cont" align="center">
        <input type="submit" class="btn1" name="submit" value="Reserveren"/>
    </div>
</form>




<script src="js/topnav.js"></script>
<script src="js/datepicker.js"></script>

</body>
</html>
