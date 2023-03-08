<?php 
   $conn = oci_connect('raman', 'raman', '//localhost/xe'); 
   
   if (!$conn) {
      $m = oci_error();
      echo $m['message'], "\n";
      exit;
   }
   ?>