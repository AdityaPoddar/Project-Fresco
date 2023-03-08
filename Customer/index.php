<?php
    include 'header.php';
    include 'connect.php';
    $query = "SELECT * from PRODUCT ORDER BY PRODUCT_ID ASC";
    $result = oci_parse($conn, $query);
    oci_execute($result);
?>



<html>
    <head>
        <title>
            Welcome to Fresco
        </title>
        <!-- <link rel="preconnect" href="https://fonts.gstatic.com"> -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="https:fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="styles/navbar.css">
        <link rel="stylesheet" href="styles/homepage.css">
        
        <!-- <script src="https://kit.fontawesome.com/26d4a64054.js" crossorigin="anonymous"></script> -->
        <script src="javascript/homepage.js"></script>
        <script src="javascript/navbar.js" async></script>
        <script src="javascript/image-slider.js" async></script>
    </head>
        <body>

            <?php
                include 'navbar.php';
            ?>

            <div class="imageslider">
                <div class="image">
                    <img class="slides" src="images/homepage_cover.jpg" />
                    <img class="slides" src="images/greengrocer(2).jpg" />
                    <img class="slides" src="images/greengrocer(3).jpg" />
                </div>				
	        </div>

            <div class="category-section">
                <h1>Categories</h1>
                <div class="category-split">
                    <div class="row">
                        <a href="category.php?category_name=Butcher" onmouseover="butcher()" id="butcher">
                            <div class="col-5 color0"><img src="images/meat.svg"></div>
                        </a>                       
                        <a href="category.php?category_name=Greengrocer" onmouseover="greengrocer()" id="greengrocer">
                            <div class="col-5 color1"><img src="images/veg.svg"></div>
                        </a>                      
                        <a href="category.php?category_name=Fishmonger" onmouseover="fishmonger()" id="fishmonger">
                            <div class="col-5 color2"><img src="images/fish.svg"></div>
                        </a>                       
                        <a href="category.php?category_name=Bakery" onmouseover="bakery()" id="bakery">
                            <div class="col-5 color3"><img src="images/cup.svg"></div>
                        </a>                      
                        <a href="category.php?category_name=Delicatessen" onmouseover="delicatessen()" id="delicatessen">
                            <div class="col-5 color4"><img src="images/cheese.svg"></div>
                        </a>
                    </div>
                    <div class="hover-image">
                        <img id="hover-img" src="images/bakery.jpg" width="auto" height="auto">
                    </div>
                </div>
            </div>


            <div class="product-section">
                <div class="product-container">
                <h1>Products</h1>
                    <?php
                        while($row= oci_fetch_assoc($result)){
                    ?>
                    <form action="mybasket.php" id="addtobasket" method="post">
                        <div class="card">
                            <a href="products.php?product_id=<?php echo $row['PRODUCT_ID']?>">  
                                <img  src="images/<?php echo $row['PRODUCT_IMG']?>" alt="<?php echo $row['PRODUCT_NAME']?>">
                                <p><?php echo $row['PRODUCT_NAME']?></p>
                                <p>£ <?php echo $row['PRODUCT_PRICE']?></p>
                            </a>
                            
                            <input type="hidden" name="product_id" value="<?php echo $row['PRODUCT_ID']?>">
                            <input type="hidden" name="product_name" value="<?php echo $row['PRODUCT_NAME']?>">
                            <input type="hidden" name="product_img" value="<?php echo $row['PRODUCT_IMG']?>">
                            <input type="hidden" name="product_price" value="<?php echo $row['PRODUCT_PRICE']?>">
                            <input type="hidden" name="min" value="<?php echo $row['MIN_ORDER']?>">
                            <input type="hidden" name="max" value="<?php echo $row['MAX_ORDER']?>">
                            <input type="hidden" name="page" value="index.php">
                            <button class="addtobasket" id="addtobasket" type="submit"  name="addtobasket"><svg class="basketsvg" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 91.64 105.81"><defs><style>.cls-1,.cls-2{fill:none;stroke:#010101;stroke-miterlimit:10;stroke-width:5.67px;}.cls-2{stroke-linecap:round;}</style></defs><title>basket</title><path class="cls-1" d="M2.83,33.06h86a0,0,0,0,1,0,0V81.72A21.26,21.26,0,0,1,67.55,103H24.09A21.26,21.26,0,0,1,2.83,81.72V33.06A0,0,0,0,1,2.83,33.06Z"/><path class="cls-2" d="M516.35,490.45V466.36a16.86,16.86,0,0,0-16.85-16.85h0a16.86,16.86,0,0,0-16.85,16.85v24.09" transform="translate(-453.68 -446.68)"/></svg></button>
                        </div>
                    </form>
                    <?php
                        }
                    ?>
                </div>
            </div>
                
        </body>
    
</html>