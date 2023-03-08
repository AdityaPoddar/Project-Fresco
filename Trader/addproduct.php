<?php
    session_start();
  include 'connection.php';
  $traderid=$_SESSION['id'];
  $shopid=$_GET['id'];
  //echo $shopid;
?>

<?php
//include 'connection.php';
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";



if(isset($_POST["submit"])){
    $trader_id_fk = $_POST['user_id_fk'];
    $shop_id_fk=$_POST['shop_id_fk'];
    echo $shop_id_fk;
$query="INSERT INTO PRODUCT(PRODUCT_NAME,PRODUCT_PRICE,PRODUCT_STOCK,PRODUCT_DESC,FK1_SHOP_ID,FK2_USER_ID,PRODUCT_CATEGORY,PRODUCT_SUB_CATEGORY,STATUS)
        VALUES(
            '".$_POST['fullname']."',
            '".$_POST['price']."',
            '".$_POST['stock']."',
            '".$_POST['description']."',
            '$shop_id_fk',
            '$trader_id_fk',  
            '".$_POST['product_cat']."',
            '".$_POST['product_subcat']."',
               1)";
    

            
          //  echo $query;
          $res=oci_parse($connection,$query);
                oci_execute($res);
           echo"<br><br>";
          // echo "<i>CLICK THE BELOW LINK TO LOGIN INTO YOUR DETAIL</i>";
            //echo"<br><br>";
            header("location: traderproduct.php");
            }
              else
              {
                //echo"not entering";
              }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="styles/addtrader.css">
    <link rel="stylesheet" href="styles/tmnav.css">
    <link rel="stylesheet" href="styles/dashboard.css">
    <link rel="stylesheet" type="text/css" href="styles/addproduct.css">
    <script src="javascript/dashboard.js" async></script>
    <title>Add Product</title>
    <style>

        .error
        {
            color:white;
            margin-left:70px;
        }
        @media screen and (max-width: 720px)
        {
            .addtrader h1
            {
                font-size:30px;
            }
            #add input
            {
                margin-left:25px;
                
            }
            #add input[type=submit]
            {
                margin-left:100px;
            }

        }
    </style>
