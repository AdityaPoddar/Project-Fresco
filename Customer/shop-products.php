<?php
    include 'header.php';
    include 'connect.php';
    $sid = $_GET['shop_id'];
    $sname = $_GET['shop_name'];
    $query = "SELECT * FROM PRODUCT WHERE FK1_SHOP_ID = '$sid' ";
    $result = oci_parse($conn, $query);
    oci_execute($result);

    // echo $query;
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
    <link rel="stylesheet" href="styles/shop-products.css">
    <link rel="stylesheet" href="styles/navbar.css">
    
    <script src="javascript/navbar.js" async></script>
    <script src="javascript/image-slider.js" async></script>
    <title>Document</title>
</head>
<body>
    <?php
        include 'navbar.php';
    ?>

    <div class="main-content">
        <!-- <div class="trader-type">

        </div> -->
        <div class="imageslider">
            <div class="image">
                <img class="slides" src="images/greengrocer.jpg" />
                <img class="slides" src="images/greengrocer(2).jpg" />
                <img class="slides" src="images/greengrocer(3).jpg" />
            </div>				
	    </div>
        <div class="product-section">
            <div class="product-container">
                <h1>Products from <?php echo $sname?></h1>
                <?php
                    while($row = oci_fetch_assoc($result)){
                ?>
                <form action="mybasket.php" id="addtobasket" method="post">
                    <div class="card">
                        <a href="products.php?product_id=<?php echo $row['PRODUCT_ID']?>">  
                            <img  src="images/<?php echo $row['PRODUCT_IMG']?>" alt="<?php echo $row['PRODUCT_NAME']?>">
                            <p><?php echo $row['PRODUCT_NAME']?></p>
                            <p>?? <?php echo $row['PRODUCT_PRICE']?></p>
                        </a>
                        <input type="hidden" name="product_id" value="<?php echo $row['PRODUCT_ID']?>">
                        <input type="hidden" name="product_name" value="<?php echo $row['PRODUCT_NAME']?>">
                        <input type="hidden" name="product_img" value="<?php echo $row['PRODUCT_IMG']?>">
                        <input type="hidden" name="product_price" value="<?php echo $row['PRODUCT_PRICE']?>">
                        <input type="hidden" name="page" value="shop-products.php?shop_id=<?php echo $sid?>&shop_name=<?php echo $sname?>">
                        <button class="addtobasket" id="addtobasket" type="submit"  name="addtobasket"><svg class="basketsvg" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 91.64 105.81"><defs><style>.cls-1,.cls-2{fill:none;stroke:#010101;stroke-miterlimit:10;stroke-width:5.67px;}.cls-2{stroke-linecap:round;}</style></defs><title>basket</title><path class="cls-1" d="M2.83,33.06h86a0,0,0,0,1,0,0V81.72A21.26,21.26,0,0,1,67.55,103H24.09A21.26,21.26,0,0,1,2.83,81.72V33.06A0,0,0,0,1,2.83,33.06Z"/><path class="cls-2" d="M516.35,490.45V466.36a16.86,16.86,0,0,0-16.85-16.85h0a16.86,16.86,0,0,0-16.85,16.85v24.09" transform="translate(-453.68 -446.68)"/></svg></button>
                    </div>
                </form>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>