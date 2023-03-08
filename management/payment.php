<?php
    session_start();
     include 'sessioncheck.php';
    include 'connection.php';
   

    $query = "SELECT o.FK1_ORDER_ID,
                    o.ORDERDETAIL_ID,
                    p.PRODUCT_ID,
                    p.PRODUCT_NAME,
                    o.UNIT_PRICE,
                    o.TOTAL_PER_PRODUCT,
                    o.COMMISSION_PER_PRODUCT,
                    o.TOTAL_PER_PRODUCT - o.COMMISSION_PER_PRODUCT AS TOTAL_TO_PAY,
                    o.ORDER_DATE,
                    p.FK1_SHOP_ID
                FROM ORDER_DETAIL o
                INNER JOIN PRODUCT p
                ON o.FK2_PRODUCT_ID = p.PRODUCT_ID
                WHERE 1=1 ";

    

    if(isset($_POST['submit'])){

        if(!empty($_POST['date'])){
            $date = strtoupper($_POST['date']);
            $query = $query . "AND ORDER_DATE LIKE '%$date%' ";
        }
        if(!empty($_POST['order_id'])){
            $order_id = $_POST['order_id'];
            $query = $query . "AND FK1_ORDER_ID LIKE '%$order_id%' ";
        }
        if(!empty($_POST['shop_id'])){
            $shop_id = $_POST['shop_id'];
            $query = $query . "AND FK1_SHOP_ID LIKE '%$shop_id%' ";
            $paypal_query = "SELECT u.PAYPAL_EMAIL FROM USERS u INNER JOIN SHOP s ON u.USER_ID = s.FK1_USER_ID WHERE SHOP_ID = '$shop_id'";
            $paypal_result = oci_parse($connection, $paypal_query);
            oci_execute($paypal_result);
            $pay = oci_fetch_assoc($paypal_result);
            $paypal_email = $pay['PAYPAL_EMAIL'];
        }
    }
    $query = $query . "ORDER BY o.FK1_ORDER_ID ASC";

    $result = oci_parse($connection, $query);
    oci_execute($result);

    
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
    <link rel="stylesheet" href="styles/tmnav.css">
    <link rel="stylesheet" href="styles/payment.css">
    <title>Payment</title>
