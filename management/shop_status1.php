<?php
        include 'connection.php';

        $id=$_GET['id'];

        $query=" UPDATE SHOP 
                  SET STATUS=1
                  WHERE SHOP_ID=$id";
        //echo $query;
        
        $res=oci_parse($connection,$query);
        oci_execute($res);


          header("location:manageshop.php");
        

?>