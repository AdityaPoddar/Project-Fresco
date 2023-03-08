<?php 
		
        include 'connection.php';
		$product_name=$_POST['fullname'];
        if(empty($_POST['fullname']))
		{
			$error_name = "Please enter product name";
			
		}
		if(empty($_POST['price']))
		{
			$error_price = "Please enter description";
			
		}
		if(empty($_POST['description']))
		{
			$error_desc = "Please enter location";
			
		}
        

		  if(!isset($error_name) && !isset($error_price) && !isset($error_desc) 
		   && $_POST['Submit'] == 'Submit'){
			
			include 'registerproduct.php';
			
		   }

		  


		   include 'addproduct.php';

?>