<?php
error_reporting(0);
      if(isset($_POST['submit']))
      {
         $count=0;
         if(empty($_POST['username']))
         {
             $usernameError = "Please enter username";
             echo "<script> 
                    alert('$usernameError');
                    window.location.href = 'login.php';
                </script>";
             $count++;
         }
         elseif(!ctype_alpha(str_replace(' ', '', $_POST['username'])))
         {
             $usernameError = "Invalid username [A-Z and space only]";
             echo "<script> 
                    alert('$usernameError');
                    window.location.href = 'login.php';
                </script>";
             $count++;
         }
     
         if(empty($_POST['password']))
         {
             $passwordError = "Please enter password";
             echo "<script> 
                    alert('$passwordError');
                    window.location.href = 'login.php';
                </script>";
             $count++;
         }
         elseif(strlen($_POST['password'])<=4)
         {
             $passwordError = "Password length less than 6";
             echo "<script> 
                    alert('$passwordError');
                    window.location.href = 'login.php';
                </script>";
             $count++;
         }
         
         if($count==0)
         {
            include 'connection.php';

            $username=$_POST['username'];
            $password=$_POST['password'];
            $result=oci_parse($connection,"SELECT * FROM ADMIN_USER WHERE USERNAME='$username'");
           $exe=oci_execute($result);
            
            if($exe)
            {
               $number=oci_fetch_row($result);


               if($number['1']==$username)
               {
                  
                     if($number['2']==$password)
                     {
                        $login=true;
                        session_start();
                        $_SESSION['logged']=true;
                        $_SESSION['id']=$row['0'];
                        $_SESSION['name']=$username;
                        $_SESSION['desc']="Administrative";

                         header("location:http://localhost:8080/apex/f?p=101:LOGIN_DESKTOP:13511941337351:::::");

                     }
                      else
                      $error_msg="Invalid Password";
                  
               }
               else
               $error_msg="Invalid Credentials";
            }
         }
      }
?>
<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Login Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="styles/login.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
         <style>
            
            {
               background-color:black;
            }
            </style>
  
   </head>
   <body class="bg-dark">


      <div class="container-small">
         <div class="row">
            <div class="col-2">
               <form method="POST" action="">
               
                  <h2 class="title">Sign in Fresco</h2>
                     <?php if(isset($error_msg)){?>
   						<?php echo $error_msg;?>
   					   <?php }?>
                  <div class="input-field">
                     <!-- <label>Username</label> -->
                     <i class="fas fa-envelope"></i>
                        
                     <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $_POST['username']?>" >
                     <?php if(isset($usernameError)){?>
						   <?php echo $usernameError;?>
					      <?php }?>
                  </div>
                  <div class="input-field">
                     <!-- <label>Password</label> -->
                     <i class="fas fa-lock"></i>
                     <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo $_POST['password']?>" >
                     <?php if(isset($passwordError)){?>
					      <?php echo $passwordError;?>
                     <?php }?>
   
                  </div>
                  <button type="submit" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>

               </form>
            </div>   
               
            <div class="col-2 background">
                <div class="overlay">
                    <div class="overlay-panel overlay-right">
                        <h2 class="title">Welcome to Fresco!</h2>
                        <p>Management Sign In Interface</p>
                        <p>Enter your Username And Password for login</p>
                    </div>
                </div>
            </div>
            
         </div>   
      </div>

   </body>
</html>