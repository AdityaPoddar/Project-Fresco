<?php
    include 'connect.php';
    include 'header.php';

    if(!isset($_SESSION['otp']))
    {
        // header('location: login.php');
    }

    $otp = $_SESSION['otp'];


    if(isset($_POST['verify']))
    {
            $give = $_POST['otp'];

            if($give==$otp)
            {
                // header('location: Homepage.php');
            }
            else 
            {
                echo "<script> 
                        alert('OTP Doesn't match);
                        window.location.href = 'verifyEmail.php';
                    </script>";
            }
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
    <link rel="stylesheet" href="styles/verifyEmail.css">
    <title>Login</title>
</head>
<body>
    <div class="main-container">
        <div class="hold">
            <h1>OTP</h1>
            <form action="verifyEmail.php" method="POST">
                <div class="inside">
                    <input type="tel" name="otp" id="" placeholder="OTP"  pattern="[0-9]{4}" required />
                    </div>
                   
                   <div class="btn">
                           <input type="submit" name="verify" value="Verify"  >
                   </div>
            </form>
        </div>
    </div>
   
</body>
</html>
