<?php 
        include 'connection.php';
        if(empty($_POST['shopname']))
		{
			$error_shopname = "Please enter name";
			
		}
		elseif(!ctype_alpha(str_replace(' ', '', $_POST['shopname'])))
		{
			$error_shopname = "Invalid username [A-Z and space only]";
			
		}
		if(empty($_POST['description']))
		{
			$error_desc = "Please enter description";
			
		}
		if(empty($_POST['location']))
		{
			$error_location = "Please enter location";
			
		}
        

		  if(!isset($error_shopname) && !isset($error_desc) && !isset($error_location) 
		   && $_POST['Submit'] == 'Confirm'){
			
			include 'registershop.php';
			
		   }

		  


		   include 'tradershop.php';

?>