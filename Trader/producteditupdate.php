<?php
    include 'connection.php';


        $query="UPDATE PRODUCT SET
            PRODUCT_NAME='".$_POST['fullname']."',
            PRODUCT_PRICE='".$_POST['price']."',
            PRODUCT_DESC='".$_POST['description']."'
            
            WHERE PRODUCT_ID=".$_POST['id']."";
            echo $query;

            $res=oci_parse($connection, $query);
            $exe=oci_execute($res);
       if($exe){
        header("Location: traderproduct.php");
         
       } 

       else{
         echo" SORRY!!! NOT UPDATING ";
         

       }