<?php

 $dbhost = 'localhost';
 $dbuser = 'root';
 $dbpass = 'root';
 
 $db = 'petroapp';

 $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
 mysqli_select_db($db);
 
?>