<?php
    include 'header.php';
    include 'connect.php';

    if(isset($_SESSION['user-id']) && $_SESSION['user-type'] == 'Customer'){
        $comment = $_POST['comment'];
        $rating = (int)$_POST['rating'];
        $product_id_fk = $_POST['product_id_fk'];
        $user_id_fk = $_POST['user_id'];
        // $date_posted = $_POST['date_posted'];



        $query = "INSERT INTO REVIEW (REVIEW_DATE, REVIEW_RATING, REVIEW_COMMENT, FK1_PRODUCT_ID, FK2_USER_ID) VALUES (SYSDATE, :rating, :usercmt, :proid, :userid)";

        

        $result = oci_parse($conn, $query);
        

        oci_bind_by_name($result, ":usercmt", $comment);
        oci_bind_by_name($result, ":rating", $rating);
        oci_bind_by_name($result, ":proid", $product_id_fk);
        oci_bind_by_name($result, ":userid", $user_id_fk);
        // oci_bind_by_name($result, ":postdate", $date_posted);
        echo $query;
        oci_execute($result);

        header('location:products.php?product_id='.$product_id_fk);
    }
    else{
        echo "<script>alert('Please login to review this product');
        window.location.href='login.php';        
        </script>";
    }
?>