</head>
<body>
    <!-- -----------------------------------------navbar---------------------------------------------------- -->
    <section class="horizontal-nav">
        <div class="topnav">
            <div class="menu" id="menu" onclick="toogle()">
                <div class="hamburger"></div>
                <div class="hamburger"></div>
                <div class="hamburger"></div>
            </div>
            <div class="type-logo">
                <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 330 57.02"><title>typo</title><path d="M377.2,484.77H348.28v12.64h24.14v12.23H348.28v17.9H335V472.46h42.2Z" transform="translate(-335 -471.49)"/><path d="M433.8,493.12c0,7.93-3.89,14.66-9.8,17.81l11.34,16.61H418.82l-8.26-13.69h-9.72v13.69H387.56V472.46H414.2C425.38,472.46,433.8,481.13,433.8,493.12Zm-33-8.35v16.77h11.42a8.39,8.39,0,0,0,.08-16.77Z" transform="translate(-335 -471.49)"/><path d="M487,472.46v12.31H458.09v9.48h24.13v11.5H458.09v9.48H487v12.31H444.81V472.46Z" transform="translate(-335 -471.49)"/><path d="M540.45,489.88h-13.2c0-2.76-3.24-6.48-8.91-6.48-4,0-8.83,1.78-8.83,4.94,0,2.67,3.65,3.72,11.42,5.75,8.67,2.27,20.9,5.18,20.9,17.33,0,10.53-9.24,17.09-22.11,17.09-17.25,0-24.46-11.66-24.46-20.25h13.2s1.05,8.75,12,8.75c5.91,0,8.09-2.51,8.09-4.86,0-3.48-4.61-4.7-9.71-5.91-8.27-1.95-22.76-5-22.76-17.25,0-10.05,9.88-17.5,22.43-17.5C532.84,471.49,540.45,481.29,540.45,489.88Z" transform="translate(-335 -471.49)"/><path d="M604.43,514.17a29.54,29.54,0,0,1-25.76,14.34c-17.25,0-29.8-12.64-29.8-28.91,0-15.31,12.55-28.11,29.8-28.11,11.74,0,21,5.51,25.92,13.77l-11.26,6.56c-2.59-5-7.7-8.34-14.66-8.34-9.64,0-16.36,7-16.36,16.12A16.23,16.23,0,0,0,578.67,516a16,16,0,0,0,14.5-8.35Z" transform="translate(-335 -471.49)"/><path d="M665,500a28.43,28.43,0,1,1-28.43-28.51A28.54,28.54,0,0,1,665,500Zm-44.71,0a16.2,16.2,0,1,0,16.28-16.12A16.21,16.21,0,0,0,620.29,500Z" transform="translate(-335 -471.49)"/></svg>
            </div>
        </div>
    </section>

    <section class="dashside-container">
        <section class="sidebar" id="sidebar">
        <div class="profile-image">
                <img src="images/caviar.jpg" alt="">
            </div>
            <h3><?php echo $_SESSION['name'];?></h3>
            

        <div class="nav">
        <a href="dashboard.php">Dashboard</a>
                <a href="traderorder.php">Order</a>
                <a href="traderreport.php">Report</a>
                <a href="traderproduct.php">Products</a>
                <a href="traderreview.php">Reviews</a>
                <a href="traderaccount.php">Manage Account</a>
                <a href="tradershop.php">Manage shop</a>
                <a href="logout.php">Logout</a>
                
                
            </div>
        </section>
    <!-- -----------------------------------------navbar---------------------------------------------------- -->

        <!-- -----------------------------------------main content---------------------------------------------------- -->

        <section class="dashboard">
            <div class="addtrader">
                <h1>Add a Product</h1>
                
             <div class="form" id="add">
                
                    <!-- <form action="productvalidation.php" method="POST" enctype="multipart/form-data"> -->
                    <form action="addproduct.php" method="POST" enctype="multipart/form-data">
                            <input type="file" name="file" >
                            <input type="text" name="fullname"  placeholder="Product Name" required>
                            <span class="error">  <?php if(isset($error_name)){?>
                                                            <?php echo $error_name;?>
                                                        <?php }?></span>
                            <input type="integer" name="price"  placeholder="Price" required>
                            <span class="error">  <?php if(isset($error_price)){?>
                                                            <?php echo $error_price;?>
                                                        <?php }?></span>

                            <input type="text" name="stock"  placeholder="Stock">
                            <span class="error"> <?php if(isset($error_stock)){?>
                                                            <?php echo $error_stock;?>
                                                        <?php }?></span>

                            <input type="textbox" name="description"  placeholder="Description" required>
                            <span class="error">  <?php if(isset($error_desc)){?>
                                                            <?php echo $error_desc;?>
                                                        <?php }?></span>

                            <input type="text" name="product_cat"  placeholder="Product Category">
                            <span class="error"> <?php if(isset($error_productcat)){?>
                                                            <?php echo $error_productcat;?>
                                                        <?php }?></span>

                            <input type="text" name="product_subcat"  placeholder="Product Sub Category">
                            <span class="error"> <?php if(isset($error_productsubcat)){?>
                                                            <?php echo $error_productsubcat;?>
                                                        <?php }?></span>

                            <input type="hidden" name="user_id_fk" value="<?php echo $traderid?>">

                            <input type="hidden" name="shop_id_fk" value="<?php echo $shopid?>"> 

                            <button type= "submit" id="confirm" name="submit"  value="Confirm" class="btn">Confirm</button>
                            
                            <<!-- ?php echo $traderid?>
                            <?php echo $shopid?> -->

                    </form>
            </div>
        </div>
        </section>
        <!-- -----------------------------------------main content---------------------------------------------------- -->
    </section>
</body>
</html>