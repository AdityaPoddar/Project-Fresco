<?php
    include 'header.php';
    include 'connect.php';

    $review_id = $_GET['review-id'];
    $product_id = $_GET['product-id'];

    $query = "DELETE FROM REVIEW WHERE REVIEW_ID = $review_id ";
    $result = oci_parse($conn, $query);
    oci_execute($result);

    header('location: products.php?product_id='.$product_id);
?>