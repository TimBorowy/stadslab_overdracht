<?php
session_start();

// check ingelogd?

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('Location: login.php');
    exit;
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<div class="topnav" id="myTopnav">
    <a href="https://www.stadslabrotterdam.nl" class="inactive">Stadslab</a>
    <a href="index.php" class="inactive">Reserveren</a>
    <a href="admin.php" class="active">Login</a>
    <a href="javascript:void(0);" class="icon" onclick="jsNav()">
        <i class="fa fa-bars"></i>
    </a>
</div>

<div class="header">
    <h2>Administration</h2>
</div>
<div class="content">


    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) { ?>
        <p class="welcome" align="center"> Welcome, <?php echo $_SESSION['username']; ?>!  </p> <br>
        <div class="btn1cont" align="center">
            <a class="btn1" href="inventory.php" rel="nofollow noopener">Inventory</a>
        </div>
        <div class="btn1cont" align="center">
            <a class="btn1" href="loanlist.php"  rel="nofollow noopener">Loan list</a>
        </div>
        <div class="btn1cont" align="center">
            <a class="btn1" href="logout.php" rel="nofollow noopener">Log out</a>
        </div>
    <?php } ?>
</div>

<script src="js/topnav.js"></script>

</body>
</html>
