<?php
        include 'connection.php';

        $trader_id=$_POST['id'];
        $query="UPDATE USERS SET
            USER_NAME='".$_POST['fullname']."',
            USER_CONTACT='".$_POST['contact']."',
            USER_EMAIL='".$_POST['email']."',
            USER_DESC='".$_POST['description']."'
             WHERE USER_ID= $trader_id ";
            //echo $query;
            $update=oci_parse($connection, $query);

       if( oci_execute($update))
       {
        header("Location: dashboard.php");
         
       } 

       else{
         echo " SORRY!!! NOT UPDATING ";
         

       }