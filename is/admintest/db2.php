<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "petroapp";
//$dbname = "snippets";
//Connect to MySQL Server
//mysql_connect($dbhost, $dbuser, $dbpass);
//Select Database
//mysql_select_db($dbname) or die(mysql_error());
$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

/* check connection */
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

?>

