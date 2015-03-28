<?php
header('Content-type: application/json; charset=utf-8');

include 'db_conn/dbConn.php';

/* check connection */
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

if (!mysqli_set_charset($link, "utf8")) {
	printf("Error loading character set utf8: %s\n", mysqli_error($link));
}

// Retrieve data from Query String
$userId = $_GET['userId'];
$questionId = $_GET['questionId'];
$answer = $_GET['answer'];

$userId = mysqli_real_escape_string($link, $userId);
$questionId = mysqli_real_escape_string($link, $questionId);
$answer = mysqli_real_escape_string($link, $answer);

$userIdInt = intval($userId, 10);
$questionIdInt = intval($questionId, 10);
$answerInt = intval($answer, 10);

//What to do:
/*1. if answer !=-1, add answer, questionid and user id to database
 *2. check how many non-answered questions in database for that user and group id and recive it
 * if >0
 *3.  pick one random questionid from the list
 * 4. get that question and return json
 * else
 * return all finished
 *
 *
 *
 */

//add answer to db

if ($answerInt != -1) {
	$queryAddAnswer = "INSERT INTO `quiz_answer_table`(`quizId`, `userId`, `quizAnswer`) 
				VALUES ($questionIdInt,$userIdInt,$answerInt)";

	$queryAddAnswer_result = mysqli_query($link, $queryAddAnswer) or die(mysql_error());

	if ($queryAddAnswer_result === FALSE) {
		die(mysql_error());
		printf("add data to db failed");
	}
}

//Get question not answered.
$queryRemainingQuestions = "SELECT DISTINCT A.quizquestionId FROM `quizquestions` A 
			LEFT JOIN `quiz_answer_table` B 
			ON A.quizquestionId = B.quizId AND B.userId = $userIdInt
			WHERE B.quizId IS NULL AND A.active=1 ";

$queryRemainingQuestions_result = mysqli_query($link, $queryRemainingQuestions) or die(mysql_error());

if ($queryRemainingQuestions_result === FALSE) {
	die(mysql_error());
	printf("get remaining question failed.");
}

$remainingQuestions = array();
while ($row = mysqli_fetch_array($queryRemainingQuestions_result)) {
	array_push($remainingQuestions, $row['quizquestionId']);
}

//Display newly question

$allAnswered = false;
if (empty($remainingQuestions)) {
	$allAnswered = true;
	//print "all answered";
}

if ($allAnswered == false) {
	$length = count($remainingQuestions);
	$randomIndex = rand(0, $length - 1);
	$randomNumber = $remainingQuestions[$randomIndex];

	//$randomNumber=2;

	$query = "SELECT * FROM `quizquestions` WHERE quizquestionId LIKE '$randomNumber' ";

	$qry_result = mysqli_query($link, $query) or die(mysql_error());

	if ($qry_result === FALSE) {
		die(mysql_error());
		// TODO: better error handling
		printf("result does not exist");
	}

	$array = array();
	while ($row = mysqli_fetch_array($qry_result)) {

		//Code from:
		//http://php.net/manual/en/function.json-encode.php
		//http://stackoverflow.com/questions/6281963/how-to-build-a-json-array-from-mysql-database

		$row_array['quiz_id'] = $row['quizquestionId'];
		$row_array['quiz_question'] = $row['question'];
		$row_array['quiz_answ_corr'] = $row['correct'];
		$row_array['quiz_answ_wrong1'] = $row['option1'];
		$row_array['quiz_answ_wrong2'] = $row['option2'];
		$row_array['quiz_answ_wrong3'] = $row['option3'];

		array_push($array, $row_array);

	}

	//echo $display_string;
	//echo "test";

	echo json_encode($array);
}

//if finished
else {
	$query = "SELECT `quizAnswer` FROM `quiz_answer_table` WHERE `userId` LIKE '$userIdInt' ";

	$qry_result = mysqli_query($link, $query) or die(mysql_error());

	if ($qry_result === FALSE) {
		die(mysql_error());
		// TODO: better error handling
		printf("result does not exist");
	}

	$array = array();

	while ($row = mysqli_fetch_array($qry_result)) {
		array_push($array, $row['quizAnswer']);
	}

	$length = count($array);
	$correctAnswer = 0;
	foreach ($array as $answ) {
		if ($answ == 0) {
			$correctAnswer++;
		}
	}
	$jsonReturnArray = array();
	$row_array['quiz_finished'] = "true";
	$row_array['quiz_total'] = $length;
	$row_array['quiz_correct'] = $correctAnswer;

	array_push($jsonReturnArray, $row_array);

	//echo $display_string;
	//echo "test";

	echo json_encode($jsonReturnArray);
}

mysqli_close($link);
?>
