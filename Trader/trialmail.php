<?php
$email="adityapoddar.2011@gmail.com";
$to= $email;
                $subject = "OTP VERIFICATION";
                $message = "Hello ,\r\n\r\nPlease follow up on your OTP code.";
                $message .= "\r\n\r\n\r\nOTP: ";
                $header = "Form: frescomart05@gmail.com"; 
                $mail = mail($to, $subject, $message, $header);
                if($mail==true)
                {
                    echo "mail sent";
                }
                else
                {
                    echo" mail not sent";
                }

             
				?>