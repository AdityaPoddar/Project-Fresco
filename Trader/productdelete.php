<?php
        include 'connection.php';
        $query="DELETE from PRODUCT where PRODUCT_ID=".$_GET['pid'];
        //echo $query;
        $res=oci_parse($connection,$query);
        oci_execute($res);
        header("location: traderproduct.php");
        exit();
   ?> 