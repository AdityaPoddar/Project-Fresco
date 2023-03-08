<?php
    include 'header.php';
    include  'connect.php';
    $query_shop = "SELECT * FROM SHOP ORDER BY SHOP_ID ASC";
    $result_shop = oci_parse($conn, $query_shop);
    oci_execute($result_shop);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https:fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/shop.css">

    <!-- <script src="shop.js"></script> -->
    <script src="javascript/navbar.js" async></script>
    <title>Shops</title>
</head>
<body>
    
    <?php   
        include 'navbar.php'
    ?>

    
    <section class="shop-section">
        <div class="shop-container">
            <h1>Shops</h1>
            <?php
                while($row_shop = oci_fetch_assoc($result_shop)){
            ?>
            <div class="shop-card">
                <a href="shop-products.php?shop_id=<?php echo $row_shop['SHOP_ID']?>&shop_name=<?php echo $row_shop['SHOP_NAME']?>" onclick="pass()">
                    <img width="300px" height="250px" src="images/<?php echo $row_shop["SHOP_IMG"]?>" alt="Asda">
                    <p> <?php echo $row_shop["SHOP_NAME"]?></p>
                </a>
            </div>
            <?php
                }
            ?>
        </div>
    </section>

</body>
</html>