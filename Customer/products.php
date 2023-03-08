<?php
    include 'header.php';
    include  'connect.php';
    $url_pid = $_GET['product_id'];    
    $query = "SELECT * FROM PRODUCT WHERE PRODUCT_ID= '$url_pid' ";
    $result = oci_parse($conn, $query);
    oci_execute($result);
    // $query_reviews = "SELECT * FROM REVIEW where FK1_PRODUCT_ID = '$url_pid' ";
    $query_reviews = "SELECT * FROM REVIEW INNER JOIN USERS ON REVIEW.FK2_USER_ID = USERS.USER_ID WHERE FK1_PRODUCT_ID = '$url_pid' ";
    
    $result_reviews = oci_parse($conn, $query_reviews);
    oci_execute($result_reviews);

    $rating_avg_query = "SELECT REVIEW_RATING FROM REVIEW WHERE FK1_PRODUCT_ID = '$url_pid'";
    $rating_avg_result = oci_parse($conn, $rating_avg_query);
    oci_execute($rating_avg_result);

    $paypal_email = 'sb-kaas76626075@business.example.com';
?>





<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/products.css"/>
        <link rel="stylesheet" type="text/css" href="styles/navbar.css"/>
        <link rel="stylesheet" href="https:fonts.googleapis.com/icon?family=Material+Icons">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet"> 
        <link rel="preconnect" href="https://fonts.gstatic.com"/>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet"/>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- <script src="javascript/products.js" async></script> -->
        <script src="javascript/navbar.js" async></script>
        <?php
            while($row = oci_fetch_array($result)){
        ?>
        <title><?php echo $row["PRODUCT_NAME"]?></title>
    </head>
    <body>
        
        <?php   
            include 'navbar.php'
        ?>
             
        <section class="container">
            <div class="left">
                <img src="images/<?php echo $row["PRODUCT_IMG"]?>"/>
            </div>

            <!-- RIGHT COLUMN -->
            <div class="right">
                
                    <div class="product-description">
                        <h2><?php echo $row["PRODUCT_NAME"]?></h2><br>
                        <p class="main-info"><?php echo $row["PRODUCT_DESC"]?></p><br>
                        <p class="main-info">Price: &pound;<?php echo $row["PRODUCT_PRICE"]?></p><br>
                        <?php
                            $rating = 0;
                            $rating_avg = 0;
                            while($review_rate = oci_fetch_assoc($rating_avg_result)){
                                $rating = $rating_avg + $review_rate['REVIEW_RATING'];
                                $rating_avg = $rating / 5;
                            }
                            echo "<p class='info'>Average Rating: $rating_avg</p><br>";
                        ?> 
                        <p class="info">Stock available: <?php echo $row["PRODUCT_STOCK"]?></p><br>   
                    </div>
                    <!-- <div class='quantity-selector'>
                        <button id="plus" onclick="increment()">+</button>
                        <div><span id="quan"></span></div>
                        <button id="minus" onclick="decrement()">-</button>
                    </div> -->
                        <form action="mybasket.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $row['PRODUCT_ID']?>">
                            <input type="hidden" name="product_name" value="<?php echo $row['PRODUCT_NAME']?>">
                            <input type="hidden" name="product_img" value="<?php echo $row['PRODUCT_IMG']?>">
                            <input type="hidden" name="product_price" value="<?php echo $row['PRODUCT_PRICE']?>">
                            <input type="hidden" name="page" value="products.php?product_id=<?php echo $url_pid?>">
                    <div class="buttons">
                            <button id="basket-btn" type="submit" name="addtobasket">Add to basket</button>
                        </form>

                        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">			
                            <!-- Paypal business test account email id so that you can collect the payments. -->
                            <input type="hidden" name="business" value="<?php echo $paypal_email; ?>">			
                            <!-- Buy Now button. -->
                            <input type="hidden" name="cmd" value="_xclick">			
                            <!-- Details about the item that buyers will purchase. -->
                            <input type="hidden" name="item_name" value="<?php echo $row['PRODUCT_NAME']?>">
                            <input type="hidden" name="item_number" value="<?php echo $row['PRODUCT_ID']?>">
                            <input type="hidden" name="amount" value="<?php echo $row['PRODUCT_PRICE']?>">
                            <input type="hidden" name="currency_code" value="GBP">			
                            <!-- URLs -->
                            <input type='hidden' name='cancel_return' value='http://localhost/Fresco/products.php?product_id=<?php echo $url_pid?>'>
                            <input type='hidden' name='return' value='http://localhost/Fresco/single-order.php?product_id=<?php echo $url_pid?>'>						
                            <!-- payment button. -->
                            <!-- <input type="image" name="submit" border="0"
                            src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online">
                            <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >     -->
                            <button type="submit" name="submit" id="buy-btn" >Buy now</button>
                        </form>



                        
                    </div>
                
            </div>    
        </section>

        <div class="comments">
            <div class="add-comment">
                <h3>Add a comment</h3>
                <!-- <div class="customer-comment" method="post" contenteditable></div> -->
                
                <form id="review-form" action="review-insert.php" method="post">
                    <input class="customer-comment" type="text" name="comment" placeholder="Add a comment">
                    <p id="rating-title">Rate this product:</p>
                    <input class="product-rating" type="number" name="rating" maxlength="1" min="1" max="5" placeholder="Rating">
                    <input type="hidden" name="product_id_fk" value="<?php echo $url_pid?>">
                    <input type="hidden" name="user_id" value="<?php echo $user_id?>">
                    <button class="post" type="submit" form="review-form">Post</button>
                </form>                
            </div>

            <div class="comment-container">
                <h3>Comments</h3>
                <div class="comment-list">
                    <?php
                        while($row_reviews = oci_fetch_assoc($result_reviews)){
                    ?>
                    <div class="comment-cards">
                        <p><?php echo $row_reviews['USER_NAME']?></p>
                        <p><?php echo $row_reviews['REVIEW_COMMENT']?></p>
                        <?php
                            if(isset($_SESSION['user-id'])){
                                $user_id= $_SESSION['user-id'];
                                if($user_id == $row_reviews['USER_ID']){
                        ?>
                        <a href='deletereview.php?review-id=<?php echo $row_reviews['REVIEW_ID']?>&product-id=<?php echo $url_pid?>'><button class='review-delete-btn'><span class='material-icons'>delete</span></button></a>
                        <?php            
                                }
                            }
                        ?>
                        <p>Rating: <?php echo $row_reviews['REVIEW_RATING']?></p>
                        <p><?php echo $row_reviews['REVIEW_DATE']?></p>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
         
        <?php
            }
        ?>
        
    </body>
</html>

