<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "name";

	//Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	//Check connection
	if ($conn->connect_error) {
		die("connection failed:" . $conn->connect_error);
	}

	#region Inserting information
	//$sql = "INSERT INTO studenten (Naam, Leeftijd, Geslacht) VALUES ('Tim', 17, 'M')";

	// if ($conn->query($sql) === TRUE) {
	// 	echo "New record created succesfully";
	// }

	// else {
	// 	echo "Error: " . $sql . "<br>" . $conn->error;
	// }
	#endregion

	$sql = "SELECT Naam, Leeftijd, Geslacht FROM studenten";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		//output data of each row
		while ($row = $result->fetch_assoc()) {
			echo "Naam: " . $row["Naam"]. "Leeftijd: " .$row["Leeftijd"]. "Geslacht: " .$row["Geslacht"].1 "<br>";
		}
	}

	else {
		echo "0 Results";
	}

	$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

</body>
</html>