<html>
<head></head>
<body>
<?php 			// Adding, Deleting, Updating, and Displaying Records from a MySQL Database 
		$con = mysql_connect("localhost", "root", "root");
		if (!$con) {
			die("Can not connect: " . mysql_errer());
		}
		mysql_select_db("snippets", $con);

		// Update button: Sjekk om koden er oppdatert når man trykker knappen i linje 39
		if(isset($_POST['update'])){
		//if (isset($_POST['submit']) && $_POST['submit'] == 'update') {
			$UpdateQuery = "UPDATE lectures SET Topic='$_POST[topic]', Name='$_POST[name]', Attendance='$_POST[attendance]' WHERE Topic='$_POST[hidden]'";
			//$UpdateQuery = "UPDATE table SET col1='value', col2='value', col3='value' WHERE theKey (or in this case  the col1)='hidden' ";
			mysql_query($UpdateQuery, $con);

		};


		// Delete button:
		if(isset($_POST['delete'])){
			$DeleteQuery = "DELETE FROM lectures WHERE Topic='$_POST[hidden]'";
			mysql_query($DeleteQuery, $con);

		};

		// Add button:
		if(isset($_POST['add'])){
			$AddQuery = "INSERT INTO lectures (Topic, Name, Attendance) VALUES ('$_POST[utopic]','$_POST[uname]','$_POST[uattendance]')";
			mysql_query($AddQuery, $con);
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
			echo "<form action=mydata5.php method=post>";
			echo "<tr>";
			echo "<td>" . "<input type=text name=topic value=" . $record['Topic'] . " </td>";
			// . $record['Topic'] . hentes fra DB
			echo "<td>" . "<input type=text name=name value=" . $record['Name'] . " </td>";
			echo "<td>" . "<input type=text name=attendance value=" . $record['Attendance'] . " </td>";
			echo "<td>" . "<input type=hidden name=hidden value=" . $record['Topic'] . " </td>";
			echo "<td>" . "<input type=submit name=update value=Update" . " </td>";
			echo "<td>" . "<input type=submit name=delete value=Delete" . " </td>";
			//echo "</tr>";
			echo "</form>";
		}
		
		//Legge til nye blanke tekstbokser
		echo "<form action=mydata5.php method=post>";
		echo "<tr>";
		echo "<td><input type=text name=utopic></td>";
		echo "<td><input type=text name=uname></td>";
		echo "<td><input type=text name=uattendance></td>";
		echo "<td>" . "<input type=submit name=add value=add" . " </td>";
		
		
		echo "</form>";
		echo "</table>";
		
		
		mysql_close($con);
		
		?>
	</body>
</html>