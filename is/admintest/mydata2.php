<html>
	<head></head>
	<body>
		<?php 			// Displaying MySQL Records in a HTML Table 
		$con = mysql_connect("localhost", "root", "root");
		if (!$con) {
			die("Can not connect: " . mysql_errer());
		} echo "ok tilkobling ";
		mysql_select_db("snippets", $con);
		$sql = "SELECT * FROM lectures";
		$myData = mysql_query($sql, $con);
			echo "<table border = 1> 
			<tr>
			<th>Topic</th>
			<th>Name</th>
			<th>Attentation</th>
			</tr>";
		
		while ($record = mysql_fetch_array($myData)) {
			echo "<tr>";
			echo "<td>" . $record['Topic'] . " </td>";
			echo "<td>" . $record['Name'] . " </td>";
			echo "<td>" . $record['Attendance'] . " </td>";
			echo "</tr>";	

		}
		echo "</table>";
		mysql_close($con);
		?>
	</body>
</html>
