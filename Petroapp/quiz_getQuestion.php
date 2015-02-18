<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "petroapp";
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

//Display newly question

$min = 1;
$max = 4;
$randomNumber = rand($min, $max);

$query = "SELECT * FROM `quizquestions` WHERE quiz_id LIKE '$randomNumber' ";

$qry_result = mysqli_query($link, $query) or die(mysql_error());

//Build Result String
$display_string = "";

if ($qry_result === FALSE) {
	die(mysql_error());
	// TODO: better error handling
	printf("result does not exist");
} else {

}
// Insert a new row in the table for each person returned
$array = array();
while ($row = mysqli_fetch_array($qry_result)) {
	//display_string .= "<div data-role=\"content\" id=\"question\">";
	//$display_string .= "<span>$row[quiz_question]</span>";
	//$display_string .= "</div>";
	$display_string .= "<div class=\"ui-grid-a\">";
	$display_string .= "<div class=\"ui-block-a\">";
	$display_string .= "<a data-role=\"button\" onclick=\"getCookie('group name');\">$row[quiz_answ_corr]</a>";
	$display_string .= "</div>";
	$display_string .= "<div class=\"ui-block-b\">";
	$display_string .= "<a data-role=\"button\">$row[quiz_answ_wrong1]</a>";
	$display_string .= "</div>";
	$display_string .= "<div class=\"ui-block-a\">";
	$display_string .= "<a data-role=\"button\">$row[quiz_answ_wrong2]</a>";
	$display_string .= "</div>";
	$display_string .= "<div class=\"ui-block-b\">";
	$display_string .= "<a data-role=\"button\">$row[quiz_answ_wrong3]</a>";
	$display_string .= "</div>";
	$display_string .= "</div>";
}

echo $display_string;

mysqli_close($link);
?>
