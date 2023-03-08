<?php 
    include 'header.php';
    include 'connect.php'; 
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
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/basket.css">
    <script src="javascript/basket.js" async></script>
    <script src="javascript/navbar.js" async></script>
    <title>Document</title>
</head>
<body>
    <?php
        include 'navbar.php';
    ?>

    <div class="basket-section">
        <div class="basket-container">
            
            <div class="top-section">
                
                <div class="summary-section">
                    <div class="heading">
                        <h1>My Basket</h1>
                        <?php 
                            if(isset($_SESSION['user-id'])){
                        ?>
                            <h4><a href="order.php">View previous orders</a></h4>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="summary">
                        <span>Grand Total: &pound; </span> <span id="gtotal"></span>
                        <?php
                            $paypal_email = 'sb-kaas76626075@business.example.com';
                            $totalquantity = 0;
                            $grandtotal = 0;
                            if(isset($_SESSION['cart'])){
                            foreach($_SESSION['cart'] as $key => $value){
                                $totalquantity = $totalquantity + $_SESSION['cart'][$key]['quantity'];
                                $subtotal = $value['quantity'] * $value['product_price'];
                                $grandtotal = $grandtotal + $subtotal;
                            }
                        }
                            echo "<p>Total quantity: $totalquantity</p>";
                            if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0 && $totalquantity <= 20){
                                
                                if(!isset($_SESSION['user-id'])){
                                    // for login first
                                    echo "<form action='login.php' method='post'>
                                    <button class='proceed-to-pay'>Buy now</button>
                                    </form>";
                                }
                                else{
                                    // for enabled button
                                    echo "<form action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post'>
                                        <!-- Paypal business test account email id so that you can collect the payments. -->
                                        <input type='hidden' name='business' value='$paypal_email'>
                                        <!-- Buy Now button. -->
                                        <input type='hidden' name='cmd' value='_xclick'>
                                        <!-- Details about the item that buyers will purchase. -->
                                        <input type='hidden' name='amount' value='$grandtotal'>
                                        <input type='hidden' name='currency_code' value='GBP'>
                                        <!-- URLs -->
                                        <input type='hidden' name='cancel_return' value='http://localhost/Fresco/Homepage.php'>
                                        <input type='hidden' name='return' value='http://localhost/Fresco/slot.php?total_amount=$grandtotal'>
                                        <!-- payment button. -->
                                        <button type='submit' name='submit' class='proceed-to-pay'>Buy now</button>
                                    </form>";
                                }
                            }
                            else if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0 && $totalquantity > 20){
                                // for disabled button
                                echo "<span>Basket full</span>
                                    <form action=''><button type='submit' name='submit' class='proceed-to-pay disabled' disabled>Buy now</button></form>";
                            }
                            else{
                                echo "<span>Basket empty</span>
                                    <form action=''><button type='submit' name='submit' class='proceed-to-pay disabled' disabled>Buy now</button></form>";
                            }
                            
                        ?>
                    </div>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($_SESSION['cart'])){
                            foreach($_SESSION['cart'] as $key => $value){ 
                                // $pid = $_SESSION['cart'][0]['product_id'];
                                // echo $pid;
                                // $min_max = "SELECT MIN_ORDER, MAX_ORDER FROM PRODUCTS WHERE PRODUCT_ID = '$pid'";
                                // $result = oci_parse($conn, $min_max);
                                // oci_execute($result);
                                // $row = oci_fetch_assoc($result);
                                echo "
                                <tr>
                                    <td class='image-container eq-width-td'><div class='td-img'><img src='images/$value[product_img]'/></div></td>
                                    <td class='eq-width-td'>$value[product_name]</td>
                                    <td class='eq-width-td'>$value[product_price]<input type='hidden' class='price' value='$value[product_price]'></td>
                                    <td class='eq-width-td'>
                                        <form action='mybasket.php' method='post'>
                                            <input type='number' class='quantity' name='mod_quantity' onchange='this.form.submit()' value='$value[quantity]' min='$value[min]' max='$value[max]'>
                                            <input type='hidden' name='product_name' value='$value[product_name]'>
                                        </form>
                                    </td>
                                    <td class='eq-width-td'>&pound; <span class='total'></span></td>
                                    <td class='remove-td'>
                                        <form action='mybasket.php' method='post' class='remove-form'>
                                            <input type='hidden' name='page' value='basket.php'>
                                            <input type='hidden' name='product_name' value='$value[product_name]'>
                                            <button class='clear-btn' name='remove-product'><span class='material-icons clear'>clear</span></button>
                                        </form>
                                    </td>
                                </tr>
                                ";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>



