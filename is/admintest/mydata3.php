<html>
	<head></head>
	<body>
		<?php 			// Updating and Displaying Records from a MySQL Database
		$con = mysql_connect("localhost", "root", "root");
		if (!$con) {
			die("Can not connect: " . mysql_errer());
		}
		mysql_select_db("snippets", $con);

		// Sjekk om koden er oppdatert når man trykker knappen i linje 39
		if(isset($_POST['update'])){
		//if (isset($_POST['submit']) && $_POST['submit'] == 'update') {
			$UpdateQuery = "UPDATE lectures SET Topic='$_POST[topic]', Name='$_POST[name]', Attendance='$_POST[attendance]' WHERE Topic='$_POST[hidden]'";
			//$UpdateQuery = "UPDATE table SET col1='value', col2='value', col3='value' WHERE theKey (or in this case  the col1)='hidden' ";
			mysql_query($UpdateQuery, $con);

		};

		$sql = "SELECT * FROM lectures";
		$myData = mysql_query($sql, $con);
		echo "<table border = 1> 
			<tr>
			<th>Topic</th>
			<th>Name</th>
			<th>Attentation</th>
			</tr>";

		while ($record = mysql_fetch_array($myData)) {
			echo "<form action=mydata3.php method=post>";
			echo "<tr>";
			echo "<td>" . "<input type=text name=topic value=" . $record['Topic'] . " </td>";
			// . $record['Topic'] . hentes fra DB
			echo "<td>" . "<input type=text name=name value=" . $record['Name'] . " </td>";
			echo "<td>" . "<input type=text name=attendance value=" . $record['Attendance'] . " </td>";
			echo "<td>" . "<input type=hidden name=hidden value=" . $record['Topic'] . " </td>";
			echo "<td>" . "<input type=submit name=update value=update" . " </td>";
			echo "</tr>";
			echo "</form>";
		}
		echo "</table>";
		mysql_close($con);
		?>
	</body>
</html>

