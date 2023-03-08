<?php
include 'connection.php';
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$trader_id_fk = $_POST['user_id_fk'];

if(isset($_POST["Submit"])){
$query="INSERT INTO SHOP(SHOP_NAME,SHOP_lOCATION,SHOP_DESC,FK1_USER_ID)
        VALUES(
            '".$_POST['shopname']."',
            '".$_POST['location']."',
            '".$_POST['description']."',
               '$trader_id_fk')";
    

            
          //  echo $query;
          $res=oci_parse($connection,$query);
                oci_execute($res);
           echo"<br><br>";
          // echo "<i>CLICK THE BELOW LINK TO LOGIN INTO YOUR DETAIL</i>";
            //echo"<br><br>";
            header("location: dashboard.php");
            }
              else
              {
                echo"not entering";
              }
  ?>