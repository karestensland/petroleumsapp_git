<html>
	<head></head>
	<body>
		<?php 			// Deleting, Updating, and Displaying Records from a MySQL Database 
		
		function retrieveQuestion(){
			
	
		$con = mysql_connect("localhost", "root", "root");
		if (!$con) {
			die("Can not connect: " . mysql_errer());
		}
		// include 'db.php';
		mysql_select_db("petroapp", $con);

		// Update button: Sjekk om koden er oppdatert når man trykker knappen i linje 39
		if(isset($_POST['update'])){
		//if (isset($_POST['submit']) && $_POST['submit'] == 'update') {
			$UpdateQuery = "UPDATE quizquestions SET question='$_POST[question2]', correct='$_POST[correct2]' WHERE question='$_POST[hidden]'";
			//$UpdateQuery = "UPDATE table SET col1='value', col2='value', col3='value' WHERE theKey (or in this case  the col1)='hidden' ";
			mysql_query($UpdateQuery, $con);

		};


		// Delete button:
		if(isset($_POST['delete'])){
			$DeleteQuery = ("DELETE FROM quizquestions WHERE question= " . ($record['question'])) ;
			mysql_query($DeleteQuery, $con);
			
			echo "$DeleteQuery";
session_start();
$user = $_SESSION['user'];
		};



		$sql = "SELECT * FROM quizquestions";
		$myData = mysql_query($sql, $con); //border = 1> 
		echo "<table align='center' border = 1> 
			<tr>
			<th>Spørsmål</th>
			<th>Riktig svar</th>
			<th>1=aktiv 0=inaktiv</th>
	
			
			</tr>";

		while ($record = mysql_fetch_array($myData)) {
			echo "<form action=mydata42.php method=post>";
			echo "<tr>";
			
			echo "<td><input type=text size=50 readonly='true' name='question2' value='".$record['question']."'</td>";
			// . $record['Topic'] . hentes fra DB
			echo "<td>" . "<input type=text name=correct2 value=" . $record['correct'] . " </td>";
			echo "<td>" . "<input type=text name=active value=" . $record['active'] . " </td>";
		
			echo "<td>" . "<input type=hidden name=hidden value=" . $record['question'] . " </td>";
			echo "<td>" . "<input type=checkbox name=lev1 value=vel1" . " </td>";
			echo "<td>" . "<input type=checkbox name=lev2 value=vel2" . " </td>";
			echo "<td>" . "<input type=submit name=update value=update" . " </td>";
			echo "<td>" . "<input type=submit name=delete value=delete" . " </td>";
			
			echo "</tr>";
			echo "</form>";
		}
		mysql_close($con);
		echo "</table>";
			}
		?>
	</body>
</html>

