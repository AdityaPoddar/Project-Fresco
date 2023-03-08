<?php
	include 'connection.php';

	$error = NULL;

	if(isset($_POST['submit']))
	{
		$name= $_POST['name'];
		$email= $_POST['email'];
		$contact=$_POST['contact'];
		$shop=$_POST['shop'];
		$description= $_POST['description'];
		$type= $_POST['type'];
		$paypalemail= $_POST['paypalemail'];

		$result = oci_parse($connection," SELECT * FROM USERS WHERE USER_EMAIL = '$email'");
		$server = oci_execute($result);

		if($server)
		{
			oci_fetch_row($result);
			$num = oci_num_rows($result);

			if($num==0)
			{

				$run = oci_parse($connection," SELECT * FROM SHOP WHERE SHOP_NAME = '$shop'");
				$work = oci_execute($run);

				if($work)
				{
					oci_fetch_row($run);
					$num = oci_num_rows($run);

					if($num==0)
					{


						$insert= oci_parse($conn,"INSERT INTO REQUEST(REQ_NAME, REQ_EMAIL, REQ_CONTACT, REQ_SHOP, REQ_DES, REQ_TYPE) 
						VALUES ('$name','$email',$contact,'$shop','$description','$type')");

						$execute = oci_execute($insert);
						if($execute)
						{
							header("Location:traderRegister.php");
						}
						else
						{
							$conn->error;
						}
					}
					else
					{
						 echo "<script> 
                alert('Shop Already Registered.');
                window.location.href = 'signup.php';
            </script>";
					}
				}
			}
			else
			{
				
						 echo "<script> 
                alert('Email Already Registered.');
                window.location.href = 'signup.php';
            </script>";
			}
		}

		
	}
	

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Sign Up</title>
	<link rel="stylesheet" href="styles/signup.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
</head>
<body>


	<div class="container-small">
		<div class="row">
			
			<div class="col-2">
			    <form action="signup.php" method="POST" class="sign-up-form">
		            <h2 class="title">Sign up</h2>
		            <div class="input-field">
		              <i class="fas fa-user"></i>
		              <input type="text" name="name" placeholder="Full Name" value="<?php if(isset($_POST['name'])) { echo htmlentities ($_POST['name']); }?>" required/>
		            </div>

		            <div class="input-field">
		              <i class="fas fa-envelope"></i>
		              <input type="email" name="email" placeholder="Email" value="<?php if(isset($_POST['email'])) { echo htmlentities ($_POST['email']); }?>" required/>
		            </div>

		            <div class="input-field">
						<i class="fas fa-phone"></i>
		              <input type="text" name="contact" placeholder="Contact" value="<?php if(isset($_POST['contact'])) { echo htmlentities ($_POST['contact']); }?>" required/>
		            </div>

					<div class="input-field">
						<i class="fas fa-store-alt"></i>
						<input type="text" name="shop" placeholder="Shop Name"  value="<?php if(isset($_POST['shop'])) { echo htmlentities ($_POST['shop']); }?>"  required/>
					  </div>

					<div class="input-field">
					<i class="fas fa-pen"></i>  
					<input type="text" name="description" id="" cols="30" rows="10" placeholder="Description" required>
						<?php if(isset($_POST['description'])) { echo htmlentities ($_POST['description']); }?>
					</input>
					</div>  

					<div class="input-field">
					<i class="fas fa-clipboard-user"></i>
						<select  name="type" required>
							<option value="" selected hidden disable>Trader Type (Dropdown)</option>
							<option value="butchers" <?php if(isset($_POST['type'])) { if(!strcmp($_POST['type'],'butchers')){ echo "selected";} }?>>Butchers</option>
							<option value="greengrocer"  <?php if(isset($_POST['type'])) { if(!strcmp($_POST['type'],'greengrocer')){ echo "selected";} }?>>Greengrocer</option>
							<option value="fishmonger" <?php if(isset($_POST['type'])) { if(!strcmp($_POST['type'],'fishmonger')){ echo "selected";} }?>>Fishmonger</option>
							<option value="bakery" <?php if(isset($_POST['type'])) { if(!strcmp($_POST['type'],'bakery')){ echo "selected";} }?>>Bakery</option>
							<option value="delicatessen" <?php if(isset($_POST['type'])) { if(!strcmp($_POST['type'],'delicatessen')){ echo "selected";} }?>>Delicatessen</option>
						  </select>
					  </div>

					  <div class="input-field">
		              <i class="fas fa-envelope"></i>
		              <input type="email" name="paypalemail" placeholder="PayPal Email" value="<?php if(isset($_POST['paypalemail'])) { echo htmlentities ($_POST['paypalemail']); }?>" required/>
		            </div>

		            <input type="submit" name="submit" class="btns" value="Submit">
		        </form>
			</div>

			<div class="col-2 background">
			    <div class="overlay">
			        <div class="overlay-panel overlay-left">
		                <h2 class="title">Welcome to Fresco!</h2>
		                <p>Already Have a account?</p>
		                <button class="ghost" id="signIn"><a href="signin.php">Sign In</a></button>
		            </div>
			    </div>
			</div>
		</div>
	</div>




</body>
</html>