<?php
include '../connection.php';
 if(isset($_GET['approve']))
 {
    $id = $_GET['approve'];
    $query = oci_parse($connection,"SELECT * FROM REQUEST WHERE REQ_ID=$id");
    $result= oci_execute($query);
    if($result)
        {
            $row = oci_fetch_row($query);
        }

    $name=$row['1'];
    $email=$row['2'];
    $contact=$row['3'];
    $shop= $row['4'];
    $description=$row['5'];
    $type="Trader";
    $shopType=$row['6'];

    function rand_string( $length ) {

        $chars = "abcdefghijklmnopqrstuvwxyz@#$%&*ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);
    
    }
    
    $password = rand_string(8);

    #$password = '12345678';
    $pass=password_hash($password, PASSWORD_DEFAULT);


    $select = oci_parse($connection, "SELECT * FROM USERS");
    $run = oci_execute($select);
    if($run)
    {
        $concat=1;
        while($row = oci_fetch_row($select)) 
        {
            if($row['2']==$name) 
            {
                $name = $name.$concat; 
                $concat++;
            }
        }
    }

   $insert = oci_parse($connection,"INSERT INTO USERS (USER_NAME, USER_TYPE, USER_EMAIL, USER_CONTACT,PASSWORD) 
        VALUES ('$name','$type','$email',$contact, '$pass')");
             $execute = oci_execute($insert);
    
    if($execute)
    {
        
        $select = oci_parse($connection, "SELECT * FROM USERS WHERE USER_EMAIL = '$email'");
        $run = oci_execute($select);
        
        if($run)
        {
            
            $row = oci_fetch_row($select);

            $trader_id=$row['0'];
            $insert = oci_parse($connection,"INSERT INTO SHOP (SHOP_NAME,SHOP_DESC,FK1_USER_ID,SHOP_TYPE) 
                    VALUES ('$shop','$description', $trader_id, '$shopType')");
            $execute = oci_execute($insert);
        }

        $to = $email;
        $subject = "Trader Account Has Been Approved";
        $message="Congratulation!! Your account is registered. Please use the following credentials to login:\r\n\r\n";
        $message.="Username: ".$name."\r\n"."Password: ". $password; 
        $header ="From: frescomart05@gmail.com";

        mail($to,$subject,$message,$header);

        header('location:decline.php?sucess="sucess"&decline='.$id );
        
    }
        
 }
 else{
     header("Location:viewdetails.php");
 }
?>