<?php
        include 'connection.php';

        $id=$_GET['id'];

        $query=" UPDATE USERS 
                  SET STATUS=0
                  WHERE USER_ID=$id";
        //echo $query;
        
        $res=oci_parse($connection,$query);
        oci_execute($res);


          header("location:manageacc.php");
        

?>