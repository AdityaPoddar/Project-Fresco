<?php 
    session_start();

    if(isset($_SESSION['user-id'])){
        $user_id = $_SESSION['user-id'];
    }
?>