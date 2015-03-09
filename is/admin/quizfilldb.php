<?php
 
 
header("Content-Type: text/html; charset=ISO-8859-1");
//header('Content-Type: text/html; charset=UTF-8');
include 'db.php';
//mb_internal_encoding("UTF-8");


 

// Retrieve data from Query String
$question = $_GET['question'];
$corr_answr = $_GET['corr_answr'];
$wrong1 = $_GET['wrong1'];
$wrong2 = $_GET['wrong2'];
$wrong3 = $_GET['wrong3'];
//$insertgname= $_GET['insertgname'];




// Escape User Input to help prevent SQL Injection
$question = mysqli_real_escape_string($link, $question);
$corr_answr = mysqli_real_escape_string($link, $corr_answr);
$wrong1 = mysqli_real_escape_string($link, $wrong1);
$wrong2 = mysqli_real_escape_string($link, $wrong2);
$wrong3 = mysqli_real_escape_string($link, $wrong3);
//$insertgname = mysqli_real_escape_string($link, $insertgname);




//build query
$query = "INSERT INTO quizquestions (question, correct, option1, option2, option3)
VALUES ('$question','$corr_answr','$wrong1','$wrong2','$wrong3')";

//$query = "INSERT INTO group (groupname)
//VALUES ('$insertgname)";
$return_value;
if (mysqli_query($link, $query)) {
    $return_value = 'Nytt spørsmål er lagret i databasen.';
} else {
     $return_value = "Error: " . $query . "<br>" . mysqli_error($link);
}

mysqli_close($link);
echo json_encode($return_value);
//return "hest"; 


?>