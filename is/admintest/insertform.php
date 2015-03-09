<html>
	<head></head>

	<body>
		<form action="insertform.php" method="post">
			Topic:
			<input type="text" name="topic">
			<br />
			Name:
			<input type="text" name="name">
			<br />
			Attendance:
			<input type="text" name="attendance">
			<br />
			<input type="submit" name="submit">

		</form>

		<?php
		
		
		//  Inserting Form Data into MySQL using PHP
		
		if (isset($_POST['submit'])) {

			$con = mysql_connect("localhost", "root", "root");
			if (!$con) {
				die("Can not connect: " . mysql_errer());
			} 
			echo "ok tilkobling ";
				
				
			mysql_select_db("snippets", $con);

			$sql = "INSERT INTO lectures (Topic,Name,Attendance) VALUES ('$_POST[topic]','$_POST[name]','$_POST[attendance]')";
			
			if(mysql_query($sql, $con))
			{
				echo "oik";
			}
			else {
				echo mysql_error($con);
			}
			
			
			mysql_close($con);
			
			echo '<table>
					<tr>
						<td>Topic</td>
						<td>Name</td>
						<td>Attendance</td>
					</tr>
					<tr>
						<td>' . $_POST[topic] . '</td>
						<td>' . $_POST[name] . '</td>
						<td>' . $_POST[attendance] . '</td>
					</tr>
				</table>';
				
				
				
		}
		?>
	</body>
</html>
