<html>
	<head></head>
	<body>
		<?php 			// Displaying MySQL Records on a PHP Page
		$con = mysql_connect("localhost", "root", "root");
		if (!$con) {
			die("Can not connect: " . mysql_errer());
		} echo "ok tilkobling ";
		mysql_select_db("snippets", $con);
		$sql = "SELECT * FROM lectures";
		$myData = mysql_query($sql, $con);
		while ($record = mysql_fetch_array($myData)) {
			echo $record['Topic'] . " " . $record['Name'] . " " . $record['Attendance'];
			// henter ut tekst fra databasen på en rad/record
			echo "<br />";
		}
		mysql_close($con);
		?>
	</body>
</html>

