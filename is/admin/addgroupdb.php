<?php

include 'db.php';


// Retrieve data from Query String
//?group=abb&level=Select * all users 
$group = $_GET['group'];
$level = $_GET['level'];

// Escape User Input to help prevent SQL Injection // hindre at bruker ødelegger databasen
$group = mysqli_real_escape_string($link, $group);
$level = mysqli_real_escape_string($link, $level);


//$insertgname = mysqli_real_escape_string($link, $insertgname);

echo $group; 
echo $level;


//build query
$insertquery = "INSERT INTO 'group' ('groupname', 'level')
VALUES ('$_POST[$group]','$_POST[$level]')";



$return_value;
if (mysqli_query($link, $insertquery)) {
    $return_value = "New group added successfully";
} else {
     $return_value = "Error: " . $insertquery . "<br>" . mysqli_error($link);
}

mysqli_close($link);
echo json_encode($return_value);
//return "hest"; 


?>