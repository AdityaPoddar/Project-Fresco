<?php
    include 'header.php';
    error_reporting(0);
    include 'connection.php';
    // session_start();
    $search_product=$_POST['search-product'];

    $user_id = $_SESSION['id'];

    if(!isset($search_product)){
        $search_product = '';
    }
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
    <link rel="stylesheet" href="https://fonts.google.com/icons?selected=Material%20Icons%20Outlined%3Adelete">
    <link rel="stylesheet" href="styles/traderreview.css">
    <link rel="stylesheet" href="styles/tmnav.css">
    <script src="javascript/tmnav.js" async></script>
    <title>Review</title>
</head>
<body>
    
    <?php
        include 'tmnav.php';
    ?>

        <!-- -----------------------------------------main content---------------------------------------------------- -->

        <section class="main-content">
            <div class="top-section">
                <form action="" method="post">
                    <div class="top-left">
                        <h1>Reviews</h1>
                        <div class="search-box">
                            <input type="text" name="search-product" value="<?php echo $search_product?>" placeholder="Product Name">
                            <button name="search-btn">
                                <span class="material-icons md-18">search</span>
                            </button>
                        </div>
                        <div>
                            <?php
                                $shop_query = "SELECT * FROM SHOP WHERE FK1_USER_ID = '$user_id'";
                                $shop_result = oci_parse($connection, $shop_query);
                                oci_execute($shop_result);
                                while($shop_row = oci_fetch_assoc($shop_result)){
                            ?>
                                <div class="radios"><input id="radio-btn" type="radio" name="shop" value="<?php echo $shop_row['SHOP_ID']?>"><span><?php echo $shop_row['SHOP_NAME']?></span></div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </form>
                <div class="top-right">
                    <svg class="fresco-logo" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 136.2 136.2"><defs><style>.cls-1{fill:#0c4259;}.cls-2,.cls-4{fill:none;stroke:#6bc17c;stroke-miterlimit:10;}.cls-3{fill:#6bc17c;}.cls-4{stroke-width:0.75px;}</style></defs><title>backwithst</title><circle class="cls-1" cx="68.1" cy="68.1" r="68.1"/><path class="cls-2" d="M482.79,475.59h-6.66v4.92h6.21v.37h-6.21V486h-.38V475.22h7Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M488.88,478.46v.37a3.44,3.44,0,0,0-3.36,2.79V486h-.37v-7.42h.34v2.27A3.61,3.61,0,0,1,488.88,478.46Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M493.82,478.46a3.3,3.3,0,0,1,3.3,4.07h-6.54c.06,2.35,1.82,3.31,3.7,3.31a5,5,0,0,0,2.4-.59v.37a5.08,5.08,0,0,1-2.44.56c-2.1,0-4-1.14-4-3.86A3.62,3.62,0,0,1,493.82,478.46Zm0,.34a3.22,3.22,0,0,0-3.25,3.4h6.22A2.91,2.91,0,0,0,493.83,478.8Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M502.21,478.46a5.26,5.26,0,0,1,2.51.63v.37a5.09,5.09,0,0,0-2.5-.66c-1.09,0-2.22.43-2.22,1.53,0,2.44,5.14,1.22,5.14,3.95,0,1.36-1.33,1.9-2.76,1.9a5.61,5.61,0,0,1-2.83-.74v-.37a5.5,5.5,0,0,0,2.81.77c1.28,0,2.41-.46,2.41-1.54,0-2.41-5.16-1.19-5.16-4C499.61,479,501,478.46,502.21,478.46Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M511.44,478.46a3.94,3.94,0,0,1,2.17.6v.36a3.92,3.92,0,0,0-2.14-.62,3.41,3.41,0,0,0-3.64,3.58,3.28,3.28,0,0,0,3.46,3.46,4.87,4.87,0,0,0,2.39-.6v.37a5,5,0,0,1-2.42.57,3.6,3.6,0,0,1-3.8-3.8A3.74,3.74,0,0,1,511.44,478.46Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M519.6,478.46a3.86,3.86,0,1,1-3.81,3.86A3.69,3.69,0,0,1,519.6,478.46Zm0,.35a3.51,3.51,0,1,0,3.44,3.51A3.33,3.33,0,0,0,519.6,478.81Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M563.19,499.47a64,64,0,0,0-.8-9.65,61.52,61.52,0,0,0-2.32-9.59,63.59,63.59,0,0,0-124,19.71c0,1,0,1.91.07,2.86a62.8,62.8,0,0,0,1.13,9.48,62.92,62.92,0,0,0,6,17.15,60.93,60.93,0,0,0,4.36,7.13c.86,1.22,1.77,2.42,2.72,3.58a63.32,63.32,0,0,0,7.79,8q1.71,1.47,3.51,2.82a63.52,63.52,0,0,0,7,4.53,62.11,62.11,0,0,0,8.13,3.81,61.43,61.43,0,0,0,8.87,2.68,63.71,63.71,0,0,0,9.44,1.38c1.49.11,3,.16,4.5.16,1.05,0,2.09,0,3.12-.08a64.5,64.5,0,0,0,9.8-1.23A63.78,63.78,0,0,0,539,549.84a63.5,63.5,0,0,0,9.16-8.87,62.47,62.47,0,0,0,7.11-10.3h0a63.27,63.27,0,0,0,5-11.7,63.66,63.66,0,0,0,2.89-19Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M547.5,505.2a47.67,47.67,0,0,1-4.19,15h0a48.4,48.4,0,0,1-22.75,23.09A47.21,47.21,0,0,1,510,547a48.17,48.17,0,1,1,35-63.14,47.08,47.08,0,0,1,2.4,10.15,48.75,48.75,0,0,1,.36,5.95A50.59,50.59,0,0,1,547.5,505.2Z" transform="translate(-431.37 -431.74)"/><circle class="cls-3" cx="124.19" cy="68.1" r="1.73"/><circle class="cls-3" cx="12.08" cy="68.1" r="1.73"/><path class="cls-2" d="M457.55,459.39a2.69,2.69,0,0,1,1-.67l.11.11a2.6,2.6,0,0,0-1,.65c-.41.43-.63,1-.18,1.45,1,.92,2.4-1.36,3.49-.31.53.52.27,1.2-.24,1.72a3.07,3.07,0,0,1-1.25.79l-.11-.11a2.89,2.89,0,0,0,1.24-.77c.48-.49.72-1.07.26-1.51-1-1-2.44,1.31-3.5.3A1.14,1.14,0,0,1,457.55,459.39Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M470.27,454.4l-.12.09L469,452.8l-2.51,1.73,1.16,1.69-.12.09-2.4-3.48.13-.08,1.15,1.66,2.51-1.73L467.75,451l.13-.09Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M477.45,445.9a2.17,2.17,0,1,1-1.19,2.82A2.1,2.1,0,0,1,477.45,445.9Zm.05.13a2,2,0,1,0,2.64,1.11A2,2,0,0,0,477.5,446Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M491,443.54c.18,1-.58,1.44-1.5,1.6l-1.14.21.28,1.58-.15,0-.74-4.15,1.28-.23C490,442.4,490.85,442.54,491,443.54Zm-1.93-.83-1.15.21.41,2.29,1.15-.21c.85-.15,1.53-.53,1.37-1.43S490,442.56,489.1,442.71Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M510.92,442.9l-2.56-.44-.32,1.89,2.38.41,0,.14-2.39-.41-.34,2-.15,0,.72-4.15,2.7.47Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M519.07,445l1.48.57a1.3,1.3,0,0,1,.94,1.68,1.25,1.25,0,0,1-1.7.64l.87,2.24-.18-.07-.85-2.22-1.3-.5-.64,1.65-.14-.06Zm.65,2.72a1.15,1.15,0,0,0,1.63-.53c.29-.75-.27-1.26-.85-1.48l-1.34-.52-.78,2Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M531.9,451.66l-2.19-1.39-1,1.58,2,1.3-.08.12-2-1.3-1,1.61,2.23,1.42-.07.12-2.36-1.5,2.26-3.56,2.32,1.48Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M539.58,457.59a2.69,2.69,0,0,1,.67,1l-.1.11a2.67,2.67,0,0,0-.66-1c-.43-.41-1-.62-1.45-.17-.92,1,1.37,2.39.33,3.49-.51.54-1.19.28-1.72-.23a3.07,3.07,0,0,1-.8-1.24l.11-.11a3,3,0,0,0,.78,1.24c.49.47,1.07.71,1.51.24,1-1-1.33-2.43-.32-3.49C538.42,456.91,539.1,457.14,539.58,457.59Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M544.67,470.26l-.09-.12,1.68-1.18-1.76-2.5-1.67,1.18-.09-.12,3.45-2.43.09.13-1.66,1.16,1.76,2.5,1.65-1.17.09.13Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M460.73,537.34a2.54,2.54,0,0,1,.62,1l-.11.1a2.46,2.46,0,0,0-.61-1c-.42-.42-1-.66-1.44-.23-1,.93,1.28,2.44.19,3.5-.53.52-1.2.23-1.71-.3a3.1,3.1,0,0,1-.75-1.27l.11-.1a3,3,0,0,0,.74,1.26c.47.49,1,.76,1.5.31,1-1-1.24-2.49-.19-3.51C459.59,536.61,460.27,536.87,460.73,537.34Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M468,548.79l-.13-.08L469,547l-2.51-1.72L465.31,547l-.12-.08,2.38-3.47.12.08-1.14,1.67,2.51,1.72,1.15-1.66.12.08Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M479.13,549.78A2.18,2.18,0,1,1,476.3,551,2.12,2.12,0,0,1,479.13,549.78Zm-.05.14a2,2,0,1,0,1.11,2.64A2,2,0,0,0,479.08,549.92Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M491.36,554.56c-.18,1-1.05,1.14-2,1l-1.14-.21-.28,1.58-.15,0,.75-4.15,1.29.23C490.78,553.13,491.54,553.56,491.36,554.56Zm-1.52-1.46-1.15-.2-.41,2.29,1.14.21c.85.15,1.63,0,1.79-.87S490.69,553.26,489.84,553.1Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M508.4,557.21l2.54-.43,0,.14-2.69.46-.72-4.15.15,0Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M518.9,550.16a2.17,2.17,0,1,1-1.25,2.8A2.1,2.1,0,0,1,518.9,550.16Zm.05.13a2,2,0,1,0,2.62,1.16A2,2,0,0,0,519,550.29Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M529.29,544.76a2.38,2.38,0,0,1,1.15-.4l.08.13a2.43,2.43,0,0,0-1.14.39,2,2,0,0,0-.56,2.85,1.92,1.92,0,0,0,2.79.53,2.27,2.27,0,0,0,.84-.91l.09.13a2.52,2.52,0,0,1-.87.92,2.07,2.07,0,0,1-3-.59A2.13,2.13,0,0,1,529.29,544.76Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M537.34,538.31l.12-.12,4.34,1.64-.12.12-1.33-.51-1.8,1.78.48,1.34-.11.11Zm2.87,1.07-2.61-1-.1,0a.3.3,0,0,1,0,.1l1,2.62Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M547.05,533.12l1.44-2.13.12.08-1.53,2.26L543.59,531l.08-.13Z" transform="translate(-431.37 -431.74)"/><path class="cls-4" d="M499.61,548.11s-1.52-38.34,10.52-47.35" transform="translate(-431.37 -431.74)"/><path class="cls-4" d="M499.61,548.11s1.07-34.88-11.81-45" transform="translate(-431.37 -431.74)"/><path class="cls-4" d="M499.61,546.82s-1.55-26.36,6.82-28.88" transform="translate(-431.37 -431.74)"/><path class="cls-4" d="M499.61,548.11s1-33-9.81-31" transform="translate(-431.37 -431.74)"/><path class="cls-4" d="M492.46,508.68s1.92-9.84-11-9.9C481.47,498.78,484.26,510.29,492.46,508.68Z" transform="translate(-431.37 -431.74)"/><path class="cls-4" d="M505.08,507.66s8.68.86,12.65-12.19C517.73,495.47,503,497.89,505.08,507.66Z" transform="translate(-431.37 -431.74)"/><path class="cls-4" d="M499.61,548.11s-1.45-26.37,7.2-18" transform="translate(-431.37 -431.74)"/><path class="cls-4" d="M503.61,528.47s-1.1,3.67,5.72,3.69C509.33,532.16,507.35,524,503.61,528.47Z" transform="translate(-431.37 -431.74)"/><path class="cls-4" d="M504.14,519.31s-1.17-6.22,9.07-2.92C513.21,516.39,508,523.06,504.14,519.31Z" transform="translate(-431.37 -431.74)"/><path class="cls-4" d="M492.86,517.66s-2.78-6.29-10.7-.78C482.16,516.88,487.65,521.89,492.86,517.66Z" transform="translate(-431.37 -431.74)"/></svg>
                </div>
            </div>

            <?php
            if(isset($_POST['search-btn'])){
                if(isset($_POST['shop']) && isset($_POST['search-btn']) && empty($_POST['search-product'])){
                    echo "<script>alert('Please search a product first')</script>";
                }
                if(!isset($_POST['shop']) && isset($_POST['search-btn'])){
                    echo "<script>alert('Please select a shop first')</script>";
                }
                if(isset($_POST['shop']) && isset($_POST['search-btn']) && !empty($_POST['search-product'])){
                    $search_product = ucwords($_POST['search-product']);
                    $shop_id = $_POST['shop'];
                    $product_query = "SELECT * FROM PRODUCT WHERE FK1_SHOP_ID = '$shop_id' AND PRODUCT_NAME LIKE '%$search_product%'";
                    $product_result = oci_parse($connection, $product_query);
                    oci_execute($product_result);
            ?>
            <?php
                        while($row_product = oci_fetch_assoc($product_result)){
                    
                            $product_id = $row_product['PRODUCT_ID'];
                            $review_query = "SELECT * FROM REVIEW INNER JOIN USERS ON REVIEW.FK2_USER_ID = USERS.USER_ID WHERE FK1_PRODUCT_ID = '$product_id'";
                            $review_result = oci_parse($connection, $review_query);
                            oci_execute($review_result);
                            echo "<div class='bottom-section'>
                                <!-- -------------------------left section---------------------- -->
                                <div class='left-section'>
                                <div class='product-img'>
                                <img src='images/$row_product[PRODUCT_IMG]'>
                                </div>
                                <div class='product-info'>
                                    <h2>$row_product[PRODUCT_NAME]</h2>
                                    <p>Product ID: $row_product[PRODUCT_ID]</p>
                                    <p>$row_product[PRODUCT_DESC]</p>
                                </div>";
                    ?>
                </div>
                <!-- ------------------------------------------------------------ -->

                <!-- -------------------------right section---------------------- -->
                <div class="right-section">
                    <?php  
                        while($row = oci_fetch_assoc($review_result)){
                            echo "<div class='rows'>
                                <h3>$row[USER_NAME]</h3>
                                <p class='customer-id'>User ID: $row[USER_ID]</p>
                                <p>$row[REVIEW_COMMENT]</p>
                                <p>$row[REVIEW_DATE]</p>
                                </div>";
                        }
                    ?>
                </div>
                <!-- ------------------------------------------------------------ -->
                <?php
                    }
                ?>
            </div>
            <?php
                    // }   if($num == 1)
                }
            }
            ?>
        </section>
    
</body>
</html>
