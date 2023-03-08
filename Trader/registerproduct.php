<?php
include 'connection.php';
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";

$trader_id_fk = $_POST['user_id_fk'];
$shop_id_fk=$_POST['shop_id_fk'];
echo $shop_id_fk;

if(isset($_POST["submit"])){
$query="INSERT INTO PRODUCT(PRODUCT_NAME,PRODUCT_PRICE,PRODUCT_STOCK,PRODUCT_DESC,FK1_SHOP_ID,FK2_USER_ID,PRODUCT_CATEGORY,PRODUCT_SUB_CATEGORY,STATUS)
        VALUES(
            '".$_POST['fullname']."',
            '".$_POST['price']."',
            '".$_POST['stock']."',
            '".$_POST['description']."',
            '$shop_id_fk',
            '$trader_id_fk',  
            '".$_POST['product_cat']."',
            '".$_POST['product_subcat']."',
               1)";
    

            
          //  echo $query;
          $res=oci_parse($connection,$query);
                oci_execute($res);
           echo"<br><br>";
          // echo "<i>CLICK THE BELOW LINK TO LOGIN INTO YOUR DETAIL</i>";
            //echo"<br><br>";
            header("location: traderproduct.php");
            }
              else
              {
                echo"not entering";
              }
?>