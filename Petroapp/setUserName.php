<?php
include 'db_conn/dbConn.php';
//Get active group
$group_id = $_GET['groupId'];
$userName = $_GET['userName'];
// Escape User Input to help prevent SQL Injection
$group_id = mysqli_real_escape_string($link, $group_id);
$userName = mysqli_real_escape_string($link, $userName);

//Check if userName exists in db

$queryCheckUser = "SELECT * FROM `user` WHERE `userName`='$userName' AND `groupId` ='$group_id'";

$qryUserExists = mysqli_query($link, $queryCheckUser) or die(mysqli_error($link));

$userExists = false;

if ($qryUserExists === FALSE) {
	die(mysql_error());
	printf("result does not exist - error in php file getActiveGroup");
} else {
	while ($row = mysqli_fetch_array($qryUserExists)) {
		$userExists = true;
	}
}

if ($userExists == TRUE) {
	echo json_encode("user exists");

} 
//user does not exists
else {
	
	$queryAddUser = "INSERT INTO `user`(`userName`, `groupId`) VALUES ('$userName','$group_id')";
	$qryAddUser = mysqli_query($link, $queryAddUser) or die(mysqli_error($link));

	if ($qryAddUser === FALSE) {
		die(mysql_error());
		printf("result does not exist - error in php file getActiveGroup");
	} else {
$jsonReturn ="";
		$queryUserId = "SELECT `userId` FROM `user` WHERE `userName`= '$userName' AND `groupId`='$group_id'";
		$qryUserId = mysqli_query($link, $queryUserId) or die(mysqli_error($link));
		while ($row = mysqli_fetch_array($qryUserId)) {
			$jsonReturn = $row['userId'];
		}
		echo json_encode($jsonReturn);
	}
	
}

?>
