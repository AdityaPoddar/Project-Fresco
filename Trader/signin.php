<?php

    if(isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

       
        if(empty($password))
        {
            $error_pass = "Please enter your password";
        }
        else if (strlen($password)<6)
        {
            $error_pass = "Password length needs to have minimum length of 6";
        }

        if(empty($error_pass))
        {
            include 'connection.php';

            $result = oci_parse($connection,"SELECT * FROM USERS WHERE USER_NAME = '$username'");
			$execute = oci_execute($result);

			if($execute)
			{
				$row = oci_fetch_row($result);


				
					if($row['2']==$username)
					{
						
						if(password_verify($password, $row['8']))
						{
							session_start();
							$_SESSION['logged']= true;
							$_SESSION['name']= $row['2'];
							$_SESSION['id']= $row['0'];
							$_SESSION['role']=$row['3'];
							$_SESSION['email']=$row['4'];
							

							header("location:dashboard.php");
							
						}
						else
						{
							$fail ="Invalid Password";
						}
						
					}
					else{
						$fail ="Invalid Credentials";
					}
				
				
			}
            

        }
    }
    
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Sign In</title>
	<link rel="stylesheet" href="styles/signin.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
</head>
<body>
	



	<div class="container-small">
		<div class="row">
		<div class="col-2">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method ="POST" class="sign-up-form">
		        
			<?php if(!empty($fail)) { ?>
					<span class= "bg-danger"> <?php echo "$fail <br>"; ?></span>
				<?php } ?>

				<h2 class="title">Sign in Fresco</h2>
		        <div class="input-field">
			        <i class="fas fa-envelope"></i>
			        <input type="text" name="username" placeholder="Username" value="<?php if(isset($_POST['username'])) { echo htmlentities ($_POST['username']); }?>" required />
		        </div>

		        <div class="input-field">
		            <i class="fas fa-lock"></i>
		            <input type="password" name="password" placeholder="Password" value="<?php if(isset($_POST['password'])) { echo htmlentities ($_POST['password']); }?>" required />
		        </div>

				<?php if(isset($error_pass)) { ?>
		            <span class="invalid-feedback"><?php echo "$error_pass"; ?></span>
		        <?php } ?>


		        <a href="#">Forgot your password?</a>
		        <input type="submit" name="submit" value="Submit">
		    </form>
		</div>
		<div class="col-2 background">
		    <div class="overlay">
		        <div class="overlay-panel overlay-right">
		            <h2 class="title">Login to Fresco!</h2>
		            <p>Shopping with us for the first time?</p>
		            <p>Enter your personal details and start journey with us</p>
		            <button class="ghost" id="signUp"><a href="signup.php">Sign Up</a></button>
		        </div>
		    </div>
		</div>
		</div>
	</div>

	

</body>
</html>