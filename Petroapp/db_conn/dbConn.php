<?php

 $dbhost = 'localhost';
 $dbuser = 'root';
 $dbpass = 'root';
 
 $db = 'petroapp';

 $link = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

/* check connection */
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

?>