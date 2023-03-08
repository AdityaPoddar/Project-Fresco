<?php
    include 'connect.php';
    include 'header.php';

    if(isset($_SESSION['user-id'])){
        $query = "SELECT * FROM ORDERS WHERE FK3_USER_ID = '$user_id'";
        $result = oci_parse($conn, $query);
        oci_execute($result);
    }

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
            <h1>Your Orders</h1>
            <table>
                <thead>
                    <th>Ordered Date</th>
                    <th>Total Price(&pound;)</th>
                    <th>Collection Slot</th>
                </thead>
                <tbody>
                    <?php
                        if(isset($_SESSION['user-id'])){
                            while($row = oci_fetch_assoc($result)){
                                echo "<tr>
                                        <td>$row[ORDER_DATE]</td>
                                        <td>$row[TOTAL_PRICE]</td>
                                        <td>$row[COLLECTION_SLOT]</td>
                                        <td><a href='order-view.php?order_id=$row[ORDER_ID]'>View order</a></td>
                                    </tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>