<?php
    include 'header.php';
    include 'connection.php';
    
    $review_id = $_GET['review-id'];

    $query = "DELETE FROM REVIEW WHERE REVIEW_ID = $review_id ";
    $result = oci_parse($connection, $query);
    oci_execute($result);

    header('location: managereview.php');
?>