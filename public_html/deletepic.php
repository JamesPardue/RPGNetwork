<?php
session_start();

if(isset($_SESSION["name"]) && isset($_POST["piclabel"]))
{
	//Create connection
	$servername = "localhost";
	$username = "protoj18_dbuser";
	$dbpassword = "Kobe08jpx";
	$dbname = "protoj18_RPGFF";
	$conn = new mysqli($servername, $username, $dbpassword, $dbname);

    //Check connection
    if ($conn->connect_error) 
    {
        $_SESSION["error"] = "Cannot connect to server.";
        die("Connection failed: " . $conn->connect_error);
    }

    $piclabel = test_input($_POST["piclabel"]);
	
	//Create database query
    $sql = "SELECT " . $piclabel . " FROM players" . 
         " WHERE name='" . $_SESSION["name"] . "'";

    //Send query
	$delfile = "";
    $result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$delfile = $row[$piclabel];
		}
	}
    //Create database query
    $sql = "UPDATE players SET " . $piclabel . "=''" . 
         " WHERE name='" . $_SESSION["name"] . "'";

    //Send query
    $result = $conn->query($sql);

    //Close connection
    $conn->close();

    unlink($delfile);
    header('Location: editprofile.php');
	exit();
}
else
{
    header('Location: editprofile.php');
	exit();
}
    
function test_input($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>