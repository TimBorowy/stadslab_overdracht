<?php
require_once('server.php');
require_once('includes/database.php');
require_once('errors.php');

    // Check if 'submit' has been set
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = $_POST['password'];

    // Create query to compare entered username and password to database
    $sql = "SELECT id FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row;

    // Check if username and password are on same row in database
    $count = mysqli_num_rows($result);

    // Errors
    if (empty($username)) {
        array_push($errors, "Username is required");
    } if (empty($password)) {
        array_push($errors, "Password is required");
    } if ($username && $password != $result)
    { array_push($errors, "Wrong username/password combination");
    }

    // If result matched $username and $password, table row must be 1 row
    if($count == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['login_user'] = "You are now logged in";
        header('Location: admin.php');
    }
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<nav class="topnav" id="myTopnav">
    <a href="https://www.stadslabrotterdam.nl" class="inactive">Stadslab</a>
    <a href="index.php" class="inactive">Reserveren</a>
    <a href="admin.php" class="active">Login</a>
    <a href="javascript:void(0);" class="icon" onclick="jsNav()">
        <i class="fa fa-bars"></i>
    </a>
</nav>

<div class="header">
    <h2>Login</h2>
</div>

<form method="post" action="">
    <div>
    <?php include('errors.php')?>
    </div>
    <div class="input-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
    </div>
    <div class="input-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>
    <div class="btn1cont" align="center">
        <input type="submit" class="btn1" name="submit" value="Login"/>
    </div>
</form>
<script src="js/topnav.js"></script>

</body>
</html>