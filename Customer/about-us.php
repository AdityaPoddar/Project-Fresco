<?php
    include 'connect.php';
    include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>About Us</title>
        
        <!--linking external css file-->
        <link rel="stylesheet" href="styles/aboutus.css">
        <link rel="stylesheet" href="styles/navbar.css">
        <link rel="stylesheet" href="https:fonts.googleapis.com/icon?family=Material+Icons">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet"> 
        <link rel="preconnect" href="https://fonts.gstatic.com"/>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet"/>
        <script src="javascript/navbar.js" async></script>
    </head>
    <body>
        <?php
            include 'navbar.php';
        ?>
        
        <div class="upper-grid">
            <div class="upper-section">
                <div class="filter"></div>
                <img src="images/greengrocer.jpg" alt="">
                <h1>About Fresco</h1>
            </div>
        </div>

        <div class="about-us">
            <div class="text">
                <h1>About Us</h1>
                <p>Fresco is a platform based in Cleckhuddersfax that prioritises in selling local products. The traders from this area have come together to make shopping more convenient for the customers. We strive to provide our customers the best quality products as we value customer satisfaction above anything else. Due to the busy lives of many, it is very evident that customers are switching to online shopping at a very rapid rate. We have used that fact into creating a website that further benefits the users by providing them with the healthiest, locally produced goods. In addition to this, we ensure a safe shopping and selling environment to customers and traders alike. We will keep updating and providing new and fresh products to our customers everyday as we strongly believe in shopping fresh and local.</p>
                
            </div>
        </div>

        <div class="main-grid">
            <div class="photos-grid">
                <div class="images">
                    <img src="images/bakery.jpg" alt="">
                </div>
                <div class="images">
                    <img src="images/deli.jpg" alt="">
                </div>
                <div class="images">
                    <img src="images/fishmonger.jpg" alt="">
                </div>
                <div class="images">
                    <img src="images/greengrocer.jpg" alt="">
                </div>
                <div class="images">
                    <img src="images/greengrocer(2).jpg" alt="">
                </div>
                <div class="images">
                    <img src="images/greengrocer(3).jpg" alt="">
                </div>
                <div class="images">
                    <img src="images/bakery.jpg" alt="">
                </div>
                <div class="images">
                    <img src="images/butcher.jpg" alt="">
                </div>
                <div class="images">
                    <img src="images/bakery.jpg" alt="">
                </div>
            </div>
        </div>
    </body>
</html>