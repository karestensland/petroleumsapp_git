<?php

include 'db.php';


// Retrieve data from Query String
$question = $_GET['question'];
$corr_answr = $_GET['corr_answr'];
$wrong1 = $_GET['wrong1'];
$wrong2 = $_GET['wrong2'];
$wrong3 = $_GET['wrong3'];
$insertgname= $_GET['insertgname'];




// Escape User Input to help prevent SQL Injection
$question = mysqli_real_escape_string($link, $question);
$corr_answr = mysqli_real_escape_string($link, $corr_answr);
$wrong1 = mysqli_real_escape_string($link, $wrong1);
$wrong2 = mysqli_real_escape_string($link, $wrong2);
$wrong3 = mysqli_real_escape_string($link, $wrong3);
$insertgname = mysqli_real_escape_string($link, $insertgname);




//build query
$query = "INSERT INTO quizquestions (question, correct, option1, option2, option3)
VALUES ('$question','$corr_answr','$wrong1','$wrong2','$wrong3')";

$query = "INSERT INTO group (groupname)
VALUES ('$insertgname)";

if (mysqli_query($link, $query)) {
    echo "New record created successfully<br><br><br><br>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($link);
}

//Display newly question


$query = "SELECT * FROM `quizquestions`";


$qry_result = mysqli_query($link,$query) or die(mysql_error());
//$qry_result = mysqli_query($link,$query);
//echo $qry_result;


//Build Result String
$display_string = "<table border=1 cellpadding=1 cellspacing=1>";
$display_string .= "<tr>";
$display_string .= "<th>Spørsmål</th>";
$display_string .= "<th>Riktig svar</th>";
$display_string .= "<th>Feil svar 1</th>";
$display_string .= "<th>Feil svar 2</th>";
$display_string .= "<th>Feil svar 3</th>";
$display_string .= "<th>Aktive spørsmål</th>";
$display_string .= "<th>Level barn</th>";
$display_string .= "<th>Level ungdom/voksen</th>";
$display_string .= "</tr>";


if($qry_result === FALSE) {
	die(mysql_error()); // TODO: better error handling
	printf("result does not exist");
}

// Insert a new row in the table for each person returned
while($row = mysqli_fetch_array($qry_result)){
	$display_string .= "<tr>";
	$display_string .= "<td>$row[question]</td>";
	$display_string .= "<td>$row[correct]</td>";
	$display_string .= "<td>$row[option1]</td>";
	$display_string .= "<td>$row[option2]</td>";
	$display_string .= "<td>$row[option3]</td>";
	$display_string .= "<td>$row[active]</td>";
	$display_string .= "<td>$row[levelchild]</td>";
	$display_string .= "<td>$row[levelyouth]</td>";
	$display_string .= "</tr>";

}
$display_string .= "</table>";
echo $display_string;









//Insert group name
$sql = "INSERT INTO group (groupname)
VALUES ('".$insertgname['insertgname']."')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}




	
	
	
	
	
	

$conn->close();
?>

mysqli_close($link);

?>