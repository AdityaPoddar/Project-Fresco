<?php
    include 'header.php';
    include 'connect.php';

    $product_id = $_GET['product_id'];

    $query = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = '$product_id'";
    $result = oci_parse($conn, $query);
    oci_execute($result);

    $row = oci_fetch_assoc($result);

    $price = $row['PRODUCT_PRICE'];

    $order_query = "INSERT INTO ORDERS(ORDER_DATE, FK3_USER_ID, TOTAL_PRICE) VALUES (SYSDATE, '$user_id', '$price')";
    $order_result = oci_parse($conn, $order_query);
    oci_execute($order_result);

    // for commission
    $commission_rate = 20/100;
    $commission = $commission_rate * $price;

    $od_query = "INSERT INTO ORDER_DETAIL (ORDERDETAIL_QUANTITY, FK1_ORDER_ID, FK2_PRODUCT_ID, UNIT_PRICE, TOTAL_PER_PRODUCT, COMMISSION_PER_PRODUCT, ORDER_DATE)
                VALUES (1, ORDERS_SEQ.CURRVAL, '$product_id', '$price', '$price', '$commission', SYSDATE)";
    $od_result = oci_parse($conn, $od_query);
    oci_execute($od_result);

    $stock = $row['PRODUCT_STOCK'];
    $stock_available = $stock - 1;

    $stock_update = "UPDATE PRODUCT SET PRODUCT_STOCK = '$stock_available' WHERE PRODUCT_ID = '$product_id' ";
    $stock_update_result = oci_parse($conn, $stock_update);
    oci_execute($stock_update_result);

    header('location: products.php?product_id='.$product_id);
?>