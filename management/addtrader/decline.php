<?php
include '../connection.php';
     if(isset($_GET['decline']))
     {
         $id = $_GET['decline'];
         $query =oci_parse($connection,"DELETE FROM REQUEST WHERE REQ_ID = $id");
         $execute = oci_execute($query);

         if($execute)
         {
          header("location:request.php?decline='decline'");
         }
        
     }

     if(isset($_GET['sucess']))
     {
         $id = $_GET['decline'];
         $query =oci_parse($connection,"DELETE FROM REQUEST WHERE REQ_ID = $id");
         $execute = oci_execute($query);

         if($execute)
         {
          header("location:request.php?sucess='sucess'");
         }
        
     }
?>