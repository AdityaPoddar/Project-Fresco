<?php
            session_start();
            include 'connection.php';
            $traderid=$_SESSION['id'];
            //echo $traderid;
            //$shopid=$_GET['SHOP_ID'];
            $query_user="SELECT SHOP_ID FROM SHOP WHERE FK1_USER_ID='$traderid'";
            //echo $query_user;
            $result_shop=oci_parse($connection,$query_user);
            oci_execute($result_shop);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="styles/manageacc.css">
    <link rel="stylesheet" href="styles/tmnav.css">
    <link rel="stylesheet" type="text/css" href="styles/traderproduct.css">
    <script src="javascript/dashboard.js" async></script>
    <script src="javascript/disable1.js" async></script>
    <title>Product</title>
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
                <a href="tradershop.php">Manage Shop</a>
                <a href="logout.php">Logout</a>
            

                
                
            </div>
        </section>
    <!-- -----------------------------------------navbar---------------------------------------------------- -->

        <!-- -----------------------------------------main content---------------------------------------------------- -->

        <section class="dashboard">
            <div class="top-section">
                <div class="top" id="topleft">
                    <p>Products</p>
                </div>
                <div class="top" id="topright">
                    <h3>fresco</h3>
                </div>
            </div>
            <div class="bottom-section">
                
                    <div class="button">
                       
                <!-- <form action="" method="POST"> -->
                <?php            
                while ($row=oci_fetch_assoc($result_shop))  {
                $shopid=$row['SHOP_ID'];

                echo"      
                          
                            
                <input type='hidden' name='shopid' value='$shopid'>
                <a href='traderproduct.php?sid=$shopid'>
                <button name='submit' id='ordershop1'class='btn'>SHOP-$shopid</button>
                </a>";
                

                }

                if(isset($_GET['sid'])){
                $shop_id=$_GET['sid'];
                //echo $shopid;
                $query="SELECT * FROM PRODUCT WHERE FK1_SHOP_ID='$shop_id'";
                //echo $query;
                $result=oci_parse($connection,$query);
                oci_execute($result);
                }

                ?>



                <!-- </form> -->

                        </div>

                             <div class="table">
                                
                                
                             <table border="1" >
                             <tr>
                                 <th>Product Image</th>
                                 <th>Product Name</th>
                                 <th>PRICE</th>
                                 <th>STOCK</th>
                                 <th>DESCRIPTION</th>
                                 <th>ACTION</th>
                                
                                 
                                 
                             </tr>
                            
                            <?php
                            if(isset($result)){
                            while($value=oci_fetch_assoc($result))
                            {
                                
                            ?>
                                <tr>
                                
                                <td><img src="<?php echo $value['PRODUCT_IMG'];?> "width='100' height='80'/></td>
                                <td><?php echo $value['PRODUCT_NAME'];?></td>
                                <td><?php echo $value['PRODUCT_PRICE'];?></td>
                                <td><?php echo $value['PRODUCT_STOCK'];?></td>
                                <td><?php echo $value['PRODUCT_DESC'];?></td>
                                <td>
                                     <a href="productedit.php?pid=<?php echo $value['PRODUCT_ID'];?>">EDIT</a>
                                     /
                                      <a href="productdelete.php?pid=<?php echo $value['PRODUCT_ID'];?>"
                                        onclick= " return confirm('are you sure????')"
                                        >DELETE</a>
                                    </td>
                                        
                                    
                                    
                                    
                                </tr>
                        <?php
                            }
                            }
                        ?>
                     
                         </table>



                             </div>
                             
   
                <div class="bottom" id="bottom-dowm">
                    <div class="button" id="add">
                        <form action="addproduct.php?id=<?php echo $shop_id?>" method="POST">

                            <input type= "Submit"  name="Submit"  value="ADD A PRODUCT">
                            <!-- <input type="hidden" name="shop_id" value="<?php echo $shopid?>"> -->
                            <!-- <?php echo $traderid?>
                            <?php echo $shopid?> -->
                        </form>
                        </div>

                </div>
            </div>
        </section>
        <!-- -----------------------------------------main content---------------------------------------------------- -->
    </section>
</body>
</html>