</head>
<body>
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

    <div class="dashside-container">
    <section class="sidebar" id="sidebar">
            <div class="profile-image">
                <img src="images/profile.jpg" alt="">
            </div>
            <h3><?php echo $_SESSION['name'];?></h3>

            <div class="nav">
                <a href="http://localhost:8080/apex/f?p=101:LOGIN_DESKTOP:13511941337351:::::">Dashboard</a>
                <a href="manageacc.php">Manage Account</a>
                <a href="manageorder.php">Orders</a>
                <a href="adminreport.php">Reports</a>
                <a href="manageproduct.php">Products</a>
                <a href="managereview.php">Reviews</a>
                <a href="manageshop.php">Shops</a>
                <a href="payment.php">Payments</a>
                <a href="logout.php">Logout</a>;
                
                
            
                
                
            </div>
        </section>
        <div class="main-content">
            <div class="top-section">
                <div class="top-left">
                    <h1>Payments</h1>
                    <form action="" method="POST">
                        <div class="input-fields">
                            <input type="text" name="date" class="inputs" placeholder="DD-MMM-YY">
                            <input type="number" name="order_id" class="inputs" placeholder="Order ID" min="1000">
                            <input type="number" name="shop_id" class="inputs" placeholder="Shop ID">
                        </div>
                        <div class="buttons">
                            <input type="submit" name="submit" class="btn" value="Submit">
                            <input type="reset" class="btn">
                        </div>
                    </form>
                </div>
                <div class="top-right">
                    <svg class="fresco-logo" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 136.2 136.2"><defs><style>.cls-1{fill:#0c4259;}.cls-2,.cls-4{fill:none;stroke:#6bc17c;stroke-miterlimit:10;}.cls-3{fill:#6bc17c;}.cls-4{stroke-width:0.75px;}</style></defs><title>backwithst</title><circle class="cls-1" cx="68.1" cy="68.1" r="68.1"/><path class="cls-2" d="M482.79,475.59h-6.66v4.92h6.21v.37h-6.21V486h-.38V475.22h7Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M488.88,478.46v.37a3.44,3.44,0,0,0-3.36,2.79V486h-.37v-7.42h.34v2.27A3.61,3.61,0,0,1,488.88,478.46Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M493.82,478.46a3.3,3.3,0,0,1,3.3,4.07h-6.54c.06,2.35,1.82,3.31,3.7,3.31a5,5,0,0,0,2.4-.59v.37a5.08,5.08,0,0,1-2.44.56c-2.1,0-4-1.14-4-3.86A3.62,3.62,0,0,1,493.82,478.46Zm0,.34a3.22,3.22,0,0,0-3.25,3.4h6.22A2.91,2.91,0,0,0,493.83,478.8Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M502.21,478.46a5.26,5.26,0,0,1,2.51.63v.37a5.09,5.09,0,0,0-2.5-.66c-1.09,0-2.22.43-2.22,1.53,0,2.44,5.14,1.22,5.14,3.95,0,1.36-1.33,1.9-2.76,1.9a5.61,5.61,0,0,1-2.83-.74v-.37a5.5,5.5,0,0,0,2.81.77c1.28,0,2.41-.46,2.41-1.54,0-2.41-5.16-1.19-5.16-4C499.61,479,501,478.46,502.21,478.46Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M511.44,478.46a3.94,3.94,0,0,1,2.17.6v.36a3.92,3.92,0,0,0-2.14-.62,3.41,3.41,0,0,0-3.64,3.58,3.28,3.28,0,0,0,3.46,3.46,4.87,4.87,0,0,0,2.39-.6v.37a5,5,0,0,1-2.42.57,3.6,3.6,0,0,1-3.8-3.8A3.74,3.74,0,0,1,511.44,478.46Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M519.6,478.46a3.86,3.86,0,1,1-3.81,3.86A3.69,3.69,0,0,1,519.6,478.46Zm0,.35a3.51,3.51,0,1,0,3.44,3.51A3.33,3.33,0,0,0,519.6,478.81Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M563.19,499.47a64,64,0,0,0-.8-9.65,61.52,61.52,0,0,0-2.32-9.59,63.59,63.59,0,0,0-124,19.71c0,1,0,1.91.07,2.86a62.8,62.8,0,0,0,1.13,9.48,62.92,62.92,0,0,0,6,17.15,60.93,60.93,0,0,0,4.36,7.13c.86,1.22,1.77,2.42,2.72,3.58a63.32,63.32,0,0,0,7.79,8q1.71,1.47,3.51,2.82a63.52,63.52,0,0,0,7,4.53,62.11,62.11,0,0,0,8.13,3.81,61.43,61.43,0,0,0,8.87,2.68,63.71,63.71,0,0,0,9.44,1.38c1.49.11,3,.16,4.5.16,1.05,0,2.09,0,3.12-.08a64.5,64.5,0,0,0,9.8-1.23A63.78,63.78,0,0,0,539,549.84a63.5,63.5,0,0,0,9.16-8.87,62.47,62.47,0,0,0,7.11-10.3h0a63.27,63.27,0,0,0,5-11.7,63.66,63.66,0,0,0,2.89-19Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M547.5,505.2a47.67,47.67,0,0,1-4.19,15h0a48.4,48.4,0,0,1-22.75,23.09A47.21,47.21,0,0,1,510,547a48.17,48.17,0,1,1,35-63.14,47.08,47.08,0,0,1,2.4,10.15,48.75,48.75,0,0,1,.36,5.95A50.59,50.59,0,0,1,547.5,505.2Z" transform="translate(-431.37 -431.74)"/><circle class="cls-3" cx="124.19" cy="68.1" r="1.73"/><circle class="cls-3" cx="12.08" cy="68.1" r="1.73"/><path class="cls-2" d="M457.55,459.39a2.69,2.69,0,0,1,1-.67l.11.11a2.6,2.6,0,0,0-1,.65c-.41.43-.63,1-.18,1.45,1,.92,2.4-1.36,3.49-.31.53.52.27,1.2-.24,1.72a3.07,3.07,0,0,1-1.25.79l-.11-.11a2.89,2.89,0,0,0,1.24-.77c.48-.49.72-1.07.26-1.51-1-1-2.44,1.31-3.5.3A1.14,1.14,0,0,1,457.55,459.39Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M470.27,454.4l-.12.09L469,452.8l-2.51,1.73,1.16,1.69-.12.09-2.4-3.48.13-.08,1.15,1.66,2.51-1.73L467.75,451l.13-.09Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M477.45,445.9a2.17,2.17,0,1,1-1.19,2.82A2.1,2.1,0,0,1,477.45,445.9Zm.05.13a2,2,0,1,0,2.64,1.11A2,2,0,0,0,477.5,446Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M491,443.54c.18,1-.58,1.44-1.5,1.6l-1.14.21.28,1.58-.15,0-.74-4.15,1.28-.23C490,442.4,490.85,442.54,491,443.54Zm-1.93-.83-1.15.21.41,2.29,1.15-.21c.85-.15,1.53-.53,1.37-1.43S490,442.56,489.1,442.71Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M510.92,442.9l-2.56-.44-.32,1.89,2.38.41,0,.14-2.39-.41-.34,2-.15,0,.72-4.15,2.7.47Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M519.07,445l1.48.57a1.3,1.3,0,0,1,.94,1.68,1.25,1.25,0,0,1-1.7.64l.87,2.24-.18-.07-.85-2.22-1.3-.5-.64,1.65-.14-.06Zm.65,2.72a1.15,1.15,0,0,0,1.63-.53c.29-.75-.27-1.26-.85-1.48l-1.34-.52-.78,2Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M531.9,451.66l-2.19-1.39-1,1.58,2,1.3-.08.12-2-1.3-1,1.61,2.23,1.42-.07.12-2.36-1.5,2.26-3.56,2.32,1.48Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M539.58,457.59a2.69,2.69,0,0,1,.67,1l-.1.11a2.67,2.67,0,0,0-.66-1c-.43-.41-1-.62-1.45-.17-.92,1,1.37,2.39.33,3.49-.51.54-1.19.28-1.72-.23a3.07,3.07,0,0,1-.8-1.24l.11-.11a3,3,0,0,0,.78,1.24c.49.47,1.07.71,1.51.24,1-1-1.33-2.43-.32-3.49C538.42,456.91,539.1,457.14,539.58,457.59Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M544.67,470.26l-.09-.12,1.68-1.18-1.76-2.5-1.67,1.18-.09-.12,3.45-2.43.09.13-1.66,1.16,1.76,2.5,1.65-1.17.09.13Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M460.73,537.34a2.54,2.54,0,0,1,.62,1l-.11.1a2.46,2.46,0,0,0-.61-1c-.42-.42-1-.66-1.44-.23-1,.93,1.28,2.44.19,3.5-.53.52-1.2.23-1.71-.3a3.1,3.1,0,0,1-.75-1.27l.11-.1a3,3,0,0,0,.74,1.26c.47.49,1,.76,1.5.31,1-1-1.24-2.49-.19-3.51C459.59,536.61,460.27,536.87,460.73,537.34Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M468,548.79l-.13-.08L469,547l-2.51-1.72L465.31,547l-.12-.08,2.38-3.47.12.08-1.14,1.67,2.51,1.72,1.15-1.66.12.08Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M479.13,549.78A2.18,2.18,0,1,1,476.3,551,2.12,2.12,0,0,1,479.13,549.78Zm-.05.14a2,2,0,1,0,1.11,2.64A2,2,0,0,0,479.08,549.92Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M491.36,554.56c-.18,1-1.05,1.14-2,1l-1.14-.21-.28,1.58-.15,0,.75-4.15,1.29.23C490.78,553.13,491.54,553.56,491.36,554.56Zm-1.52-1.46-1.15-.2-.41,2.29,1.14.21c.85.15,1.63,0,1.79-.87S490.69,553.26,489.84,553.1Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M508.4,557.21l2.54-.43,0,.14-2.69.46-.72-4.15.15,0Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M518.9,550.16a2.17,2.17,0,1,1-1.25,2.8A2.1,2.1,0,0,1,518.9,550.16Zm.05.13a2,2,0,1,0,2.62,1.16A2,2,0,0,0,519,550.29Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M529.29,544.76a2.38,2.38,0,0,1,1.15-.4l.08.13a2.43,2.43,0,0,0-1.14.39,2,2,0,0,0-.56,2.85,1.92,1.92,0,0,0,2.79.53,2.27,2.27,0,0,0,.84-.91l.09.13a2.52,2.52,0,0,1-.87.92,2.07,2.07,0,0,1-3-.59A2.13,2.13,0,0,1,529.29,544.76Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M537.34,538.31l.12-.12,4.34,1.64-.12.12-1.33-.51-1.8,1.78.48,1.34-.11.11Zm2.87,1.07-2.61-1-.1,0a.3.3,0,0,1,0,.1l1,2.62Z" transform="translate(-431.37 -431.74)"/><path class="cls-2" d="M547.05,533.12l1.44-2.13.12.08-1.53,2.26L543.59,531l.08-.13Z" transform="translate(-431.37 -431.74)"/><path class="cls-4" d="M499.61,548.11s-1.52-38.34,10.52-47.35" transform="translate(-431.37 -431.74)"/><path class="cls-4" d="M499.61,548.11s1.07-34.88-11.81-45" transform="translate(-431.37 -431.74)"/><path class="cls-4" d="M499.61,546.82s-1.55-26.36,6.82-28.88" transform="translate(-431.37 -431.74)"/><path class="cls-4" d="M499.61,548.11s1-33-9.81-31" transform="translate(-431.37 -431.74)"/><path class="cls-4" d="M492.46,508.68s1.92-9.84-11-9.9C481.47,498.78,484.26,510.29,492.46,508.68Z" transform="translate(-431.37 -431.74)"/><path class="cls-4" d="M505.08,507.66s8.68.86,12.65-12.19C517.73,495.47,503,497.89,505.08,507.66Z" transform="translate(-431.37 -431.74)"/><path class="cls-4" d="M499.61,548.11s-1.45-26.37,7.2-18" transform="translate(-431.37 -431.74)"/><path class="cls-4" d="M503.61,528.47s-1.1,3.67,5.72,3.69C509.33,532.16,507.35,524,503.61,528.47Z" transform="translate(-431.37 -431.74)"/><path class="cls-4" d="M504.14,519.31s-1.17-6.22,9.07-2.92C513.21,516.39,508,523.06,504.14,519.31Z" transform="translate(-431.37 -431.74)"/><path class="cls-4" d="M492.86,517.66s-2.78-6.29-10.7-.78C482.16,516.88,487.65,521.89,492.86,517.66Z" transform="translate(-431.37 -431.74)"/></svg>
                </div>
            </div>
            <div class="bottom-section">
                <table>
                    <thead>
                        <th>Order ID</th>
                        <th>Product Name</th>
                        <th>Unit Price</th>
                        <th>Total Per Product</th>
                        <th>Commission</th>
                        <th>Amount To Pay</th>
                        <th>Order Date</th>
                        <th>Shop ID</th>
                    </thead>
                    <tbody>
                        <?php
                            $total_amount_to_pay = 0;
                            while($row = oci_fetch_assoc($result)){
                        ?>
                        <tr>
                            <td><?php echo $row['FK1_ORDER_ID']?></td>
                            <td><?php echo $row['PRODUCT_NAME']?></td>
                            <td><?php echo $row['UNIT_PRICE']?></td>
                            <td><?php echo $row['TOTAL_PER_PRODUCT']?></td>
                            <td><?php echo $row['COMMISSION_PER_PRODUCT']?></td>
                            <td><?php echo $row['TOTAL_TO_PAY']?></td>
                            <td><?php echo $row['ORDER_DATE']?></td>
                            <td><?php echo $row['FK1_SHOP_ID']?></td>
                        </tr>
                        <?php
                                $total_amount_to_pay = $total_amount_to_pay + $row['TOTAL_TO_PAY'];
                            }
                        ?>
                    </tbody>
                </table>
                <div>
                    <p id="total">Total amount to pay : <?php echo $total_amount_to_pay?></p>
                    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                        <!-- Paypal business test account email id so that you can collect the payments. -->
                        <input type="hidden" name="business" value="<?php echo $paypal_email; ?>">
                        <!-- Buy Now button. -->
                        <input type="hidden" name="cmd" value="_xclick">
                        <!-- Details about the item that buyers will purchase. -->
                        <input type="hidden" name="amount" value="<?php echo $total_amount_to_pay?>">
                        <input type="hidden" name="currency_code" value="GBP">
                        <!-- URLs -->
                        <input type='hidden' name='cancel_return' value='http://localhost/Fresco/payment.php'>
                        <input type='hidden' name='return' value='http://localhost/Fresco/payment.php'>
                        <!-- payment button. -->
                        <?php
                            if(!empty($_POST['shop_id'])){
                                echo "<button type='submit' name='submit' class='btn' id='buy-btn' >Pay now</button>";
                            }
                            else{
                                echo "<button type='submit' name='submit' class='btn' id='buy-btn-disabled' disabled>Pay now</button>";
                            }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>
</html>

<?php
    // echo $query."<br><br>";
    // echo $paypal_email;
?>

<!-- https://www.sandbox.paypal.com/cgi-bin/webscr -->