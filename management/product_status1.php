<?php
        include 'connection.php';

        $id=$_GET['id'];

        $query=" UPDATE PRODUCT 
                  SET STATUS=1
                  WHERE PRODUCT_ID=$id";
        echo $query;
        
        $res=oci_parse($connection,$query);
        oci_execute($res);


         header("location:manageproduct.php");
        

?>