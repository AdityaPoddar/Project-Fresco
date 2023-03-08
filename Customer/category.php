<?php
    include 'header.php';
    include  'connect.php';
    $category_name = $_GET['category_name'];

    $all_subcat = "SELECT DISTINCT PRODUCT_SUB_CATEGORY FROM PRODUCT WHERE PRODUCT_CATEGORY = '$category_name'"; 
    
        $all_subcat_result = oci_parse($conn, $all_subcat);
        oci_execute($all_subcat_result);
    if(isset($_POST['filter-category']) && !isset($_POST['subCat'])){
        // header("location: category.php?category_name=" .$category_name."");
        echo "<script>alert ('Please select a subcategory first.')</script>";
        echo "<script>window.location = 'category.php?category_name=" .$category_name."'</script>";
    }
    else{
        if(!isset($_POST['filter-category'])){
        $query = "SELECT * FROM PRODUCT WHERE PRODUCT_CATEGORY = '$category_name' "; 
        }
        else{
            $subcategory_name = $_POST['subCat'];
            $query = "SELECT * FROM PRODUCT where PRODUCT_SUB_CATEGORY = '$subcategory_name' ";
        }
    }   
    $result = oci_parse($conn, $query);
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
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/category.css">

    <!-- <script src="javascript/category.js"></script> -->
    <script src="javascript/navbar.js" async></script>
    <title>Shops</title>
</head>
<body>

    <?php   
        include 'navbar.php'
    ?>

    <div class="category-section">
        <div class="sub-category-card">
            <h2>Subcategories</h2>
            <form id="subcategoryForm" action="" method="post">
                <?php
                    while($all_subcat_row = oci_fetch_assoc($all_subcat_result)){
                ?>
                <label for="subCat">
                    <input type="radio" name="subCat" class="subCat" id="subCat" value="<?php echo $all_subcat_row['PRODUCT_SUB_CATEGORY']?>"><?php echo $all_subcat_row['PRODUCT_SUB_CATEGORY']?>
                </label>
                <?php
                    }
                ?>
                
            </form>
            <button class="filter-btn" name="filter-category" type="submit" form="subcategoryForm">Filter</button>
            <button class="reset-btn" type="reset" form="subcategoryForm"><a href="">Reset</a></button>
        </div>
    </div>

    
    <div class="product-section">
        <div class="product-container">
            <h1>Products from <?php echo $category_name?> 
                <?php if(isset($_POST['filter-category'])){
                    echo '(';
                    echo $subcategory_name;
                    echo ')';
                ?>
                <?php }?>
        
            </h1>
            <?php
                while($row = oci_fetch_assoc($result)){
            ?>
            <form action="mybasket.php" id="addtobasket" method="post">
            <div class="product-card">
                <a href="products.php?product_id=<?php echo $row['PRODUCT_ID']?>&shop_name=<?php echo $row['PRODUCT_NAME']?>" onclick="pass()">
                    <img width="300px" height="250px" src="images/<?php echo $row["PRODUCT_IMG"]?>" alt="Asda">
                    <p> <?php echo $row["PRODUCT_NAME"]?></p>
                    <p>&pound; <?php echo $row["PRODUCT_PRICE"]?></p>
                </a>
                <input type="hidden" name="product_id" value="<?php echo $row['PRODUCT_ID']?>">
                <input type="hidden" name="product_name" value="<?php echo $row['PRODUCT_NAME']?>">
                <input type="hidden" name="product_img" value="<?php echo $row['PRODUCT_IMG']?>">
                <input type="hidden" name="product_price" value="<?php echo $row['PRODUCT_PRICE']?>">
                <input type="hidden" name="page" value="category.php?category_name=<?php echo $category_name?>">
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

<?php
    
?>