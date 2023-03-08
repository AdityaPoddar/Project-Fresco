<?php
    include 'header.php';
    include 'connect.php';
   
    // -----if form submit method = post-------
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $page = $_POST['page'];
        // -----if add to basket button is clicked----
        if(isset($_POST['addtobasket'])){
            // ------if basket already has products in it-------
            if(isset($_SESSION['cart'])){
                $myproducts = array_column($_SESSION['cart'], 'product_name');
                // -----Item already added to the basket-----
                if(in_array($_POST['product_name'],$myproducts)){
                    // echo "<script>
                    //     // alert('Item already added to the basket');
                    //     // window.location.href= 'Homepage.php';
                    // </script>";
                }
                // ------------------new item-----------------
                else{
                    $count = count($_SESSION['cart']);
                    $_SESSION['cart'][$count] = array('product_id' => $_POST['product_id'],
                                                    'product_name' => $_POST['product_name'],
                                                    'product_img' => $_POST['product_img'],
                                                    'product_price' => $_POST['product_price'],
                                                    'min' => $_POST['min'],
                                                    'max' => $_POST['max'],
                                                    'quantity' => $_POST['min']);
                    // echo "<script>
                    //     // alert('Item added');
                    //     window.location.href= 'Homepage.php';
                    // </script>";
                }  
            }
            // -----if the basket is empty-----
            else{
                $_SESSION['cart'][0]= array('product_id' => $_POST['product_id'],
                                            'product_name' => $_POST['product_name'],
                                            'product_img' => $_POST['product_img'],
                                            'product_price' => $_POST['product_price'],
                                            'min' => $_POST['min'],
                                            'max' => $_POST['max'],
                                            'quantity' => $_POST['min']);
                // echo "<script>
                //     // alert('Item added');
                //     window.location.href= 'Homepage.php';
                // </script>";
            }
            header('location:'.$page.'');
        }
        // -----if remove button is clicked-----
        if(isset($_POST['remove-product'])){
            foreach($_SESSION['cart'] as $key => $value){
                if($value['product_name'] == $_POST['product_name']){
                    unset($_SESSION['cart'][$key]);
                    $_SESSION['cart']= array_values($_SESSION['cart']);
                    // echo "<script>
                    //     // alert('Product removed');
                    //     window.location.href='basket.php';
                    // </script>";
                    header('location:basket.php');
                }
            }
        }
        // -----if quantity is modified-----
        if(isset($_POST['mod_quantity'])){
            foreach($_SESSION['cart'] as $key => $value){
                if($value['product_name'] == $_POST['product_name']){
                    $_SESSION['cart'][$key]['quantity']=$_POST['mod_quantity'];
                    print_r($_SESSION['cart']);
                    echo "<script>
                        // alert('Product removed');
                        window.location.href='basket.php';
                    </script>";
                    header('location:basket.php');
                }
            }
        }
    }
?>