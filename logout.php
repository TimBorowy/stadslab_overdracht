<?php
session_start();
session_destroy();

//Redirect
header("Location: login.php");
exit;
