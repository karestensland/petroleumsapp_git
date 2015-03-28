<?php
header('Content-type: application/json; charset=utf-8');

include 'db_conn/dbConn.php';
//Get active group
$query = "SELECT * FROM `groups` WHERE `activeGroup`='1'";
$qry_result = mysqli_query($link, $query) or die(mysql_error());
//Build Result String
$json_return = "";
//check if result is ok
if ($qry_result === FALSE) {
	die(mysql_error());
	// TODO: better error handling
	printf("result does not exist - error in php file getActiveGroup");
} else {
	// Insert a new row in the table for each person returned
	$array = array();
	while ($row = mysqli_fetch_array($qry_result)) {
		$json_return['groupName'] = $row['groupName'];
		$json_return['groupId'] = $row['groupId'];

	}
	echo json_encode($json_return);
}
?>
