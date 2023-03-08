<?php
    include 'connect.php';
    include 'header.php';

    $order_id = $_GET['order_id'];

    $query = "SELECT * FROM PRODUCT p INNER JOIN ORDER_DETAIL o ON p.PRODUCT_ID = o.FK2_PRODUCT_ID WHERE o.FK1_ORDER_ID = '$order_id'";
    $result = oci_parse($conn, $query);
    oci_execute($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https:fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="styles/order.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <script src="javascript/navbar.js"></script>
    <title>Document</title>
</head>
<body>
    <?php
        include 'navbar.php';
    ?>

    <div class="main-container">
        <div class="order-section">
            <h1>Order Summary</h1>
            <table>
                <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Total Price(&pound;)</th>
                </thead>
                <tbody>
                    <?php
                        while($row = oci_fetch_assoc($result)){
                            echo "<tr>
                                    <td><img src='images/$row[PRODUCT_IMG]' width='150' height='100'></td>
                                    <td>$row[PRODUCT_NAME]</td>
                                    <td>$row[ORDERDETAIL_QUANTITY]</td>
                                    <td>$row[TOTAL_PER_PRODUCT]</td>
                                </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>