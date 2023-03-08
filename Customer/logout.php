<?php
session_start();
unset($_SESSION['user-id']);
unset($_SESSION['username']);
unset($_SESSION['email']);
unset($_SESSION['success']);

header("Location: Homepage.php");
?>