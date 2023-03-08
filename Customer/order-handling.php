<?php
    include 'connect.php';
    include 'header.php';

    $grandtotal = $_POST['total_amount'];
    $collection_day = $_POST['dayselected'];
    $collection_time = $_POST['hour'];
    $collection_slot = $collection_day ." ". $collection_time;

    $query = "INSERT INTO ORDERS(ORDER_DATE, COLLECTION_SLOT, FK3_USER_ID, TOTAL_PRICE) VALUES (SYSDATE, '$collection_slot', '$user_id', '$grandtotal')";
    $result = oci_parse($conn, $query);
    oci_execute($result);

    foreach($_SESSION['cart'] as $key => $value){
        $product_id = $value['product_id'];
        $quantity = $value['quantity'];
        $price = $value['product_price'];
        $total_per_product = $quantity * $price;

        // for commission
        $commission_rate = 20/100;
        $commission_per_product = $commission_rate * $total_per_product;

        $od_query = "INSERT INTO ORDER_DETAIL (ORDERDETAIL_QUANTITY, FK1_ORDER_ID, FK2_PRODUCT_ID, UNIT_PRICE, TOTAL_PER_PRODUCT, COMMISSION_PER_PRODUCT, ORDER_DATE)
                    VALUES ('$quantity', ORDERS_SEQ.CURRVAL, '$product_id', '$price', '$total_per_product', '$commission_per_product', SYSDATE)";
        
        $od_result = oci_parse($conn, $od_query);
        oci_execute($od_result);

        $get_stock = "SELECT PRODUCT_STOCK FROM PRODUCT WHERE PRODUCT_ID = '$product_id'";
        $get_stock_result = oci_parse($conn, $get_stock);
        oci_execute($get_stock_result);
        
        $row = oci_fetch_assoc($get_stock_result);

        $stock = $row['PRODUCT_STOCK'];
        $stock_available = $stock - $quantity;

        $stock_update = "UPDATE PRODUCT SET PRODUCT_STOCK = '$stock_available' WHERE PRODUCT_ID = '$product_id' ";
        $stock_update_result = oci_parse($conn, $stock_update);
        oci_execute($stock_update_result);
    }

    unset($_SESSION['cart']);
    header('location: basket.php');
?>