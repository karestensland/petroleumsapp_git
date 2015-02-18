

<?PHP

$user_name = "root";
$password = "root";
$database = "petroapp";


$db_handle = mysql_connect($server, $user_name, $password);

$db_found = mysql_select_db($database, $db_handle);

if ($db_found) {

print "Database Found ";
mysql_close($db_handle);

}
else {

print "Database NOT Found ";

}

?>


<!--<?php
$con = mysqli_connect("localhost","root","root", "petroapp") or die('Could not connect the database : Username or password incorrect');
mysql_select_db('petroapp') or die ('No database found');
echo 'Database Connected successfully';
?> -->
 
